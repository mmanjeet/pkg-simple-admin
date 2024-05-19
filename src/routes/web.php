<?php

use Illuminate\Support\Facades\Route;
use Cyberzet\SingleAdmin\Http\Controllers\AdminAuthController;
use Cyberzet\SingleAdmin\Http\Controllers\DashboardController;

Route::group(
    [
        'prefix' => 'admin',
        'middleware' => 'web'
    ],
    function () {
        Route::get('/', [AdminAuthController::class, 'index'])->name('admin');
        Route::post('login', [AdminAuthController::class, 'loginAuth'])->name('admin.auth');
        Route::middleware(['auth', 'role:admin'])->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
            Route::get('/profile', [AdminAuthController::class, 'profile'])->name('profile');
            Route::post('/profile', [AdminAuthController::class, 'updateProfile'])->name('profile');
            Route::post('/password', [AdminAuthController::class, 'updatePassword'])->name('password');
            Route::get('logout', [AdminAuthController::class, 'logout'])->name('logout');
        });
    }
);
