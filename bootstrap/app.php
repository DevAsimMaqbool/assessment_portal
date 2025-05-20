<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
<<<<<<< HEAD
use Spatie\Permission\Middleware\RoleMiddleware;
=======
>>>>>>> 855d8572a04eb69d9c41e722888f473b513001f8

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
<<<<<<< HEAD
        $middleware->alias([
             'role' => RoleMiddleware::class,
         ]);
=======
        //
>>>>>>> 855d8572a04eb69d9c41e722888f473b513001f8
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
