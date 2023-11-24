<?php

use App\Http\Controllers\Ecommerce\OurBlogs\BlogCommentController;
use App\Http\Controllers\Ecommerce\OurBlogs\BlogCommentReplyController;
use App\Http\Controllers\Ecommerce\OurBlogs\BlogController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('E-commerce/Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::middleware('auth')->group(function () {

    // Route to mark a specific notification as read
    Route::post('/notifications/mark-as-read/{id}', [NotificationController::class, 'markAsRead'])
        ->name('notifications.markAsRead');

    // Route to mark all notifications as read
    Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])
        ->name('notifications.markAllAsRead');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(BlogController::class)
    ->prefix('/blogs')
    ->name('blogs.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{blog_content}', 'show')->name('show');
        //  Route::get("/tags/{tag}", "tagBlog")->name("tag");
    });

Route::post('/blogs/{blog_content}/comments', BlogCommentController::class)->name('blog.comments.store');
Route::post('/blogs/{blog_content}/comments/{blog_comment}/replies', BlogCommentReplyController::class)->name('comment.replies.store');

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
