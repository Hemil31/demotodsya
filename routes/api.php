<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;


Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->name('api.')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('user.logout');

    Route::prefix('category')->controller(CategoryController::class)->name('category.')->group(function () {
        Route::get('', 'index')->name('index');
    });
    Route::prefix('order')->controller(OrderController::class)->name('order.')->group(function () {
        Route::post('', 'index')->name('index');
        Route::get('order-history', 'orderHistory')->name('history');
    });
});

