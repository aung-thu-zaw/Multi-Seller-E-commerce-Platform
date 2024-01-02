<?php

namespace App\Http\Controllers\Ecommerce\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductQuestion;
use App\Rules\RecaptchaRule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductQuestionController extends Controller
{
    public function __invoke(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'question' => ['required', 'string'],
            'captcha_token' => [new RecaptchaRule()],
        ]);

        $productQuestion = ProductQuestion::create([
            'product_id' => $product->id,
            'user_id' => auth()->id(),
            'question' => $request->question,
        ]);

        // $author = User::findOrFail($blogContent->author_id);

        // $commenter = User::findOrFail($blogComment->user_id);

        // $author->notify(new NewBlogCommentNotification($blogContent, $blogComment, $commenter));

        return back();
    }
}
