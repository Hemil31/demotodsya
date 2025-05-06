<?php

use App\Http\Controllers\Admin\OrderController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::prefix('order')->controller(OrderController::class)->name('order.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('order-data', 'getOrder')->name('data');
        Route::get('order-download/{id}', 'orderDownload')->name('download');
        Route::get('today-order-download', 'todayOrderDownload')->name('today-download');
        Route::get('today-order-download-restaurant', 'todayOrderRestaurantDownload')->name('today-download-restaurant');
    });
});
