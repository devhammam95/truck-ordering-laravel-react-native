<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [\Admins\Controllers\AdminDashboardController::class, 'getAdminDashboardPage'])->middleware('admin.auth');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', [Admins\Controllers\AdminAuthController::class, 'getLoginPage'])->name('admin.getLoginPage');
    Route::post('/login', [\Admins\Controllers\AdminAuthController::class, 'login'])->name('admin.login');
    Route::post('/logout', [\Admins\Controllers\AdminAuthController::class, 'logout'])->name('admin.logout')
    ->middleware('admin.auth');

    Route::group(['middleware' => ['admin.auth']], function() {
        Route::get('/', [\Admins\Controllers\AdminDashboardController::class, 'getAdminDashboardPage'])
        ->name('admin.getAdminDashboardPage');

        // Route::get('users', [\Admins\Controllers\AdminAuthController::class, 'getUsers'])->name('users.all');
         Route::get('orders', [\Orders\Controllers\OrderController::class, 'getAllOrders'])->name('orders.all');
    });
});
