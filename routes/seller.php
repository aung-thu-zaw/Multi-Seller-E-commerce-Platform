<?php

use App\Http\Controllers\Seller\Auth\LoginController;
use App\Http\Controllers\Seller\Dashboard\DashboardController;
use App\Http\Controllers\Seller\Dashboard\ProductController;
use App\Http\Controllers\Seller\Dashboard\ProductImageController;
use App\Http\Controllers\Seller\Dashboard\StoreProductCategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/seller/login', LoginController::class)
    ->middleware('guest')
    ->name('seller.login');

Route::middleware(['auth', 'verified', 'user.role:seller'])
    ->prefix('seller')
    ->name('seller.')
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', DashboardController::class)->name('dashboard');

        // Store Category Operations
        Route::resource('store-product-categories', StoreProductCategoryController::class)->except(['show']);
        Route::controller(StoreProductCategoryController::class)
            ->prefix('/store-product-categories/trash')
            ->name('store-product-categories.')
            ->group(function () {
                Route::delete('/destroy/selected/{selected_items}', 'destroySelected')->name('destroy.selected');
                Route::get('/', 'trashed')->name('trashed');
                Route::post('/{id}/restore', 'restore')->name('restore');
                Route::post('/restore/selected/{selected_items}', 'restoreSelected')->name('restore.selected');
                Route::delete('/{id}/force-delete', 'forceDelete')->name('force-delete');
                Route::delete('/force-delete/selected/{selected_items}', 'forceDeleteSelected')->name('force-delete.selected');
                Route::delete('/force-delete/all', 'forceDeleteAll')->name('force-delete.all');
            });

        // Product Operations
        Route::resource('products', ProductController::class)->except(['show']);
        Route::controller(ProductController::class)
            ->prefix('/products/trash')
            ->name('products.')
            ->group(function () {
                Route::delete('/destroy/selected/{selected_items}', 'destroySelected')->name('destroy.selected');
                Route::get('/', 'trashed')->name('trashed');
                Route::post('/{id}/restore', 'restore')->name('restore');
                Route::post('/restore/selected/{selected_items}', 'restoreSelected')->name('restore.selected');
                Route::delete('/{id}/force-delete', 'forceDelete')->name('force-delete');
                Route::delete('/force-delete/selected/{selected_items}', 'forceDeleteSelected')->name('force-delete.selected');
                Route::delete('/force-delete/all', 'forceDeleteAll')->name('force-delete.all');
            });

        Route::controller(ProductImageController::class)
            ->prefix('/products')
            ->name('product.')
            ->group(function () {
                Route::get('/{product}/images', 'productImages')->name('images');
                Route::post('/{product}/images', 'handleProductImages')->name('images.upload');
                Route::delete('/images/{product_image}', 'destroyProductImage')->name('images.destroy');
            });
    });
