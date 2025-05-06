<?php

use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::prefix('user')->controller(UsersController::class)->name('user.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::match(['put', 'post'], 'update/{id}', 'update')->name('update');
        Route::match(['delete', 'post'], 'delete/{id}', 'destroy')->name('destroy');
        Route::get('user-data', 'getUser')->name('data');
    });
});
