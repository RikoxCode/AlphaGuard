<?php

use App\Http\Controllers\FriendController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function() {

    // Auth routes
    Route::prefix('auth')->middleware(['logResponse'])->group(function() {
        Route::post('/login', [LoginController::class, 'login'])->middleware(['logResponse']);
        Route::post('/register', [LoginController::class, 'register'])->middleware(['logResponse']);
        Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum')->middleware(['logResponse']);
        Route::post('/me', [LoginController::class, 'getMe'])->middleware('auth:sanctum')->middleware(['logResponse']);
    });

    // User routes
    Route::prefix('users')->group(function() {
        Route::post('/grant', [UserController::class, 'grant'])->middleware('auth:sanctum')->middleware('adminauth')->middleware(['logResponse']);
        Route::get('/avatars/{filename}', [UserController::class, 'getAvatar']);
        Route::get('/', [UserController::class, 'index']);
    });

    // Friend routes
    Route::prefix('friends')->group(function() {
        Route::post('/{user}', [FriendController::class, 'store'])->middleware('auth:sanctum')->middleware(['logResponse']);
        Route::get('/', [FriendController::class, 'index'])->middleware('auth:sanctum');
    });
});
