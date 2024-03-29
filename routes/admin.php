<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Dashboard\AccountManagement\AdminManageController;
use App\Http\Controllers\Admin\Dashboard\AccountManagement\RegisteredAccountController;
use App\Http\Controllers\Admin\Dashboard\AuthorityManagement\AssignRolePermissionsController;
use App\Http\Controllers\Admin\Dashboard\AuthorityManagement\PermissionController;
use App\Http\Controllers\Admin\Dashboard\AuthorityManagement\RoleController;
use App\Http\Controllers\Admin\Dashboard\Banners\CampaignBannerController;
use App\Http\Controllers\Admin\Dashboard\Banners\ProductBannerController;
use App\Http\Controllers\Admin\Dashboard\Banners\SliderBannerController;
use App\Http\Controllers\Admin\Dashboard\BlogManagement\BlogCategoryController;
use App\Http\Controllers\Admin\Dashboard\BlogManagement\BlogCommentController;
use App\Http\Controllers\Admin\Dashboard\BlogManagement\BlogContentController;
use App\Http\Controllers\Admin\Dashboard\BrandController;
use App\Http\Controllers\Admin\Dashboard\CategoryController;
use App\Http\Controllers\Admin\Dashboard\CollectionController;
use App\Http\Controllers\Admin\Dashboard\CouponController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Dashboard\DatabaseBackupController;
use App\Http\Controllers\Admin\Dashboard\Faqs\FaqCategoryController;
use App\Http\Controllers\Admin\Dashboard\Faqs\FaqContentController;
use App\Http\Controllers\Admin\Dashboard\Faqs\FaqSubcategoryController;
use App\Http\Controllers\Admin\Dashboard\FlashSaleController;
use App\Http\Controllers\Admin\Dashboard\GeographicHierarchy\CityController;
use App\Http\Controllers\Admin\Dashboard\GeographicHierarchy\RegionController;
use App\Http\Controllers\Admin\Dashboard\GeographicHierarchy\TownshipController;
use App\Http\Controllers\Admin\Dashboard\HelpPageController;
use App\Http\Controllers\Admin\Dashboard\OrderManagement\OrderController;
use App\Http\Controllers\Admin\Dashboard\ProductController;
use App\Http\Controllers\Admin\Dashboard\RatingManagement\AutomatedFilterWordController;
use App\Http\Controllers\Admin\Dashboard\RatingManagement\ProductReviewController;
use App\Http\Controllers\Admin\Dashboard\RatingManagement\StoreReviewController;
use App\Http\Controllers\Admin\Dashboard\SellerManagement\ClaimsAsASellerController;
use App\Http\Controllers\Admin\Dashboard\SellerManagement\StoreManageController;
use App\Http\Controllers\Admin\Dashboard\Settings\GeneralSettingController;
use App\Http\Controllers\Admin\Dashboard\Settings\SeoSettingController;
use App\Http\Controllers\Admin\Dashboard\ShippingAreaController;
use App\Http\Controllers\Admin\Dashboard\ShippingMethodController;
use App\Http\Controllers\Admin\Dashboard\ShippingRateController;
use App\Http\Controllers\Admin\Dashboard\SubscribersAndNewsletters\SubscriberController;
use App\Http\Controllers\DeleteProductImageController;
use App\Http\Controllers\DownloadOrderInvoiceController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/login', LoginController::class)->middleware('guest')->name('admin.login');

