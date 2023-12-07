<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Dashboard\AuthorityManagement\RoleController;
use App\Http\Controllers\Admin\Dashboard\BlogManagement\BlogCategoryController;
use App\Http\Controllers\Admin\Dashboard\BlogManagement\BlogCommentController;
use App\Http\Controllers\Admin\Dashboard\BlogManagement\BlogContentController;
use App\Http\Controllers\Admin\Dashboard\BrandController;
use App\Http\Controllers\Admin\Dashboard\CategoryController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Dashboard\Faqs\FaqCategoryController;
use App\Http\Controllers\Admin\Dashboard\Faqs\FaqContentController;
use App\Http\Controllers\Admin\Dashboard\Faqs\FaqSubcategoryController;
use App\Http\Controllers\Admin\Dashboard\HelpPageController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/login', LoginController::class)
    ->middleware('guest')
    ->name('admin.login');

Route::middleware(['auth', 'verified', 'user.role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', DashboardController::class)->name('dashboard');

        // Category Operations
        Route::resource('categories', CategoryController::class)->except(['show']);
        Route::controller(CategoryController::class)
            ->prefix('/categories/trash')
            ->name('categories.')
            ->group(function () {
                Route::delete('/destroy/selected/{selected_items}', 'destroySelected')->name('destroy.selected');
                Route::get('/', 'trashed')->name('trashed');
                Route::post('/{id}/restore', 'restore')->name('restore');
                Route::post('/restore/selected/{selected_items}', 'restoreSelected')->name('restore.selected');
                Route::delete('/{id}/force-delete', 'forceDelete')->name('force-delete');
                Route::delete('/force-delete/selected/{selected_items}', 'forceDeleteSelected')->name('force-delete.selected');
                Route::delete('/force-delete/all', 'forceDeleteAll')->name('force-delete.all');
            });

        // Brand Operations
        Route::resource('brands', BrandController::class)->except(['show']);
        Route::controller(BrandController::class)
            ->prefix('/brands/trash')
            ->name('brands.')
            ->group(function () {
                Route::delete('/destroy/selected/{selected_items}', 'destroySelected')->name('destroy.selected');
                Route::get('/', 'trashed')->name('trashed');
                Route::post('/{id}/restore', 'restore')->name('restore');
                Route::post('/restore/selected/{selected_items}', 'restoreSelected')->name('restore.selected');
                Route::delete('/{id}/force-delete', 'forceDelete')->name('force-delete');
                Route::delete('/force-delete/selected/{selected_items}', 'forceDeleteSelected')->name('force-delete.selected');
                Route::delete('/force-delete/all', 'forceDeleteAll')->name('force-delete.all');
            });

        // Blog Category Operations
        Route::resource('blog-categories', BlogCategoryController::class)->except(['show']);
        Route::controller(BlogCategoryController::class)
            ->prefix('/blog-categories/trash')
            ->name('blog-categories.')
            ->group(function () {
                Route::delete('/destroy/selected/{selected_items}', 'destroySelected')->name('destroy.selected');
                Route::get('/', 'trashed')->name('trashed');
                Route::post('/{id}/restore', 'restore')->name('restore');
                Route::post('/restore/selected/{selected_items}', 'restoreSelected')->name('restore.selected');
                Route::delete('/{id}/force-delete', 'forceDelete')->name('force-delete');
                Route::delete('/force-delete/selected/{selected_items}', 'forceDeleteSelected')->name('force-delete.selected');
                Route::delete('/force-delete/all', 'forceDeleteAll')->name('force-delete.all');
            });

        // Blog Content Operations
        Route::resource('blog-contents', BlogContentController::class)->except(['show']);
        Route::patch('blog-contents/{blog_content}/change-status', [BlogContentController::class, 'changeStatus'])->name('blog-contents.change-status');
        Route::controller(BlogContentController::class)
            ->prefix('/blog-contents/trash')
            ->name('blog-contents.')
            ->group(function () {
                Route::delete('/destroy/selected/{selected_items}', 'destroySelected')->name('destroy.selected');
                Route::get('/', 'trashed')->name('trashed');
                Route::post('/{id}/restore', 'restore')->name('restore');
                Route::post('/restore/selected/{selected_items}', 'restoreSelected')->name('restore.selected');
                Route::delete('/{id}/force-delete', 'forceDelete')->name('force-delete');
                Route::delete('/force-delete/selected/{selected_items}', 'forceDeleteSelected')->name('force-delete.selected');
                Route::delete('/force-delete/all', 'forceDeleteAll')->name('force-delete.all');
            });

        Route::controller(BlogCommentController::class)
            ->prefix('/blog-comments')
            ->name('blog-comments.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::delete('/{blog_comment}', 'destroy')->name('destroy');
                Route::delete('/destroy/selected/{selected_items}', 'destroySelected')->name('destroy.selected');
            });

        // FAQ Category Operations
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

        // FAQ Subcategory Operations
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

        // FAQ Content Operations
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

        // Help Page Operations
        Route::controller(HelpPageController::class)->group(function () {
            Route::get('/privacy-and-policy', 'privacyAndPolicy')->name('privacy-and-policy.edit');
            Route::get('/terms-and-conditions', 'termsAndConditions')->name('terms-and-conditions.edit');
            Route::get('/returns-and-refunds', 'returnsAndRefunds')->name('returns-and-refunds.edit');
            Route::patch('/help-pages/{help_page}', 'update')->name('help-pages.update');
        });

        // Role Operations
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
    });
