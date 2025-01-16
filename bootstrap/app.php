<?php

use App\Http\Middleware\IsAuth;
use App\Http\Middleware\IsMembership;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //

        $middleware->alias([
            'isMember' => IsMembership::class,
            'isAuth' => IsAuth::class
        ]);

        $middleware->validateCsrfTokens(except: [
            "*"
        ]);
    })

    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
