<?php

namespace App\Http\Controllers\Ecommerce\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductQuestion;
use App\Models\ProductQuestionAnswer;
use App\Models\Store;
use App\Rules\RecaptchaRule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductQuestionAnswerController extends Controller
{
    public function __invoke(Request $request, Product $product, ProductQuestion $productQuestion): RedirectResponse
    {
        $request->validate([
            'answer' => ['required', 'string'],
            'captcha_token' => [new RecaptchaRule()],
        ]);

        $store = Store::where("user_id", auth()->id())->first();

        $productQuestionAnswer = ProductQuestionAnswer::create([
            'product_question_id' => $productQuestion->id,
            'store_id' => $store->id,
            'answer' => $request->answer,
        ]);

        // $replyPerson = User::findOrFail($blogCommentReply->user_id);

        // $commenter = User::findOrFail($blogComment->user_id);

        // $commenter->notify(new BlogCommentReplyNotification($blogContent, $blogCommentReply, $replyPerson));

        return back();
    }
}
