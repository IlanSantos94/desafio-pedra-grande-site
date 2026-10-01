<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
});

// Cadastros
Route::post('/cadastros', [\App\Http\Controllers\CadastroController::class, 'store']);
// PENDENTE: proteger com middleware de admin antes de produção (exposição de PII).
Route::get('/cadastros', [\App\Http\Controllers\CadastroController::class, 'index']);

// Consulta de status (usada pela pagina de confirmacao, com auto-refresh)
Route::get('/cadastros/{reference}/status', [\App\Http\Controllers\CadastroController::class, 'status'])
    ->where('reference', 'ID_[0-9]+');

// Webhook do PagBank
Route::post('/webhook/pagbank', [\App\Http\Controllers\CadastroController::class, 'webhook']);
