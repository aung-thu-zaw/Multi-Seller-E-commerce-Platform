<?php

namespace App\Http\Controllers\Ecommerce\OurBlogs;

use App\Http\Controllers\Controller;
use App\Models\BlogComment;
use App\Models\BlogCommentReply;
use App\Models\BlogContent;
use App\Rules\RecaptchaRule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BlogCommentReplyController extends Controller
{
    public function __invoke(Request $request, BlogContent $blogContent, BlogComment $blogComment): RedirectResponse
    {
        $request->validate([
            "reply" => ["required","string"],
            'captcha_token' => [new RecaptchaRule()],
        ]);

        BlogCommentReply::create([
             "blog_comment_id" => $blogComment->id,
             "user_id" => auth()->id(),
             "reply" => $request->reply,
        ]);

        return back();
    }
}
