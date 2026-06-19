
<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        api: __DIR__.'/../routes/api.php',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // ✅ Aliases dyalk kollhom hna
        $middleware->alias([
            'role'  => \App\Http\Middleware\RoleMiddleware::class,
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
        ]);

        // ✅ CSRF exceptions
        $middleware->validateCsrfTokens(except: [
            'api/inscription-association',
            'api/dashboard-benevole',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();



