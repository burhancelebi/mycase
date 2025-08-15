<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (ValidationException $e, $request) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Failed',
                'code' => 422,
                'errors' => $e->errors(),
            ], 422);
        });

        $exceptions->render(function (AccessDeniedHttpException $e, $request) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Forbidden',
                'code' => 403,
            ], 403);
        });

        $exceptions->render(function (ModelNotFoundException $e, $request) {
            return response()->json([
                'success' => false,
                'message' => 'Resource not found',
                'code' => 404,
            ], 404);
        });

        $exceptions->render(function (AuthenticationException $e, $request) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated',
                'code' => 401,
            ], 401);
        });

        $exceptions->render(function (Throwable $e, $request) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Server Error',
                'code' => $e->getCode() ?: 500,
            ], $e->getCode() ?: 500);
        });
    })->create();
