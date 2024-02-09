<?php

namespace App\Http\Controllers\Ecommerce\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductQuestion;
use App\Models\ProductQuestionAnswer;
use App\Models\Store;
use App\Models\User;
use App\Notifications\User\ProductQuestionAnswerNotification;
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

        $store = $this->getCurrentUserStore();

        $productQuestionAnswer = $this->createProductQuestionAnswer($productQuestion, $store, $request->answer);

        $this->updateProductQuestionStatus($productQuestion);

        $inquirer = $this->getInquirer($productQuestion);

        $this->notifyInquirer($inquirer, $product, $productQuestionAnswer, $store);

        return back();
    }

    private function getCurrentUserStore(): Store
    {
        return Store::where('seller_id', auth()->id())->first();
    }

    private function createProductQuestionAnswer(ProductQuestion $productQuestion, Store $store, string $answer): ProductQuestionAnswer
    {
        return ProductQuestionAnswer::create([
            'product_question_id' => $productQuestion->id,
            'store_id' => $store->id,
            'answer' => $answer,
        ]);
    }

    private function updateProductQuestionStatus(ProductQuestion $productQuestion): void
    {
        $productQuestion->update(['status' => 'answered']);
    }

    private function getInquirer(ProductQuestion $productQuestion): User
    {
        return User::findOrFail($productQuestion->user_id);
    }

    private function notifyInquirer(User $inquirer, Product $product, ProductQuestionAnswer $productQuestionAnswer, Store $store): void
    {
        $inquirer->notify(new ProductQuestionAnswerNotification($product, $productQuestionAnswer, $store));
    }
}
