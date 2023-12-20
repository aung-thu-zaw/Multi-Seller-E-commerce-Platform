<?php

use App\Http\Controllers\Seller\Dashboard\DashboardController;
use App\Http\Controllers\User\ChangePasswordController;
use App\Http\Controllers\User\DeleteAccountController;
use App\Http\Controllers\User\FollowedStoreController;
use App\Http\Controllers\User\MyAccountController;
use App\Http\Controllers\User\MyWishlistController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {

        Route::get('/dashboard', DashboardController::class)->name('dashboard');

        Route::get('/my-account', [MyAccountController::class, 'edit'])->name('my-account.edit');
        Route::patch('/my-account/{user}', [MyAccountController::class, 'update'])->name('my-account.update');

        Route::get('/change-password', ChangePasswordController::class)->name('change-password.edit');

        Route::get('/delete-account', DeleteAccountController::class)->name('delete-account');

        Route::get('/my-wishlists', [MyWishlistController::class, 'index'])->name('my-wishlists.index');
        Route::delete('/my-wishlists/{wishlist}', [MyWishlistController::class, 'destroy'])->name('my-wishlists.destroy');

        Route::get('/followed-stores', FollowedStoreController::class)->name('followed-stores');

    });
