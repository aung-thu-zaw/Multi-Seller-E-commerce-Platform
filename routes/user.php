<?php


use App\Http\Controllers\Seller\Dashboard\DashboardController;
use App\Http\Controllers\User\ChangePasswordController;
use App\Http\Controllers\User\DeleteAccountController;
use App\Http\Controllers\User\MyAccountController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', DashboardController::class)->name('dashboard');

        // My Account Operation
        Route::get('/my-account', [MyAccountController::class,"edit"])->name('my-account.edit');
        Route::patch('/my-account/{user}', [MyAccountController::class,"update"])->name('my-account.update');


        // Change Password Operation
        Route::get('/change-password', ChangePasswordController::class)->name('change-password.edit');

        // Delete Account Operation
        Route::get('/delete-account', DeleteAccountController::class)->name('delete-account');

    });
