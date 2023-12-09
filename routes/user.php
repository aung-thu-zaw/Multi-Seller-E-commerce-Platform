<?php

use App\Http\Controllers\Seller\Auth\LoginController;
use App\Http\Controllers\Seller\Dashboard\AttributeAndOptionController;
use App\Http\Controllers\Seller\Dashboard\DashboardController;
use App\Http\Controllers\Seller\Dashboard\DeleteOptionController;
use App\Http\Controllers\Seller\Dashboard\ProductController;
use App\Http\Controllers\Seller\Dashboard\ProductImageController;
use App\Http\Controllers\Seller\Dashboard\ProductVariantController;
use App\Http\Controllers\Seller\Dashboard\StoreProductCategoryController;
use App\Http\Controllers\User\MyAccountController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', DashboardController::class)->name('dashboard');

        // Route::resource('/my-account', MyAccountController::class)->only(["edit","update"])->parameters([
        //     'my-account' => 'user',
        // ]);
    });
