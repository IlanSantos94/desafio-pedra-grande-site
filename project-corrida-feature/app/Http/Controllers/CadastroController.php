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
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:cadastros',
            'cpf' => 'required|string|size:11|unique:cadastros', 
            'telefone' => 'required|string|max:20',
            'dataNascimento' => 'required|string|max:255',
            'categoria' => 'required|string|max:20',
        ]);
        
        $cadastro = Cadastro::create($data);
        $valorInscricao = 100; // R$ 1,00

        try {
            $telefoneLimpo = preg_replace('/\D/', '', $cadastro->telefone);
            $cpfLimpo = preg_replace('/\D/', '', $cadastro->cpf);

            $areaCode = substr($telefoneLimpo, 0, 2);
            $number = substr($telefoneLimpo, 2);

            $baseUrl = "https://unideaed-wastable-rudolf.ngrok-free.dev";

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('PAGBANK_TOKEN'),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post(env('PAGBANK_URL') . '/checkouts', [
                "customer" => [
                    "name" => $cadastro->nome,
                    "email" => $cadastro->email,
                    "tax_id" => $cpfLimpo,
                    "phones" => [
                        [
                            "area_code" => $areaCode,
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
                "reference_id" => "ID_" . $cadastro->id,
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
                return response()->json(['error' => 'Erro PagBank'], 400);
            }

            $pagbankData = $response->json();
            $paymentUrl = collect($pagbankData['links'])->where('rel', 'PAY')->first()['href'];

            return response()->json([
                'message' => 'Cadastro realizado com sucesso!',
                'payment_url' => $paymentUrl
            ], 201);

        } catch (\Exception $e) {
            Log::error('Erro Interno: ' . $e->getMessage());
            return response()->json(['error' => 'Erro interno'], 500);
        }
    }

    public function webhook(Request $request)
    {
        $dados = $request->all();
        Log::info("--- NOVO WEBHOOK RECEBIDO ---");

        // 1. Tenta pegar o Reference ID
        $referenceId = $dados['reference_id'] ?? null;

        // 2. Busca o Status (Pode estar na raiz ou dentro de charges)
        $statusPagamento = $dados['status'] ?? null;
        
        if (!$statusPagamento && isset($dados['charges'][0]['status'])) {
            $statusPagamento = $dados['charges'][0]['status'];
        }

        // 3. Caso seja notificação antiga (notificationCode)
        if (isset($dados['notificationCode'])) {
            $response = Http::get(env('PAGBANK_URL') . '/v3/transactions/notifications/' . $dados['notificationCode'], [
                'email' => env('PAGBANK_EMAIL'),
                'token' => env('PAGBANK_TOKEN'),
            ]);
            if ($response->successful()) {
                $dadosXML = $response->xml() ?: $response->json(); 
                $referenceId = $dadosXML['reference'] ?? $dadosXML['reference_id'] ?? null;
                $statusPagamento = $this->converterStatus($dadosXML['status'] ?? null);
            }
        }

        Log::info("Processando Reference: $referenceId | Status: $statusPagamento");

        if ($referenceId) {
            $idInscricao = str_replace('ID_', '', $referenceId);
            $atleta = Cadastro::find($idInscricao);

            $statusAprovados = ['PAID', 'COMPLETED', 'AUTHORIZED', '3', 3];

            if ($atleta && in_array($statusPagamento, $statusAprovados)) {
                $atleta->update(['status' => 'pago']);
                Log::info("✅ SUCESSO: Atleta " . $atleta->nome . " atualizado para PAGO.");
            } else {
                Log::warning("⚠️ AVISO: Status não é de aprovação ou atleta não encontrado. Status: " . ($statusPagamento ?? 'NULO'));
            }
        }

        return response()->json(['status' => 'OK'], 200);
    }

    private function converterStatus($status) {
        $mapa = [1 => 'PENDING', 2 => 'IN_ANALYSIS', 3 => 'PAID', 4 => 'AVAILABLE', 7 => 'CANCELLED'];
        return $mapa[$status] ?? $status;
    }
}