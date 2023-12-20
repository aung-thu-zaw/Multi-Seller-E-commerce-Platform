<?php

use App\Http\Controllers\Ecommerce\BecomeASellerController;
use App\Http\Controllers\Ecommerce\HelpAndSupport\ContactUsController;
use App\Http\Controllers\Ecommerce\HelpAndSupport\FaqController;
use App\Http\Controllers\Ecommerce\HelpAndSupport\FaqFeedbackController;
use App\Http\Controllers\Ecommerce\HelpAndSupport\HelpCenterController;
use App\Http\Controllers\Ecommerce\HelpAndSupport\QuestionSearchController;
use App\Http\Controllers\Ecommerce\HomeController;
use App\Http\Controllers\Ecommerce\OurBlogs\BlogCommentController;
use App\Http\Controllers\Ecommerce\OurBlogs\BlogCommentReplyController;
use App\Http\Controllers\Ecommerce\OurBlogs\BlogController;
use App\Http\Controllers\Ecommerce\Pages\AboutUsController;
use App\Http\Controllers\Ecommerce\Products\ProductDetailController;
use App\Http\Controllers\Ecommerce\SellerStoreController;
use App\Http\Controllers\Ecommerce\WishlistController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::controller(BecomeASellerController::class)
    ->prefix('/become-a-seller')
    ->name('become-a-seller.')
    ->group(function () {
        Route::get('/register', 'create')->name('register');
        Route::post('/', 'store')->name('store');
    });

Route::get('/', HomeController::class)->name('home');
Route::get('/products/{product}', [ProductDetailController::class, 'show'])->name('products.show');

Route::controller(NotificationController::class)
    ->middleware('auth')
    ->prefix('/notifications')
    ->name('notifications.')
    ->group(function () {
        Route::post('/mark-as-read/{id}', 'markAsRead')->name('mark-as-read');
        Route::post('/mark-all-as-read', 'markAllAsRead')->name('mark-all-as-read');
    });

Route::controller(ContactUsController::class)
    ->prefix('/contact-us')
    ->name('contact-us.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/send-email', 'sendEmail')->name('send-email');
    });

Route::controller(BlogController::class)
    ->prefix('/blogs')
    ->name('blogs.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{blog_content}', 'show')->name('show');
    });

Route::post('/blogs/{blog_content}/comments', BlogCommentController::class)->name('blog.comments.store');
Route::post('/blogs/{blog_content}/comments/{blog_comment}/replies', BlogCommentReplyController::class)->name('comment.replies.store');

Route::get('/help-center', HelpCenterController::class)->name('help-center');
Route::get('/help-center/questions/search', QuestionSearchController::class)->name('help-center.questions.search');

Route::controller(FaqController::class)
    ->prefix('/faqs')
    ->name('faqs.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{faq_content}', 'show')->name('show');
    });

Route::post('/faqs/{faq_content}/feedbacks', FaqFeedbackController::class)->name('faqs.feedbacks');

Route::get('/stores', [SellerStoreController::class, 'index'])->name('stores.index');
Route::get('/stores/{store}', [SellerStoreController::class, 'show'])->name('stores.show');
Route::post('/stores/{store}/follow', [SellerStoreController::class, 'followStore'])->middleware('auth')->name('stores.follow');
Route::post('/stores/{store}/unfollow', [SellerStoreController::class, 'unFollowStore'])->middleware('auth')->name('stores.unfollow');

Route::get('/about-us', AboutUsController::class)->name('about-us');

Route::post('/wishlists', [WishlistController::class, 'store'])->middleware('auth')->name('wishlists.store');

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/seller.php';
require __DIR__.'/user.php';