Route::middleware(['auth', 'verified', 'user.role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', DashboardController::class)->name('dashboard');

        // ***** Category Operations *****
        Route::resource('categories', CategoryController::class)->except(['show']);

        Route::delete('/categories/destroy/selected/{selected_items}', [CategoryController::class, 'destroySelected'])->name('categories.destroy.selected');

        Route::controller(CategoryController::class)
            ->prefix('/categories/trash')
            ->name('categories.')
            ->group(function () {
                Route::get('/', 'trashed')->name('trashed');
                Route::post('/{id}/restore', 'restore')->name('restore');
                Route::post('/restore/selected/{selected_items}', 'restoreSelected')->name('restore.selected');
                Route::delete('/{id}/force-delete', 'forceDelete')->name('force-delete');
                Route::delete('/force-delete/selected/{selected_items}', 'forceDeleteSelected')->name('force-delete.selected');
                Route::delete('/force-delete/all', 'forceDeleteAll')->name('force-delete.all');
            });

        // ***** Brand Operations *****
        Route::resource('brands', BrandController::class)->except(['show']);

        Route::delete('/brands/destroy/selected/{selected_items}', [BrandController::class, 'destroySelected'])->name('brands.destroy.selected');

        Route::controller(BrandController::class)
            ->prefix('/brands/trash')
            ->name('brands.')
            ->group(function () {
                Route::get('/', 'trashed')->name('trashed');
                Route::post('/{id}/restore', 'restore')->name('restore');
                Route::post('/restore/selected/{selected_items}', 'restoreSelected')->name('restore.selected');
                Route::delete('/{id}/force-delete', 'forceDelete')->name('force-delete');
                Route::delete('/force-delete/selected/{selected_items}', 'forceDeleteSelected')->name('force-delete.selected');
                Route::delete('/force-delete/all', 'forceDeleteAll')->name('force-delete.all');
            });

        // ***** Product Operations *****
        Route::resource('product-manage', ProductController::class)->except(['show'])->parameters([
            'product-manage' => 'product',
        ])->names([
            'index' => 'products.index',
            'create' => 'products.create',
            'edit' => 'products.edit',
            'update' => 'products.update',
            'destroy' => 'products.destroy',
        ]);

        Route::patch('/products/{product}/change-status', [ProductController::class, 'changeStatus'])->name('products.status.update');

        Route::delete('/products/destroy/selected/{selected_items}', [ProductController::class, 'destroySelected'])->name('products.destroy.selected');

        Route::delete('/products/images/{product_image}', DeleteProductImageController::class)->name('product.images.destroy');

        Route::controller(ProductController::class)
            ->prefix('/product-manage/trash')
            ->name('products.')
            ->group(function () {
                Route::get('/', 'trashed')->name('trashed');
                Route::post('/{id}/restore', 'restore')->name('restore');
                Route::post('/restore/selected/{selected_items}', 'restoreSelected')->name('restore.selected');
                Route::delete('/{id}/force-delete', 'forceDelete')->name('force-delete');
                Route::delete('/force-delete/selected/{selected_items}', 'forceDeleteSelected')->name('force-delete.selected');
                Route::delete('/force-delete/all', 'forceDeleteAll')->name('force-delete.all');
            });

        // ***** Product Review Operations *****
        Route::resource('product-reviews', ProductReviewController::class)->except(['show','create','store']);

        Route::delete('/product-reviews/destroy/selected/{selected_items}', [ProductReviewController::class, 'destroySelected'])->name('product-reviews.destroy.selected');

        Route::controller(ProductReviewController::class)
            ->prefix('/product-reviews/trash')
            ->name('product-reviews.')
            ->group(function () {
                Route::get('/', 'trashed')->name('trashed');
                Route::post('/{id}/restore', 'restore')->name('restore');
                Route::post('/restore/selected/{selected_items}', 'restoreSelected')->name('restore.selected');
                Route::delete('/{id}/force-delete', 'forceDelete')->name('force-delete');
                Route::delete('/force-delete/selected/{selected_items}', 'forceDeleteSelected')->name('force-delete.selected');
                Route::delete('/force-delete/all', 'forceDeleteAll')->name('force-delete.all');
            });

        // ***** Store Review Operations *****
        Route::resource('store-reviews', StoreReviewController::class)->except(['show','create','store']);

        Route::delete('/store-reviews/destroy/selected/{selected_items}', [StoreReviewController::class, 'destroySelected'])->name('store-reviews.destroy.selected');

        Route::controller(StoreReviewController::class)
            ->prefix('/store-reviews/trash')
            ->name('store-reviews.')
            ->group(function () {
                Route::get('/', 'trashed')->name('trashed');
                Route::post('/{id}/restore', 'restore')->name('restore');
                Route::post('/restore/selected/{selected_items}', 'restoreSelected')->name('restore.selected');
                Route::delete('/{id}/force-delete', 'forceDelete')->name('force-delete');
                Route::delete('/force-delete/selected/{selected_items}', 'forceDeleteSelected')->name('force-delete.selected');
                Route::delete('/force-delete/all', 'forceDeleteAll')->name('force-delete.all');
            });

        // ***** Collection Operations *****
        Route::resource('collections', CollectionController::class)->except(['show']);

        Route::controller(CollectionController::class)
            ->prefix('/collections')
            ->name('collections.')
            ->group(function () {
                Route::delete('/destroy/selected/{selected_items}', 'destroySelected')->name('destroy.selected');
                Route::get('/{collection}/add-product', 'show')->name('show');
                Route::post('/{collection}/add-product', 'addProduct')->name('add-product');
                Route::post('/{collection}/remove-product', 'removeProduct')->name('remove-product');
            });

        Route::controller(CollectionController::class)
            ->prefix('/collections/trash')
            ->name('collections.')
            ->group(function () {
                Route::get('/', 'trashed')->name('trashed');
                Route::post('/{id}/restore', 'restore')->name('restore');
                Route::post('/restore/selected/{selected_items}', 'restoreSelected')->name('restore.selected');
                Route::delete('/{id}/force-delete', 'forceDelete')->name('force-delete');
                Route::delete('/force-delete/selected/{selected_items}', 'forceDeleteSelected')->name('force-delete.selected');
                Route::delete('/force-delete/all', 'forceDeleteAll')->name('force-delete.all');
            });

        // ***** Flash Sale Operations *****
        Route::controller(FlashSaleController::class)
            ->prefix('/flash-sales')
            ->name('flash-sales.')
            ->middleware('permission:flash-sales.edit')
            ->group(function () {
                Route::get('/', 'edit')->name('edit');
                Route::patch('/{flash_sale}', 'update')->name('update');
                Route::post('/{flash_sale}/add-product', 'addProduct')->name('add-product');
                Route::post('/{flash_sale}/remove-product', 'removeProduct')->name('remove-product');
            });

        // ***** Slider Banner Operations *****
        Route::resource('slider-banners', SliderBannerController::class)->except(['show']);

        Route::delete('/slider-banners/destroy/selected/{selected_items}', [SliderBannerController::class, 'destroySelected'])->name('slider-banners.destroy.selected');

        Route::controller(SliderBannerController::class)
            ->prefix('/slider-banners/trash')
            ->name('slider-banners.')
            ->group(function () {
                Route::get('/', 'trashed')->name('trashed');
                Route::post('/{id}/restore', 'restore')->name('restore');
                Route::post('/restore/selected/{selected_items}', 'restoreSelected')->name('restore.selected');
                Route::delete('/{id}/force-delete', 'forceDelete')->name('force-delete');
                Route::delete('/force-delete/selected/{selected_items}', 'forceDeleteSelected')->name('force-delete.selected');
                Route::delete('/force-delete/all', 'forceDeleteAll')->name('force-delete.all');
            });

        // ***** Campaign Banner Operations *****
        Route::resource('campaign-banners', CampaignBannerController::class)->except(['show']);

        Route::delete('/campaign-banners/destroy/selected/{selected_items}', [CampaignBannerController::class, 'destroySelected'])->name('campaign-banners.destroy.selected');

        Route::controller(CampaignBannerController::class)
            ->prefix('/campaign-banners/trash')
            ->name('campaign-banners.')
            ->group(function () {
                Route::get('/', 'trashed')->name('trashed');
                Route::post('/{id}/restore', 'restore')->name('restore');
                Route::post('/restore/selected/{selected_items}', 'restoreSelected')->name('restore.selected');
                Route::delete('/{id}/force-delete', 'forceDelete')->name('force-delete');
                Route::delete('/force-delete/selected/{selected_items}', 'forceDeleteSelected')->name('force-delete.selected');
                Route::delete('/force-delete/all', 'forceDeleteAll')->name('force-delete.all');
            });

        // ***** Product Banner Operations *****
        Route::resource('product-banners', ProductBannerController::class)->except(['show']);

        Route::delete('/product-banners/destroy/selected/{selected_items}', [ProductBannerController::class, 'destroySelected'])->name('product-banners.destroy.selected');

        Route::controller(ProductBannerController::class)
            ->prefix('/product-banners/trash')
            ->name('product-banners.')
            ->group(function () {
                Route::get('/', 'trashed')->name('trashed');
                Route::post('/{id}/restore', 'restore')->name('restore');
                Route::post('/restore/selected/{selected_items}', 'restoreSelected')->name('restore.selected');
                Route::delete('/{id}/force-delete', 'forceDelete')->name('force-delete');
                Route::delete('/force-delete/selected/{selected_items}', 'forceDeleteSelected')->name('force-delete.selected');
                Route::delete('/force-delete/all', 'forceDeleteAll')->name('force-delete.all');
            });

        // ***** Coupon Operations *****
        Route::resource('coupons', CouponController::class)->except(['show']);

        Route::delete('/coupons/destroy/selected/{selected_items}', [CouponController::class, 'destroySelected'])->name('coupons.destroy.selected');

        Route::controller(CouponController::class)
            ->prefix('/coupons/trash')
            ->name('coupons.')
            ->group(function () {
                Route::get('/', 'trashed')->name('trashed');
                Route::post('/{id}/restore', 'restore')->name('restore');
                Route::post('/restore/selected/{selected_items}', 'restoreSelected')->name('restore.selected');
                Route::delete('/{id}/force-delete', 'forceDelete')->name('force-delete');
                Route::delete('/force-delete/selected/{selected_items}', 'forceDeleteSelected')->name('force-delete.selected');
                Route::delete('/force-delete/all', 'forceDeleteAll')->name('force-delete.all');
            });

        // ***** Order Operations *****
        Route::resource('orders', OrderController::class)->except(['show', 'create', 'edit', 'store']);

        Route::controller(OrderController::class)
            ->prefix('/orders')
            ->name('orders.')
            ->group(function () {
                Route::get('/{order}/detail', 'show')->name('show');
                Route::patch('/{order}/status', 'updateOrderStatus')->name('status.update');
                Route::patch('/{order}/payment', 'updatePaymentStatus')->name('payment.update');
                Route::delete('/destroy/selected/{selected_items}', 'destroySelected')->name('destroy.selected');
            });

        Route::get('orders/{order}/download', DownloadOrderInvoiceController::class)->name('order-invoice.download');

        Route::controller(OrderController::class)
            ->prefix('/orders/trash')
            ->name('orders.')
            ->group(function () {
                Route::get('/', 'trashed')->name('trashed');
                Route::post('/{id}/restore', 'restore')->name('restore');
                Route::post('/restore/selected/{selected_items}', 'restoreSelected')->name('restore.selected');
                Route::delete('/{id}/force-delete', 'forceDelete')->name('force-delete');
                Route::delete('/force-delete/selected/{selected_items}', 'forceDeleteSelected')->name('force-delete.selected');
                Route::delete('/force-delete/all', 'forceDeleteAll')->name('force-delete.all');
            });

        // ***** Region Operations *****
        Route::resource('regions', RegionController::class)->except(['show']);

        Route::delete('/regions/destroy/selected/{selected_items}', [RegionController::class, 'destroySelected'])->name('regions.destroy.selected');

        Route::controller(RegionController::class)
            ->prefix('/regions/trash')
            ->name('regions.')
            ->group(function () {
                Route::get('/', 'trashed')->name('trashed');
                Route::post('/{id}/restore', 'restore')->name('restore');
                Route::post('/restore/selected/{selected_items}', 'restoreSelected')->name('restore.selected');
                Route::delete('/{id}/force-delete', 'forceDelete')->name('force-delete');
                Route::delete('/force-delete/selected/{selected_items}', 'forceDeleteSelected')->name('force-delete.selected');
                Route::delete('/force-delete/all', 'forceDeleteAll')->name('force-delete.all');
            });

        // ***** City Operations *****
        Route::resource('cities', CityController::class)->except(['show']);

        Route::delete('/cities/destroy/selected/{selected_items}', [CityController::class, 'destroySelected'])->name('cities.destroy.selected');

        Route::controller(CityController::class)
            ->prefix('/cities/trash')
            ->name('cities.')
            ->group(function () {
                Route::get('/', 'trashed')->name('trashed');
                Route::post('/{id}/restore', 'restore')->name('restore');
                Route::post('/restore/selected/{selected_items}', 'restoreSelected')->name('restore.selected');
                Route::delete('/{id}/force-delete', 'forceDelete')->name('force-delete');
                Route::delete('/force-delete/selected/{selected_items}', 'forceDeleteSelected')->name('force-delete.selected');
                Route::delete('/force-delete/all', 'forceDeleteAll')->name('force-delete.all');
            });

        // ***** Township Operations *****
        Route::resource('townships', TownshipController::class)->except(['show']);

        Route::delete('/townships/destroy/selected/{selected_items}', [TownshipController::class, 'destroySelected'])->name('townships.destroy.selected');

        Route::controller(TownshipController::class)
            ->prefix('/townships/trash')
            ->name('townships.')
            ->group(function () {
                Route::get('/', 'trashed')->name('trashed');
                Route::post('/{id}/restore', 'restore')->name('restore');
                Route::post('/restore/selected/{selected_items}', 'restoreSelected')->name('restore.selected');
                Route::delete('/{id}/force-delete', 'forceDelete')->name('force-delete');
                Route::delete('/force-delete/selected/{selected_items}', 'forceDeleteSelected')->name('force-delete.selected');
                Route::delete('/force-delete/all', 'forceDeleteAll')->name('force-delete.all');
            });

        // ***** Shipping Area Operations *****
        Route::resource('shipping-areas', ShippingAreaController::class)->except(['show']);

        Route::delete('/shipping-areas/destroy/selected/{selected_items}', [ShippingAreaController::class, 'destroySelected'])->name('shipping-areas.destroy.selected');

        Route::controller(ShippingAreaController::class)
            ->prefix('/shipping-areas/trash')
            ->name('shipping-areas.')
            ->group(function () {
                Route::get('/', 'trashed')->name('trashed');
                Route::post('/{id}/restore', 'restore')->name('restore');
                Route::post('/restore/selected/{selected_items}', 'restoreSelected')->name('restore.selected');
                Route::delete('/{id}/force-delete', 'forceDelete')->name('force-delete');
                Route::delete('/force-delete/selected/{selected_items}', 'forceDeleteSelected')->name('force-delete.selected');
                Route::delete('/force-delete/all', 'forceDeleteAll')->name('force-delete.all');
            });

        // ***** Shipping Method Operations *****
        Route::resource('shipping-methods', ShippingMethodController::class)->except(['show']);

        Route::delete('/shipping-methods/destroy/selected/{selected_items}', [ShippingMethodController::class, 'destroySelected'])->name('shipping-methods.destroy.selected');

        Route::controller(ShippingMethodController::class)
            ->prefix('/shipping-methods/trash')
            ->name('shipping-methods.')
            ->group(function () {
                Route::get('/', 'trashed')->name('trashed');
                Route::post('/{id}/restore', 'restore')->name('restore');
                Route::post('/restore/selected/{selected_items}', 'restoreSelected')->name('restore.selected');
                Route::delete('/{id}/force-delete', 'forceDelete')->name('force-delete');
                Route::delete('/force-delete/selected/{selected_items}', 'forceDeleteSelected')->name('force-delete.selected');
                Route::delete('/force-delete/all', 'forceDeleteAll')->name('force-delete.all');
            });

        // ***** Shipping Rate Operations *****
        Route::resource('shipping-rates', ShippingRateController::class)->except(['show']);

        Route::delete('/shipping-rates/destroy/selected/{selected_items}', [ShippingRateController::class, 'destroySelected'])->name('shipping-rates.destroy.selected');

        Route::controller(ShippingRateController::class)
            ->prefix('/shipping-rates/trash')
            ->name('shipping-rates.')
            ->group(function () {
                Route::get('/', 'trashed')->name('trashed');
                Route::post('/{id}/restore', 'restore')->name('restore');
                Route::post('/restore/selected/{selected_items}', 'restoreSelected')->name('restore.selected');
                Route::delete('/{id}/force-delete', 'forceDelete')->name('force-delete');
                Route::delete('/force-delete/selected/{selected_items}', 'forceDeleteSelected')->name('force-delete.selected');
                Route::delete('/force-delete/all', 'forceDeleteAll')->name('force-delete.all');
            });

        // ***** Blog Category Operations *****
        Route::resource('blog-categories', BlogCategoryController::class)->except(['show']);

        Route::delete('/blog-categories/destroy/selected/{selected_items}', [BlogCategoryController::class, 'destroySelected'])->name('blog-categories.destroy.selected');

        Route::controller(BlogCategoryController::class)
            ->prefix('/blog-categories/trash')
            ->name('blog-categories.')
            ->group(function () {
                Route::get('/', 'trashed')->name('trashed');
                Route::post('/{id}/restore', 'restore')->name('restore');
                Route::post('/restore/selected/{selected_items}', 'restoreSelected')->name('restore.selected');
                Route::delete('/{id}/force-delete', 'forceDelete')->name('force-delete');
                Route::delete('/force-delete/selected/{selected_items}', 'forceDeleteSelected')->name('force-delete.selected');
                Route::delete('/force-delete/all', 'forceDeleteAll')->name('force-delete.all');
            });

        // ***** Blog Content Operations *****
        Route::resource('blog-contents', BlogContentController::class)->except(['show']);

        Route::delete('/blog-contents/destroy/selected/{selected_items}', [BlogContentController::class, 'destroySelected'])->name('blog-contents.destroy.selected');

        Route::patch('blog-contents/{blog_content}/change-status', [BlogContentController::class, 'changeStatus'])->name('blog-contents.change-status');

        Route::controller(BlogContentController::class)
            ->prefix('/blog-contents/trash')
            ->name('blog-contents.')
            ->group(function () {
                Route::get('/', 'trashed')->name('trashed');
                Route::post('/{id}/restore', 'restore')->name('restore');
                Route::post('/restore/selected/{selected_items}', 'restoreSelected')->name('restore.selected');
                Route::delete('/{id}/force-delete', 'forceDelete')->name('force-delete');
                Route::delete('/force-delete/selected/{selected_items}', 'forceDeleteSelected')->name('force-delete.selected');
                Route::delete('/force-delete/all', 'forceDeleteAll')->name('force-delete.all');
            });

        // ***** Blog Comment Operations *****
        Route::controller(BlogCommentController::class)
            ->prefix('/blog-comments')
            ->name('blog-comments.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::delete('/{blog_comment}', 'destroy')->name('destroy');
                Route::delete('/destroy/selected/{selected_items}', 'destroySelected')->name('destroy.selected');
            });

        Route::resource('faq-categories', FaqCategoryController::class)->except(['show']);
        Route::controller(FaqCategoryController::class)
            ->prefix('/faq-categories/trash')
            ->name('faq-categories.')
            ->group(function () {
                Route::delete('/destroy/selected/{selected_items}', 'destroySelected')->name('destroy.selected');
                Route::get('/', 'trashed')->name('trashed');
                Route::post('/{id}/restore', 'restore')->name('restore');
                Route::post('/restore/selected/{selected_items}', 'restoreSelected')->name('restore.selected');
                Route::delete('/{id}/force-delete', 'forceDelete')->name('force-delete');
                Route::delete('/force-delete/selected/{selected_items}', 'forceDeleteSelected')->name('force-delete.selected');
                Route::delete('/force-delete/all', 'forceDeleteAll')->name('force-delete.all');
            });

        Route::resource('faq-subcategories', FaqSubcategoryController::class)->except(['show']);
        Route::controller(FaqSubcategoryController::class)
            ->prefix('/faq-subcategories/trash')
            ->name('faq-subcategories.')
            ->group(function () {
                Route::delete('/destroy/selected/{selected_items}', 'destroySelected')->name('destroy.selected');
                Route::get('/', 'trashed')->name('trashed');
                Route::post('/{id}/restore', 'restore')->name('restore');
                Route::post('/restore/selected/{selected_items}', 'restoreSelected')->name('restore.selected');
                Route::delete('/{id}/force-delete', 'forceDelete')->name('force-delete');
                Route::delete('/force-delete/selected/{selected_items}', 'forceDeleteSelected')->name('force-delete.selected');
                Route::delete('/force-delete/all', 'forceDeleteAll')->name('force-delete.all');
            });

        Route::resource('faq-contents', FaqContentController::class)->except(['show']);
        Route::controller(FaqContentController::class)
            ->prefix('/faq-contents/trash')
            ->name('faq-contents.')
            ->group(function () {
                Route::delete('/destroy/selected/{selected_items}', 'destroySelected')->name('destroy.selected');
                Route::get('/', 'trashed')->name('trashed');
                Route::post('/{id}/restore', 'restore')->name('restore');
                Route::post('/restore/selected/{selected_items}', 'restoreSelected')->name('restore.selected');
                Route::delete('/{id}/force-delete', 'forceDelete')->name('force-delete');
                Route::delete('/force-delete/selected/{selected_items}', 'forceDeleteSelected')->name('force-delete.selected');
                Route::delete('/force-delete/all', 'forceDeleteAll')->name('force-delete.all');
            });

        Route::controller(HelpPageController::class)->group(function () {
            Route::get('/privacy-and-policy', 'privacyAndPolicy')->name('privacy-and-policy.edit');
            Route::get('/terms-and-conditions', 'termsAndConditions')->name('terms-and-conditions.edit');
            Route::get('/returns-and-refunds', 'returnsAndRefunds')->name('returns-and-refunds.edit');
            Route::patch('/help-pages/{help_page}', 'update')->name('help-pages.update');
        });

        Route::resource('roles', RoleController::class)->except(['show']);
        Route::controller(RoleController::class)
            ->prefix('/roles/trash')
            ->name('roles.')
            ->group(function () {
                Route::delete('/destroy/selected/{selected_items}', 'destroySelected')->name('destroy.selected');
                Route::get('/', 'trashed')->name('trashed');
                Route::post('/{id}/restore', 'restore')->name('restore');
                Route::post('/restore/selected/{selected_items}', 'restoreSelected')->name('restore.selected');
                Route::delete('/{id}/force-delete', 'forceDelete')->name('force-delete');
                Route::delete('/force-delete/selected/{selected_items}', 'forceDeleteSelected')->name('force-delete.selected');
                Route::delete('/force-delete/all', 'forceDeleteAll')->name('force-delete.all');
            });

        Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');

        Route::resource('assign-role-permissions', AssignRolePermissionsController::class)
            ->except(['show', 'create', 'store'])
            ->parameters([
                'assign-role-permissions' => 'role',
            ]);

        Route::resource('registered-accounts', RegisteredAccountController::class)
            ->only(['index', 'destroy'])
            ->parameters([
                'registered-accounts' => 'user',
            ]);

        Route::patch('registered-accounts/{user}/change-status', [RegisteredAccountController::class, 'changeStatus'])->name('registered-accounts.change-status');

        Route::controller(RegisteredAccountController::class)
            ->prefix('/registered-accounts/trash')
            ->name('registered-accounts.')
            ->group(function () {
                Route::delete('/destroy/selected/{selected_items}', 'destroySelected')->name('destroy.selected');
                Route::get('/', 'trashed')->name('trashed');
                Route::post('/{id}/restore', 'restore')->name('restore');
                Route::post('/restore/selected/{selected_items}', 'restoreSelected')->name('restore.selected');
                Route::delete('/{id}/force-delete', 'forceDelete')->name('force-delete');
                Route::delete('/force-delete/selected/{selected_items}', 'forceDeleteSelected')->name('force-delete.selected');
                Route::delete('/force-delete/all', 'forceDeleteAll')->name('force-delete.all');
            });

        Route::resource('claims-as-a-seller', ClaimsAsASellerController::class)
            ->only(['index', 'destroy'])
            ->parameters([
                'claims-as-a-seller' => 'seller_request',
            ]);

        Route::get('claims-as-a-seller/{seller_request}/detail', [ClaimsAsASellerController::class, 'show'])->name('claims-as-a-seller.show');
        Route::patch('claims-as-a-seller/{seller_request}/change-status', [ClaimsAsASellerController::class, 'changeStatus'])->name('claims-as-a-seller.change-status');

        Route::controller(ClaimsAsASellerController::class)
            ->prefix('/claims-as-a-seller/trash')
            ->name('claims-as-a-seller.')
            ->group(function () {
                Route::delete('/destroy/selected/{selected_items}', 'destroySelected')->name('destroy.selected');
                Route::get('/', 'trashed')->name('trashed');
                Route::post('/{id}/restore', 'restore')->name('restore');
                Route::post('/restore/selected/{selected_items}', 'restoreSelected')->name('restore.selected');
                Route::delete('/{id}/force-delete', 'forceDelete')->name('force-delete');
                Route::delete('/force-delete/selected/{selected_items}', 'forceDeleteSelected')->name('force-delete.selected');
                Route::delete('/force-delete/all', 'forceDeleteAll')->name('force-delete.all');
            });

        Route::resource('store-manage', StoreManageController::class)
            ->only(['index', 'destroy'])
            ->parameters([
                'store-manage' => 'store',
            ]);

        Route::get('store-manage/{store}/detail', [StoreManageController::class, 'show'])->name('store-manage.show');
        Route::patch('store-manage/{store}/change-status', [StoreManageController::class, 'changeStatus'])->name('store-manage.change-status');

        Route::controller(StoreManageController::class)
            ->prefix('/store-manage/trash')
            ->name('store-manage.')
            ->group(function () {
                Route::delete('/destroy/selected/{selected_items}', 'destroySelected')->name('destroy.selected');
                Route::get('/', 'trashed')->name('trashed');
                Route::post('/{id}/restore', 'restore')->name('restore');
                Route::post('/restore/selected/{selected_items}', 'restoreSelected')->name('restore.selected');
                Route::delete('/{id}/force-delete', 'forceDelete')->name('force-delete');
                Route::delete('/force-delete/selected/{selected_items}', 'forceDeleteSelected')->name('force-delete.selected');
                Route::delete('/force-delete/all', 'forceDeleteAll')->name('force-delete.all');
            });

        Route::resource('admin-manage', AdminManageController::class)
            ->except(['show'])
            ->parameters([
                'admin-manage' => 'user',
            ]);

        Route::patch('admin-manage/{user}/change-status', [AdminManageController::class, 'changeStatus'])->name('admin-manage.change-status');

        Route::controller(AdminManageController::class)
            ->prefix('/admin-manage/trash')
            ->name('admin-manage.')
            ->group(function () {
                Route::delete('/destroy/selected/{selected_items}', 'destroySelected')->name('destroy.selected');
                Route::get('/', 'trashed')->name('trashed');
                Route::post('/{id}/restore', 'restore')->name('restore');
                Route::post('/restore/selected/{selected_items}', 'restoreSelected')->name('restore.selected');
                Route::delete('/{id}/force-delete', 'forceDelete')->name('force-delete');
                Route::delete('/force-delete/selected/{selected_items}', 'forceDeleteSelected')->name('force-delete.selected');
                Route::delete('/force-delete/all', 'forceDeleteAll')->name('force-delete.all');
            });

        Route::resource('automated-filter-words', AutomatedFilterWordController::class)->except(['show']);
        Route::controller(AutomatedFilterWordController::class)
            ->prefix('/automated-filter-words/trash')
            ->name('automated-filter-words.')
            ->group(function () {
                Route::delete('/destroy/selected/{selected_items}', 'destroySelected')->name('destroy.selected');
                Route::get('/', 'trashed')->name('trashed');
                Route::post('/{id}/restore', 'restore')->name('restore');
                Route::post('/restore/selected/{selected_items}', 'restoreSelected')->name('restore.selected');
                Route::delete('/{id}/force-delete', 'forceDelete')->name('force-delete');
                Route::delete('/force-delete/selected/{selected_items}', 'forceDeleteSelected')->name('force-delete.selected');
                Route::delete('/force-delete/all', 'forceDeleteAll')->name('force-delete.all');
            });

        Route::controller(GeneralSettingController::class)
            ->prefix('/general-settings')
            ->name('general-settings.')
            ->group(function () {
                Route::get('/', 'edit')->name('edit');
                Route::patch('/{general_setting}', 'update')->name('update');
            });

        Route::controller(SeoSettingController::class)
            ->prefix('/seo-settings')
            ->name('seo-settings.')
            ->group(function () {
                Route::get('/', 'edit')->name('edit');
                Route::patch('/{seo_setting}', 'update')->name('update');
            });

        Route::resource('subscribers', SubscriberController::class)->only(['index', 'destroy']);
        Route::controller(SubscriberController::class)
            ->prefix('/subscribers/trash')
            ->name('subscribers.')
            ->group(function () {
                Route::delete('/destroy/selected/{selected_items}', 'destroySelected')->name('destroy.selected');
                Route::get('/', 'trashed')->name('trashed');
                Route::post('/{id}/restore', 'restore')->name('restore');
                Route::post('/restore/selected/{selected_items}', 'restoreSelected')->name('restore.selected');
                Route::delete('/{id}/force-delete', 'forceDelete')->name('force-delete');
                Route::delete('/force-delete/selected/{selected_items}', 'forceDeleteSelected')->name('force-delete.selected');
                Route::delete('/force-delete/all', 'forceDeleteAll')->name('force-delete.all');
            });

        // ***** Database Backup Operations *****
        Route::controller(DatabaseBackupController::class)
            ->prefix('/database-backups')
            ->name('database-backups.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/', 'backup')->name('backup');
                Route::delete('/{file}', 'destroy')->name('destroy');
                Route::get('/{file}/download', 'download')->name('download');
            });
    });
