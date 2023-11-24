<?php

namespace App\Http\Controllers\Ecommerce\OurBlogs;

use App\Http\Controllers\Controller;
use App\Models\BlogComment;
use App\Models\BlogContent;
use App\Models\User;
use App\Notifications\Blogs\NewBlogCommentFromUserNotification;
use App\Rules\RecaptchaRule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BlogCommentController extends Controller
{
    public function __invoke(Request $request, BlogContent $blogContent): RedirectResponse
    {
        $request->validate([
            "comment" => ["required","string"],
            'captcha_token' => [new RecaptchaRule()],
        ]);

        $blogComment = BlogComment::create([
             "blog_content_id" => $blogContent->id,
             "user_id" => auth()->id(),
             "comment" => $request->comment,
        ]);

        $author = User::findOrFail($blogContent->author_id);

        $commenter = User::findOrFail($blogComment->user_id);

        $author->notify(new NewBlogCommentFromUserNotification($blogContent, $blogComment, $commenter));

        return back();
    }
}
