<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TaskController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('teams')->group(function () {
        Route::post('/', [TeamController::class, 'store']);
        Route::get('/', [TeamController::class, 'index']);
        Route::post('/{id}/members', [TeamController::class, 'addMember']);
        Route::delete('/{teamId}/members/{userId}', [TeamController::class, 'removeMember']);
    });

    Route::prefix('tasks')->group(function () {
        Route::post('/', [TaskController::class, 'store']);
        Route::get('/', [TaskController::class, 'index']);
        Route::put('/{id}', [TaskController::class, 'update']);
        Route::delete('/{id}', [TaskController::class, 'destroy']);
        Route::post('/{id}/files', [TaskController::class, 'storeFile']);
    });
});
