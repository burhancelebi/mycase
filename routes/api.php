<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TaskController;

// Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');

// Teams
Route::middleware('auth:sanctum')->prefix('teams')->group(function () {
    Route::post('/', [TeamController::class, 'store']);
    Route::get('/', [TeamController::class, 'index']);
    Route::post('/{id}/members', [TeamController::class, 'addMember']);
    Route::delete('/{id}/members/{userId}', [TeamController::class, 'removeMember']);
});

// Tasks
Route::middleware('auth:sanctum')->prefix('tasks')->group(function () {
    Route::post('/', [TaskController::class, 'store']);
    Route::get('/', [TaskController::class, 'index']);
    Route::put('/{id}', [TaskController::class, 'update']);
    Route::delete('/{id}', [TaskController::class, 'destroy']);
    Route::post('/{id}/files', [TaskController::class, 'storeFile']);
});
