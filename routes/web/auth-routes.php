<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if(auth()->check()==true){
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('admin.login');
});

Route::prefix('admin')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::middleware('guest')->group(function () {
            Route::get('/', 'showLoginForm')->name('admin.login');
            Route::get('/register', 'showRegisterForm')->name('admin.register');
            Route::post('/', 'login')->name('admin.login.post');
            Route::post('/register', 'register');
        });

        Route::middleware(['auth'])->group(function () {
            Route::post('/logout', 'logout')->name('admin.logout');
        });
    });

    Route::controller(DashboardController::class)->group(function () {
        Route::middleware(['auth'])->group(function () {
            Route::get('/dashboard', 'index')->name('admin.dashboard');

        });
    });
});
