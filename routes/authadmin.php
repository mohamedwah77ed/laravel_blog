<?php


use App\Http\Controllers\Admin\AdminAuthController;

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::get('/register', [AdminAuthController::class, 'showRegisterForm'])->name('admin.register.form');
    Route::post('/register', [AdminAuthController::class, 'register'])->name('admin.register');
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login.form');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});

