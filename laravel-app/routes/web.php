<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', [Admins\Controllers\AdminAuthController::class, 'getLoginPage'])->name('admin.getLoginPage');
    // Route::post('/login', [\Admins\Controllers\AdminAuthController::class, 'login'])->name('admin.login');
    // Route::post('/logout', [\Admins\Controllers\AdminAuthController::class, 'logout'])->name('admin.logout');


    // Route::group(['middleware' => ['admin.auth']], function() {
    //     Route::get('/', [\Admins\Controllers\AdminHomeDashboard::class, 'getAdminDashboardPage'])
    //     ->name('admin.getAdminDashboardPage');
    //     Route::get('users', [\Admins\Controllers\AdminAuthController::class, 'getUsers'])->name('admin.users');
    //     Route::get('orders', [\Admins\Controllers\AdminAuthController::class, 'getUsers'])->name('admin.orders');
    // });
});
