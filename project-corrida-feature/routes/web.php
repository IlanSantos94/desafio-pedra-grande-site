<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Pagina de confirmacao pos-pagamento (redirect do PagBank)
Route::get('/obrigado', function (Illuminate\Http\Request $request) {
    $reference = $request->query('ref');

    if (!$reference || !preg_match('/^ID_[0-9]+$/', $reference)) {
        return response()->view('obrigado', ['reference' => null], 400);
    }

    return view('obrigado', ['reference' => $reference]);
});
