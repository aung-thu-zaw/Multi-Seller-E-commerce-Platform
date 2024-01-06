<?php

namespace App\Http\Controllers\Ecommerce\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductQuestion;
use App\Models\Store;
use App\Models\User;
use App\Notifications\Seller\NewProductQuestionNotification;
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

        $productQuestion = $this->createProductQuestion($product, $request->question);

        $seller = $this->getSeller($product);

        $inquirer = $this->getInquirer($productQuestion);

        $this->notifySeller($seller, $product, $productQuestion, $inquirer);

        return back();
    }

    private function createProductQuestion(Product $product, string $question): ProductQuestion
    {
        return ProductQuestion::create([
            'product_id' => $product->id,
            'user_id' => auth()->id(),
            'question' => $question,
            'status' => 'pending',
        ]);
    }

    private function getSeller(Product $product): User
    {
        $store = Store::findOrFail($product->store_id);
        return User::findOrFail($store->seller_id);
    }

    private function getInquirer(ProductQuestion $productQuestion): User
    {
        return User::findOrFail($productQuestion->user_id);
    }

    private function notifySeller(User $seller, Product $product, ProductQuestion $productQuestion, User $inquirer): void
    {
        $seller->notify(new NewProductQuestionNotification($product, $productQuestion, $inquirer));
    }
}
