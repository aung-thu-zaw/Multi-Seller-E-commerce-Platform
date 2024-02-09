<?php

use App\Http\Controllers\DeleteProductImageController;
use App\Http\Controllers\DownloadOrderInvoiceController;
use App\Http\Controllers\Seller\Auth\LoginController;
use App\Http\Controllers\Seller\Dashboard\ChatInboxController;
use App\Http\Controllers\Seller\Dashboard\DashboardController;
use App\Http\Controllers\Seller\Dashboard\OrderManagement\CancellationItemController;
use App\Http\Controllers\Seller\Dashboard\OrderManagement\OrderController;
use App\Http\Controllers\Seller\Dashboard\OrderManagement\ReturnItemController;
use App\Http\Controllers\Seller\Dashboard\PayoutRequestController;
use App\Http\Controllers\Seller\Dashboard\ProductController;
use App\Http\Controllers\Seller\Dashboard\ProductQuestionController;
use App\Http\Controllers\Seller\Dashboard\ReviewManagement\ProductReviewController;
use App\Http\Controllers\Seller\Dashboard\ReviewManagement\StoreReviewController;
use App\Http\Controllers\Seller\Dashboard\StoreProductBannerController;
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

        // ***** Store Product Category Operations *****
        Route::resource('store-product-categories', StoreProductCategoryController::class)->except(['show']);

        Route::delete('/store-product-categories/destroy/selected/{selected_items}', [StoreProductCategoryController::class, 'destroySelected'])->name('store-product-categories.destroy.selected');

        Route::controller(StoreProductCategoryController::class)
            ->prefix('/store-product-categories/trash')
            ->name('store-product-categories.')
            ->group(function () {
                Route::get('/', 'trashed')->name('trashed');
                Route::post('/{id}/restore', 'restore')->name('restore');
                Route::post('/restore/selected/{selected_items}', 'restoreSelected')->name('restore.selected');
                Route::delete('/{id}/force-delete', 'forceDelete')->name('force-delete');
                Route::delete('/force-delete/selected/{selected_items}', 'forceDeleteSelected')->name('force-delete.selected');
                Route::delete('/force-delete/all', 'forceDeleteAll')->name('force-delete.all');
            });

        // ***** Store Product Banner Operations *****
        Route::resource('store-product-banners', StoreProductBannerController::class)->except(['show']);

        Route::delete('/store-product-banners/destroy/selected/{selected_items}', [StoreProductBannerController::class, 'destroySelected'])->name('store-product-banners.destroy.selected');

        Route::controller(StoreProductBannerController::class)
            ->prefix('/store-product-banners/trash')
            ->name('store-product-banners.')
            ->group(function () {
                Route::get('/', 'trashed')->name('trashed');
                Route::post('/{id}/restore', 'restore')->name('restore');
                Route::post('/restore/selected/{selected_items}', 'restoreSelected')->name('restore.selected');
                Route::delete('/{id}/force-delete', 'forceDelete')->name('force-delete');
                Route::delete('/force-delete/selected/{selected_items}', 'forceDeleteSelected')->name('force-delete.selected');
                Route::delete('/force-delete/all', 'forceDeleteAll')->name('force-delete.all');
            });

        // ***** Product Question Operations *****
        Route::resource('product-questions', ProductQuestionController::class)->except(['show', 'destroy']);

        // ***** Product Review Operations *****
        Route::resource('product-reviews', ProductReviewController::class)->except(['show', 'destroy']);

        // ***** Store Review Operations *****
        Route::resource('store-reviews', StoreReviewController::class)->except(['show', 'destroy']);

        // ***** Payout Requests Operations *****
        Route::resource('payout-requests', PayoutRequestController::class)->except(['show', 'destroy']);

        // // ***** Product Operations *****
        Route::resource('product-manage', ProductController::class)->except(['show'])->parameters([
            'product-manage' => 'product',
        ])->names([
            'index' => 'products.index',
            'create' => 'products.create',
            'edit' => 'products.edit',
            'update' => 'products.update',
            'destroy' => 'products.destroy',
        ]);

        Route::delete('/products/destroy/selected/{selected_items}', [ProductController::class, 'destroySelected'])->name('products.destroy.selected');
        Route::delete('/products/images/{product_image}', DeleteProductImageController::class)->name('product.images.destroy');

        // ***** Store Setting Operations *****
        Route::controller(StoreSettingController::class)
            ->prefix('/store-settings')
            ->name('store-settings.')
            ->group(function () {
                Route::get('/', 'edit')->name('edit');
                Route::patch('{store_id}/store-information', 'updateStoreInformation')->name('update-store-information');
                Route::patch('{business_information_id}/business-information', 'updateBusinessInformation')->name('update-business-information');
                Route::patch('{bank_account_id}/bank-account', 'updateBankAccount')->name('update-bank-account');
            });

        Route::get('/chat-inbox', ChatInboxController::class)->name('chat-inbox');

        // ***** Order Operations *****
        Route::controller(OrderController::class)
            ->prefix('/orders')
            ->name('orders.')
            ->middleware('strict.inactive_store')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{order}/detail', 'show')->name('show');
                Route::patch('/{order}/status', 'updateOrderStatus')->name('status.update');
            });

        Route::get('orders/{order}/download', DownloadOrderInvoiceController::class)->name('order-invoice.download')->middleware('strict.inactive_store');

        // ***** Return Item Operations *****
        Route::controller(ReturnItemController::class)
            ->prefix('/return-items')
            ->name('return-items.')
            ->middleware('strict.inactive_store')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{return_item}/detail', 'show')->name('show');
                Route::patch('/{return_item}/status', 'updateOrderStatus')->name('status.update');
            });

        // ***** Cancellation Item Operations *****
        Route::controller(CancellationItemController::class)
            ->prefix('/cancellation-items')
            ->name('cancellation-items.')
            ->middleware('strict.inactive_store')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{cancellation_item}/detail', 'show')->name('show');
                Route::patch('/{cancellation_item}/status', 'updateCancellationItemStatus')->name('status.update');
            });

    });
