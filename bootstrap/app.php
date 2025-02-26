<?php

use App\Models\ErrorLog;
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
    })
    ->withExceptions(function (Exceptions $exceptions) {
//        $exceptions->render(function (\Throwable $e) {
//            if ($e->getMessage() == "Unauthenticated.") {
//                return redirect()->route('filament.admin.auth.login');
//            } else {
//                ErrorLog::create([
//                    'value' => $e->getMessage(),
//                    'file' => $e->getFile(),
//                    'line' => $e->getLine(),
//                    'created_by' => auth()->id() ?? null,
//                ]);
//
//                return response()->view('errors.500', [], 500);
//            }
//        });
    })->create();

