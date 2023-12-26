<?php

use App\Http\Controllers\Seller\Auth\LoginController;
use App\Http\Controllers\Seller\Dashboard\ChatInboxController;
use App\Http\Controllers\Seller\Dashboard\DashboardController;
use App\Http\Controllers\Seller\Dashboard\StoreProductCategoryController;
use App\Http\Controllers\Seller\Dashboard\StoreSettingController;
use Illuminate\Support\Facades\Route;

Route::get('/seller/login', LoginController::class)->middleware('guest')->name('seller.login');

Route::middleware(['auth', 'verified', 'user.role:seller'])
    ->prefix('seller')
    ->name('seller.')
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', DashboardController::class)->name('dashboard');

        // Store Category Operations
        Route::resource('store-product-categories', StoreProductCategoryController::class)->except(['show'])->middleware('strict.inactive_store');
        Route::controller(StoreProductCategoryController::class)
            ->middleware('strict.inactive_store')
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

        Route::get('/store-settings', [StoreSettingController::class, 'index'])->name('store-settings.index');

        Route::get('/chat-inbox', ChatInboxController::class)->name('chat-inbox');

    });
