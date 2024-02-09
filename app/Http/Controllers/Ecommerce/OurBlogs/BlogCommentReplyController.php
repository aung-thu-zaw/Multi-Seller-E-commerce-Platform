<?php

namespace App\Http\Controllers\Ecommerce\OurBlogs;

use App\Http\Controllers\Controller;
use App\Models\BlogComment;
use App\Models\BlogCommentReply;
use App\Models\BlogContent;
use App\Models\User;
use App\Notifications\User\BlogCommentReplyNotification;
use App\Rules\RecaptchaRule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BlogCommentReplyController extends Controller
{
    public function __invoke(Request $request, BlogContent $blogContent, BlogComment $blogComment): RedirectResponse
    {
        $request->validate([
            'reply' => ['required', 'string'],
            'captcha_token' => [new RecaptchaRule()],
        ]);

        $blogCommentReply = BlogCommentReply::create([
            'blog_comment_id' => $blogComment->id,
            'user_id' => auth()->id(),
            'reply' => $request->reply,
        ]);

        $replyPerson = User::findOrFail($blogCommentReply->user_id);

        $commenter = User::findOrFail($blogComment->user_id);

        $commenter->notify(new BlogCommentReplyNotification($blogContent, $blogCommentReply, $replyPerson));

        return back();
    }
}
