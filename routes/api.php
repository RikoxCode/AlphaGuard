<?php

use App\Http\Controllers\FriendController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminAuth;
use Illuminate\Http\Request;
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
    Route::prefix('auth')->group(function() {
        Route::post('/login', [LoginController::class, 'login']);
        Route::post('/register', [LoginController::class, 'register']);
        Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');
        Route::post('/me', [LoginController::class, 'getMe'])->middleware('auth:sanctum');
    });

    // User routes
    Route::prefix('users')->group(function() {
        Route::post('/grant', [UserController::class, 'grant'])->middleware('auth:sanctum')->middleware('adminauth');
        Route::get('/avatars/{filename}', [UserController::class, 'getAvatar']);
        Route::get('/', [UserController::class, 'index']);
    });

    // Friend routes
    Route::prefix('friends')->group(function() {
        Route::post('/{user}', [FriendController::class, 'store'])->middleware('auth:sanctum');
        Route::get('/', [FriendController::class, 'index'])->middleware('auth:sanctum');
    });


});
