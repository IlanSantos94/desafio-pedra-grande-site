<?php

namespace App\Http\Controllers;

use App\Models\Cadastro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CadastroController extends Controller
{
    public function index()
    {
        return response()->json(Cadastro::all());
    }

    public function store(Request $request)
    {
        // 1. Validação (Removido o 'unique' para permitir re-inscrição de pendentes)
        $validado = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email',
            'cpf' => 'required|string|size:11', 
            'telefone' => 'required|string|max:20',
            'dataNascimento' => 'required|string|max:255',
            'sexo' => 'required|string|max:1', // Ajustado para bater com o banco (M/F)
            'percurso' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
        ]);

        // 2. Lógica de Upsert (Evitar duplicidade e permitir nova tentativa de pagamento)
        $cadastro = Cadastro::where('cpf', $validado['cpf'])->first();

        if ($cadastro) {
            if ($cadastro->status === 'pago') {
                return response()->json(['error' => 'Este CPF já possui uma inscrição confirmada e paga.'], 422);
            }
            // Atualiza os dados se estiver pendente (caso queira mudar percurso/email antes de pagar)
            $cadastro->update($validado);
        } else {
            // Cria novo se não existir
            $validado['status'] = 'pendente';
            $cadastro = Cadastro::create($validado);
        }

        $valorInscricao = 10000; // R$ 100,00 (PagBank usa centavos)

        try {
            $telefoneLimpo = preg_replace('/\D/', '', $cadastro->telefone);
            $cpfLimpo = preg_replace('/\D/', '', $cadastro->cpf);

            $areaCode = substr($telefoneLimpo, 0, 2);
            $number = substr($telefoneLimpo, 2);

            $baseUrl = env('PAGBANK_NOTIFICATION_URL', env('APP_URL'));

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('PAGBANK_TOKEN'),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post(env('PAGBANK_URL') . '/checkouts', [
                "reference_id" => "ID_" . $cadastro->id,
                "customer" => [
                    "name" => $cadastro->nome,
                    "email" => $cadastro->email,
                    "tax_id" => $cpfLimpo,
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
                        "name" => "Inscricao Corrida - " . strtoupper($cadastro->categoria),
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
                "redirect_url" => $baseUrl . "/obrigado" 
            ]);

            if (!$response->successful()) {
                Log::error('Erro PagBank: ' . $response->body());
                return response()->json(['error' => 'Ocorreu um erro ao gerar o link de pagamento. Tente novamente.'], 400);
            }

            $pagbankData = $response->json();
            $paymentUrl = collect($pagbankData['links'])->where('rel', 'PAY')->first()['href'];

            return response()->json([
                'message' => 'Inscrição processada com sucesso!',
                'payment_url' => $paymentUrl
            ], 201);

        } catch (\Exception $e) {
            Log::error('Erro Interno: ' . $e->getMessage());
            return response()->json(['error' => 'Erro interno no servidor.'], 500);
        }
    }

    public function webhook(Request $request)
    {
        $dados = $request->all();
        Log::info("--- NOVO WEBHOOK RECEBIDO ---");

        $referenceId = $dados['reference_id'] ?? null;
        $statusPagamento = $dados['status'] ?? null;
        
        // Verifica status dentro do array de charges (comum no PagBank moderno)
        if (!$statusPagamento && isset($dados['charges'][0]['status'])) {
            $statusPagamento = $dados['charges'][0]['status'];
        }

        // Caso de notificação por XML/V3
        if (isset($dados['notificationCode'])) {
            $response = Http::get(env('PAGBANK_URL') . '/v3/transactions/notifications/' . $dados['notificationCode'], [
                'email' => env('PAGBANK_EMAIL'),
                'token' => env('PAGBANK_TOKEN'),
            ]);
            if ($response->successful()) {
                $dadosXML = $response->xml(); 
                $referenceId = $dadosXML['reference'] ?? null;
                $statusPagamento = $this->converterStatus($dadosXML['status'] ?? null);
            }
        }

        Log::info("Processando Reference: $referenceId | Status: $statusPagamento");

        if ($referenceId) {
            $idInscricao = str_replace('ID_', '', $referenceId);
            $atleta = Cadastro::find($idInscricao);

            // Status que consideramos como "Pago"
            $statusAprovados = ['PAID', 'COMPLETED', 'AUTHORIZED', '3', 3];

            if ($atleta && in_array($statusPagamento, $statusAprovados)) {
                $atleta->update(['status' => 'pago']);
                Log::info("✅ SUCESSO: Atleta " . $atleta->nome . " atualizado para PAGO.");
            }
        }

        return response()->json(['status' => 'OK'], 200);
    }

    private function converterStatus($status) {
        $mapa = [1 => 'PENDING', 2 => 'IN_ANALYSIS', 3 => 'PAID', 4 => 'AVAILABLE', 7 => 'CANCELLED'];
        return $mapa[$status] ?? $status;
    }
}