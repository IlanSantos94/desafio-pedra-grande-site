<?php

use Illuminate\Support\Facades\Route;

Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
});
Route::get('/obrigado', function () {
    return "<h1>Obrigado! Pagamento realizado com sucesso.</h1>";
});

// Rotas existentes (Usando o caminho completo para evitar conflitos)
Route::post('/cadastros', [\App\Http\Controllers\CadastroController::class, 'store']);
Route::get('/cadastros', [\App\Http\Controllers\CadastroController::class, 'index']);

// Nova Rota para o Webhook do PagBank
Route::post('/webhook/pagbank', [\App\Http\Controllers\CadastroController::class, 'webhook']);