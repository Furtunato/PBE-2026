<?php


use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
    $middleware->validateCsrfTokens(except: [
        'pokemon/novo',
        'usuario/novo',     // Adicione esta linha para o cadastro de usuários
        'usuarios/*',       // Opcional: se quiser liberar todas as rotas que começam com usuarios/
    ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();