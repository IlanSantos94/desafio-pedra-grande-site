<?php

namespace App\Http\Controllers;

use App\Models\Cadastro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CadastroController extends Controller
{
    // ATENÇÃO (pendente): esta rota devolve CPF, e-mail, telefone e data de
    // nascimento de todas as inscrições sem nenhuma autenticação. Ela foi mantida
    // de propósito porque vai servir ao painel admin, mas precisa ser protegida
    // por middleware de autenticação/autorização antes de ir para produção.
    public function index()
    {
        return response()->json(Cadastro::all());
    }

    public function store(Request $request)
    {
        // 1. Validação (sem 'unique' para permitir re-inscrição de pendentes)
        $validado = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'cpf' => ['required', 'string', 'size:11'],
            'telefone' => ['required', 'string', 'regex:/^\d{10,11}$/'],
            'dataNascimento' => 'required|date_format:Y-m-d',
            'sexo' => 'required|in:M,F',
            'percurso' => 'required|in:Completo,Reduzido,Completo Misto,Reduzido Misto',
            'modalidade' => 'nullable|string|max:60',
            'categoria' => 'required|string|max:255',
            'kit' => 'required|in:com,sem',
            'tamanho' => 'required_if:kit,com|nullable|in:P,M,G,GG',
            'pagamento' => 'required|in:pix,cartao',
            'aceite' => 'required|boolean',
        ], [], [
            'cpf' => 'CPF',
            'telefone' => 'telefone',
            'telefone.regex' => 'O telefone deve ter DDD + 8 ou 9 dígitos (10 ou 11 números).',
            'dataNascimento' => 'data de nascimento',
            'tamanho' => 'tamanho da camisa',
            'aceite' => 'aceite dos termos',
        ]);

        $validado['cpf'] = preg_replace('/\D/', '', $validado['cpf']);
        $validado['telefone'] = preg_replace('/\D/', '', $validado['telefone']);
        $validado['tamanho'] = $validado['tamanho'] ?? null;
        $validado['aceite'] = (bool) $validado['aceite'];

        // 2. Lógica de Upsert (evita duplicidade e permite nova tentativa de pagamento)
        $cadastro = Cadastro::where('cpf', $validado['cpf'])
            ->orWhere('email', $validado['email'])
            ->first();

        if ($cadastro) {
            if ($cadastro->status === 'pago') {
                return response()->json([
                    'error' => 'Já existe uma inscrição confirmada e paga para este CPF ou e-mail.',
                ], 422);
            }
            // Atualiza os dados se estiver pendente (pode trocar percurso/categoria antes de pagar)
            $cadastro->update($validado);
        } else {
            $validado['status'] = 'pendente';
            $cadastro = Cadastro::create($validado);
        }

        // 3. Valor: base + kit (PagBank usa centavos)
        $valorInscricao = 10900 + ($validado['kit'] === 'com' ? 6000 : 0);
        $referenceId = 'ID_' . $cadastro->id;

        try {
            $areaCode = substr($validado['telefone'], 0, 2);
            $number = substr($validado['telefone'], 2);

            $baseUrl = env('PAGBANK_NOTIFICATION_URL', env('APP_URL'));

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('PAGBANK_TOKEN'),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post(env('PAGBANK_URL') . '/checkouts', [
                "reference_id" => $referenceId,
                "customer" => [
                    "name" => $cadastro->nome,
                    "email" => $cadastro->email,
                    "tax_id" => $cadastro->cpf,
                    "phones" => [
                        [
                            "country" => "55",
                            "area" => $areaCode,
                            "number" => $number,
                            "type" => "MOBILE"
                        ]
                    ]
                ],
                "items" => [
                    [
                        "name" => "Inscricao DPG - " . strtoupper($cadastro->categoria)
                            . ($validado['kit'] === 'com' ? " (com kit {$validado['tamanho']})" : " (sem kit)"),
                        "quantity" => 1,
                        "unit_amount" => $valorInscricao
                    ]
                ],
                "payment_methods" => [
                    ["type" => "CREDIT_CARD"],
                    ["type" => "PIX"],
                    ["type" => "BOLETO"]
                ],
                "notification_urls" => [
                    $baseUrl . "/api/webhook/pagbank"
                ],
                "redirect_url" => $baseUrl . "/obrigado?ref=" . $referenceId
            ]);

            if (!$response->successful()) {
                Log::error('Erro PagBank: ' . $response->body());
                return response()->json(['error' => 'Ocorreu um erro ao gerar o link de pagamento. Tente novamente.'], 400);
            }

            $pagbankData = $response->json();
            $paymentUrl = collect($pagbankData['links'])->where('rel', 'PAY')->first()['href'];

            // Uma única escrita com o valor, a referência e o código do checkout.
            $cadastro->update([
                'valor_inscricao' => $valorInscricao / 100,
                'pagbank_reference' => $referenceId,
                'pagbank_id' => $pagbankData['code'] ?? $pagbankData['id'] ?? null,
            ]);

            return response()->json([
                'message' => 'Inscrição processada com sucesso!',
                'payment_url' => $paymentUrl,
                'reference' => $referenceId,
            ], 201);

        } catch (\Exception $e) {
            Log::error('Erro Interno: ' . $e->getMessage());
            return response()->json(['error' => 'Erro interno no servidor.'], 500);
        }
    }

    public function webhook(Request $request)
    {
        $dados = $request->all();
        $origem = $request->ip();

        $referenceId = $dados['reference_id'] ?? null;
        $statusPagamento = $dados['status'] ?? null;
        $charge = $dados['charges'][0] ?? null;

        // No formato moderno o status real vem dentro de charges[0]
        if (!$statusPagamento && isset($charge['status'])) {
            $statusPagamento = $charge['status'];
        }

        Log::info("--- WEBHOOK | ip: {$origem} | ref: " . ($referenceId ?? 'ausente')
            . " | status: " . ($statusPagamento ?? 'ausente'));

        $statusAprovados = ['PAID', 'COMPLETED', 'AUTHORIZED', 'AVAILABLE', '3', 3];
        $statusCancelados = ['CANCELLED', 'EXPIRED', '4', 7];
        $statusAguardando = ['IN_ANALYSIS', 'WAITING_FOR_PAYMENT', 'WAITING', '1', 2];

        if (blank($referenceId)) {
            Log::warning("Webhook sem reference_id. IP: {$origem}");
            return response()->json(['status' => 'OK'], 200);
        }

        // Remove SOMENTE o prefixo "ID_" (str_replace removia em qualquer posicao)
        $idInscricao = preg_replace('/^ID_/', '', (string) $referenceId);
        $atleta = is_numeric($idInscricao) ? Cadastro::find((int) $idInscricao) : null;

        if (!$atleta) {
            Log::warning("Webhook sem inscricao correspondente. IP: {$origem} | Reference: {$referenceId}");
            return response()->json(['status' => 'OK'], 200);
        }

        // O PagBank reenvia notificacoes e elas podem chegar fora de ordem. Um
        // pagamento ja confirmado nunca pode ser rebaixado (nem por um WAITING
        // atrasado), senao o horario real de pagamento se perde.
        $jaConfirmado = $atleta->status === 'pago' && $atleta->pago_em !== null;

        if ($jaConfirmado) {
            Log::info("Pagamento ja confirmado, notificacao ignorada | {$atleta->nome} | recebido: {$statusPagamento}");
            return response()->json(['status' => 'OK'], 200);
        }

        $atualizacoes = [];

if (in_array($statusPagamento, $statusAprovados, true)) {
            $atualizacoes['status'] = 'pago';
            $atualizacoes['pago_em'] = now();

            // Valor realmente pago: PagBank envia em centavos
            $centavos = $charge['paid_amount']
                ?? $charge['amount']
                ?? $dados['amount']
                ?? null;

            if ($centavos !== null) {
                $valorPago = ((int) $centavos) / 100;
                $atualizacoes['valor_pago'] = $valorPago;

                $divergente = $atleta->valor_inscricao !== null
                    && abs(((float) $atleta->valor_inscricao) - $valorPago) >= 0.01;

                // No sandbox o PagBank sempre simula R$ 0,01, entao a divergencia
                // e esperada e nao deve ser marcada como erro.
                $isSandbox = str_contains((string) env('PAGBANK_URL'), 'sandbox');

                if ($isSandbox && $divergente) {
                    $divergente = false;
                    Log::info(sprintf(
                        'SANDBOX: %s | valor simulado R$ %.2f (cobrado R$ %.2f) - divergencia ignorada',
                        $atleta->nome,
                        $valorPago,
                        $atleta->valor_inscricao
                    ));
                } elseif ($divergente) {
                    Log::warning(sprintf(
                        'DIVERGENCIA: %s | cobrado R$ %.2f | confirmado R$ %.2f | dif R$ %.2f',
                        $atleta->nome,
                        $atleta->valor_inscricao,
                        $valorPago,
                        $valorPago - $atleta->valor_inscricao
                    ));
                }

                $atualizacoes['pagamento_divergente'] = $divergente;
            }

            $pagbankId = $charge['id'] ?? $dados['id'] ?? null;
            if ($pagbankId) {
                $atualizacoes['pagbank_id'] = $pagbankId;
            }

            Log::info('SUCESSO: ' . $atleta->nome . ' -> PAGO (R$ ' . ($atualizacoes['valor_pago'] ?? '?') . ')');
        } elseif (in_array($statusPagamento, $statusCancelados, true)) {
            $atualizacoes['status'] = 'cancelado';
            Log::info('CANCELADO: ' . $atleta->nome);
        } elseif (in_array($statusPagamento, $statusAguardando, true)) {
            $atualizacoes['status'] = 'aguardando';
        }

        if ($atualizacoes) {
            $atleta->update($atualizacoes);
        }

        return response()->json(['status' => 'OK'], 200);
    }

    /**
     * Consulta publica do status de uma inscricao, usada pela pagina de confirmacao.
     */
    public function status(string $reference)
    {
        $idInscricao = preg_replace('/^ID_/', '', $reference);
        $atleta = is_numeric($idInscricao) ? Cadastro::find((int) $idInscricao) : null;

        if (!$atleta) {
            return response()->json(['found' => false], 404);
        }

        return response()->json([
            'found' => true,
            'status' => $atleta->status,
            'nome' => $atleta->nome,
            'categoria' => $atleta->categoria,
            'percurso' => $atleta->percurso,
            'pagamento' => $atleta->pagamento,
            'valor_inscricao' => $atleta->valor_inscricao === null ? null : (float) $atleta->valor_inscricao,
            'valor_pago' => $atleta->valor_pago === null ? null : (float) $atleta->valor_pago,
            'pagamento_divergente' => (bool) $atleta->pagamento_divergente,
            'pago_em' => $atleta->pago_em ? $atleta->pago_em->format('d/m/Y H:i') : null,
        ]);
    }
}