<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Test route
Route::get('/test', function() {
    return response()->json(['message' => 'Web routes are working!']);
});

// API routes in web.php as fallback
Route::prefix('api')->group(function () {
    Route::post('/users', [App\Http\Controllers\UserController::class, 'store']);
    Route::get('/users/{id}', [App\Http\Controllers\UserController::class, 'show']);
    Route::post('/wallets', [App\Http\Controllers\WalletController::class, 'store']);
    Route::get('/wallets/{id}', [App\Http\Controllers\WalletController::class, 'show']);
    Route::post('/transactions', [App\Http\Controllers\TransactionController::class, 'store']);
});