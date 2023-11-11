<?php

use App\Http\Controllers\Admin\Dashboard\AdminDashboardController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/login', AdminLoginController::class)->middleware('guest')->name('admin.login');

Route::middleware(['verified', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', AdminDashboardController::class)->name('dashboard');
    });
