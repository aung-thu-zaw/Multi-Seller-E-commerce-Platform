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

// Pages
Route::get('/about-us', AboutUsController::class)->name('about-us');

// For claims as a seller
Route::controller(BecomeASellerController::class)
    ->prefix('/become-a-seller')
    ->name('become-a-seller.')
    ->group(function () {
        Route::get('/register', 'create')->name('register');
        Route::post('/', 'store')->name('store');
    });

// For broadcast notifications
Route::controller(NotificationController::class)
->middleware('auth')
->prefix('/notifications')
->name('notifications.')
->group(function () {
    Route::post('/mark-as-read/{id}', 'markAsRead')->name('mark-as-read');
    Route::post('/mark-all-as-read', 'markAllAsRead')->name('mark-all-as-read');
});

// Home page and product detail
Route::get('/', HomeController::class)->name('home');
Route::get('/products/{product}', [ProductDetailController::class, 'show'])->name('products.show');


// Support And Helps
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

Route::controller(ContactUsController::class)
    ->prefix('/contact-us')
    ->name('contact-us.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/send-email', 'sendEmail')->name('send-email');
    });

// Our Blogs
Route::controller(BlogController::class)
->prefix('/blogs')
->name('blogs.')
->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{blog_content}', 'show')->name('show');
});
Route::post('/blogs/{blog_content}/comments', BlogCommentController::class)->name('blog.comments.store');
Route::post('/blogs/{blog_content}/comments/{blog_comment}/replies', BlogCommentReplyController::class)->name('comment.replies.store');

// Our Seller Stores
Route::controller(SellerStoreController::class)
->prefix('/stores')
->name('stores.')
->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{store}', 'show')->name('show');
    Route::post('/{store}/follow', 'followStore')->middleware('auth')->name('follow');
    Route::post('/{store}/unfollow', 'unFollowStore')->middleware('auth')->name('unfollow');
});

Route::post('/wishlists', [WishlistController::class, 'store'])->middleware('auth')->name('wishlists.store');

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/seller.php';
require __DIR__.'/user.php';
