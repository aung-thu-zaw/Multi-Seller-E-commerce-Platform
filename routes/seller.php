<?php

use App\Http\Controllers\Seller\Auth\LoginController;
use App\Http\Controllers\Seller\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/seller/login', LoginController::class)->middleware('guest')->name('seller.login');


Route::middleware(['auth', 'verified', 'user.role:seller'])
    ->prefix('seller')
    ->name('seller.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', DashboardController::class)->name('dashboard');

    });
