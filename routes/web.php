<?php

use App\Http\Controllers\Ecommerce\BecomeASellerController;
use App\Http\Controllers\Ecommerce\Conversations\ConversationController;
use App\Http\Controllers\Ecommerce\Conversations\ConversationMessageController;
use App\Http\Controllers\Ecommerce\FlashSaleProductController;
use App\Http\Controllers\Ecommerce\HelpAndSupport\ContactUsController;
use App\Http\Controllers\Ecommerce\HelpAndSupport\FaqController;
use App\Http\Controllers\Ecommerce\HelpAndSupport\FaqFeedbackController;
use App\Http\Controllers\Ecommerce\HelpAndSupport\HelpCenterController;
use App\Http\Controllers\Ecommerce\HelpAndSupport\QuestionSearchController;
use App\Http\Controllers\Ecommerce\HomeController;
use App\Http\Controllers\Ecommerce\MyCartController;
use App\Http\Controllers\Ecommerce\OurBlogs\BlogCommentController;
use App\Http\Controllers\Ecommerce\OurBlogs\BlogCommentReplyController;
use App\Http\Controllers\Ecommerce\OurBlogs\BlogController;
use App\Http\Controllers\Ecommerce\Pages\AboutUsController;
use App\Http\Controllers\Ecommerce\ProductCollectionController;
use App\Http\Controllers\Ecommerce\Products\ProductDetailController;
use App\Http\Controllers\Ecommerce\Products\ProductSearchByCategoryController;
use App\Http\Controllers\Ecommerce\Products\ProductSearchController;
use App\Http\Controllers\Ecommerce\SellerStoreController;
use App\Http\Controllers\Ecommerce\SubscribeNewsLetterController;
use App\Http\Controllers\Ecommerce\UpdateSearchHistoryController;
use App\Http\Controllers\Ecommerce\WishlistController;
use App\Http\Controllers\NotificationController;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Route;

// Pages
Route::get('/about-us', AboutUsController::class)->name('about-us');
Route::get('/terms-and-conditions', AboutUsController::class)->name('terms-and-conditions');
Route::get('/privacy-and-policy', AboutUsController::class)->name('privacy-and-policy');
Route::get('/returns-and-refunds', AboutUsController::class)->name('returns-and-refunds');

// Newsletter Subscribe
Route::controller(SubscribeNewsLetterController::class)
    ->prefix('/newsletters')
    ->name('newsletters.')
    ->group(function () {
        Route::post('/subscribe', 'subscribe')->name('subscribe');
        Route::put('/unsubscribe', 'unsubscribe')->name('unsubscribe');
    });

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

// Search Products and Search by Category Products
Route::get('products', ProductSearchController::class)->name('products.search');
Route::get('{category}/products', ProductSearchByCategoryController::class)->name('products.category');
Route::patch('/search-histories/{search_history}', UpdateSearchHistoryController::class)->name('search-histories.update');

// Collection section
Route::controller(ProductCollectionController::class)
    ->prefix('/collections')
    ->name('collections.products.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{collection}/products', 'show')->name('show');
    });

//  FlashSale Products
Route::get('/flash-sale/products', FlashSaleProductController::class)->name('flash-sale.products.show');

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
        Route::post('/{store}/follow', 'followStore')
            ->middleware('auth')
            ->name('follow');
        Route::post('/{store}/unfollow', 'unFollowStore')
            ->middleware('auth')
            ->name('unfollow');
    });

// Seller and Customer Communication
Route::post('/conversations', [ConversationController::class, 'store'])
    ->name('conversations.store')
    ->middleware('auth');
Route::post('/conversations/{conversation}/messages', [ConversationMessageController::class, 'store'])
    ->name('conversation.messages.store')
    ->middleware('auth');

// Wishlist And Add To Cart
Route::post('/wishlists', [WishlistController::class, 'store'])
    ->middleware('auth')
    ->name('wishlists.store');

Route::controller(MyCartController::class)
    ->prefix('/cart/cart-items')
    ->name('cart-items.')
    ->group(function () {
        Route::post('/', 'store')->name('store');
        Route::patch('/{cart_item}', 'update')->name('update');
        Route::delete('/{cart_item}', 'destroy')->name('destroy');
    });

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/seller.php';
require __DIR__ . '/user.php';
