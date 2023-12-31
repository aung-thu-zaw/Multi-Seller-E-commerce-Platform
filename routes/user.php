<?php

use App\Http\Controllers\Seller\Dashboard\DashboardController;
use App\Http\Controllers\User\AddressBookController;
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

        Route::get('/change-password', ChangePasswordController::class)->name('change-password');

        Route::get('/delete-account', DeleteAccountController::class)->name('delete-account');

        Route::resource("/my-wishlists", MyWishlistController::class)->only(['index','destroy'])->parameters(['my_wishlist' => 'wishlist']);

        Route::get('/followed-stores', FollowedStoreController::class)->name('followed-stores');

        Route::resource("/address-book", AddressBookController::class)->except(["show"])->parameters(['address_book' => 'address']);

    });
