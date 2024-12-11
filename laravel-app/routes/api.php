<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'v1'], function() {
    Route::post('/user/login', [\Users\Controllers\UserAuthController::class, 'login'])->name('login');
    Route::post('/user/register', [\Users\Controllers\UserAuthController::class, 'register']);
    Route::post('user/logout', [\Users\Controllers\UserAuthController::class, 'logout'])
        ->middleware('auth:sanctum');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::group(['prefix' => 'v1'], function() {
        Route::get('shipping-orders', [\Orders\Controllers\OrderController::class, 'index']);
        Route::post('shipping-orders', [\Orders\Controllers\OrderController::class, 'store']);
    });
});