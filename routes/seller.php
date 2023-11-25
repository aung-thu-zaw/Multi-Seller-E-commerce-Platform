<?php

use App\Http\Controllers\Seller\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/seller/login', LoginController::class)->middleware('guest')->name('seller.login');
