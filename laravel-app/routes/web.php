<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [\Admins\Controllers\AdminDashboardController::class, 'getAdminDashboardPage'])->middleware('admin.auth');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', [Admins\Controllers\AdminAuthController::class, 'getLoginPage'])->middleware('admin.guest')->name('admin.getLoginPage');
    Route::post('/login', [\Admins\Controllers\AdminAuthController::class, 'login'])->middleware('admin.guest')->name('admin.login');
    Route::post('/logout', [\Admins\Controllers\AdminAuthController::class, 'logout'])->name('admin.logout')
    ->middleware('admin.auth');

    Route::group(['middleware' => ['admin.auth']], function() {
        Route::get('/', [\Admins\Controllers\AdminDashboardController::class, 'getAdminDashboardPage'])
        ->name('admin.getAdminDashboardPage');

         Route::get('orders', [\Orders\Controllers\OrderController::class, 'getAllOrders'])->name('orders.all');
         Route::post('orders/{id}/update', [\Orders\Controllers\OrderController::class, 'updateOrderStatus'])
         ->name('orders.updateOrderStatus');
         
         Route::get('orders/{id}/notification/{notification_type}', [\Orders\Controllers\OrderController::class, 'getSendNotificationToUserPage'])
         ->name('orders.getSendNotificationToUserPage');

         Route::post('orders/{id}/notification/{notification_type}/send', [\Orders\Controllers\OrderController::class, 'sendNotificationToUser'])
         ->name('orders.sendNotificationToUser');
    });
});
