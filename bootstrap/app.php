<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        api: __DIR__ . '/../routes/api.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {


        // リクエストのurlがapi関連であれば、認証は不要、他は認証しないとユーザー登録、
        // ログイン画面しか表示されない
        $requestUri = $_SERVER['REQUEST_URI'] ?? '';
        if (!str_starts_with($requestUri, '/api/')) {
            $middleware->redirectGuestsTo(fn() => route('login'));
            $middleware->redirectUsersTo(fn() => route('top'));
        }
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
