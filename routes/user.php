<?php

use App\Http\Controllers\Seller\Dashboard\DashboardController;
use App\Http\Controllers\User\AddressBookController;
use App\Http\Controllers\User\ChangePasswordController;
use App\Http\Controllers\User\DeleteAccountController;
use App\Http\Controllers\User\FollowedStoreController;
use App\Http\Controllers\User\MyAccountController;
use App\Http\Controllers\User\MyOrderController;
use App\Http\Controllers\User\MyReviewController;
use App\Http\Controllers\User\MyWishlistController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {

        Route::get('/dashboard', DashboardController::class)->name('dashboard');

        Route::get('/my-account', [MyAccountController::class, 'edit'])->name('my-account.edit');
        Route::patch('/my-account/{user}', [MyAccountController::class, 'update'])->name('my-account.update');

        Route::middleware('verified')->group(function () {
            Route::get('/change-password', ChangePasswordController::class)->name('change-password');

            Route::get('/delete-account', DeleteAccountController::class)->name('delete-account');

            Route::resource('/my-wishlists', MyWishlistController::class)->parameters(['my_wishlist' => 'wishlist'])->only(['index', 'destroy']);

            Route::get('/followed-stores', FollowedStoreController::class)->name('followed-stores');

            Route::resource('/address-book', AddressBookController::class)->parameters(['address_book' => 'address'])->except(['show']);

            Route::get('/my-orders', [MyOrderController::class, 'index'])->name('my-orders.index');
            Route::get('/my-orders/{order}', [MyOrderController::class, 'show'])->name('my-orders.show');

            Route::get('/my-reviews', [MyReviewController::class, 'index'])->name('my-reviews.index');
            Route::post('/my-reviews/{product}', [MyReviewController::class, 'store'])->name('my-reviews.store');
            Route::get('/my-reviews/{product}/add-review', [MyReviewController::class, 'addReview'])->name('my-reviews.add');
        });

    });
