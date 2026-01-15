<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php', // Garante que suas rotas API sejam lidas
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // ESSENCIAL: Libera o Webhook da proteção de segurança CSRF
        $middleware->validateCsrfTokens(except: [
            'api/webhook/pagbank', 
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();