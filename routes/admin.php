<?php

use App\Http\Controllers\Admin\Dashboard\AdminDashboardController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\Dashboard\EcommerceAdministration\AdminCategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/login', AdminLoginController::class)->middleware('guest')->name('admin.login');

Route::middleware(['auth','verified', 'user.role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', AdminDashboardController::class)->name('dashboard');

        // Category Operations
        Route::resource('categories', AdminCategoryController::class)->except(['show']);
        Route::controller(AdminCategoryController::class)
            ->prefix('/categories/trash')
            ->name('categories.')
            ->group(function () {
                Route::get('/', 'trashed')->name('trashed');
            });
    });
