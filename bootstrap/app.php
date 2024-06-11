<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (Throwable $e, Request $request) {
            if ($request->is('api/*')) {
                if($e instanceof  AuthenticationException) {
                    return response()->json([
                        'status' => 'error',
                        'message' => $e->getMessage(),
                        'data' => [],
                    ], Response::HTTP_UNAUTHORIZED);
                }

                return response()->json([
                    'status' => 'error',
                    'message' => $e->getMessage(),
                    'data' => [],
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        });
    })->create();
