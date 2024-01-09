<?php

namespace App\Http\Controllers\Ecommerce\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductQuestion;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;
use Jorenvh\Share\Share;

class ProductDetailController extends Controller
{
    public function show(Request $request, Product $product): Response|ResponseFactory
    {
        $product->load(['productImages', 'brand:id,name', 'store:id,store_type,seller_id', 'skus.attributeOptions.attribute']);

        $shares = (new Share())
            ->currentPage("$product->name")
            ->facebook()
            ->twitter()
            ->reddit()
            ->telegram()
            ->whatsApp()
            ->getRawLinks();

        $product->loadAvg(['productReviews' => function ($query) {
            $query->where('status', 'approved');
        }], 'rating');

        $productQuestions = ProductQuestion::with(['user:id,name,avatar', 'productQuestionAnswer.store:id,store_name,avatar', 'product:id,store_id'])
            ->where('product_id', $product->id)
            ->orderBy('id', 'desc')
            ->paginate(5);

        $productReviews = ProductReview::with([
            'reviewer:id,name,avatar',
            'productReviewResponse.store:id,store_name,avatar',
            'productReviewImages',
        ])
            ->filterByRating(request('rating'))
            ->where('product_id', $product->id)
            ->where('status', 'approved')
            ->sortBy(request('review_sort'))
            ->paginate(5)
            ->withQueryString();

        $productReviewsForAverageProgressBar = ProductReview::select('id', 'rating')->where('product_id', $product->id)->where('status', 'approved')->get();

        $productsFromTheSameStore = Product::select('id', 'store_id', 'image', 'name', 'slug', 'price', 'offer_price')
            ->with(['productImages', 'store:id,store_type'])
            ->withApprovedReviewCount()
            ->withApprovedReviewAvg()
            ->where('store_id', $product->store_id)
            ->where('id', '!=', $product->id)
            ->where('status', 'approved')
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get();

        $alsoViewedProducts = Product::select('id', 'store_id', 'image', 'name', 'slug', 'price', 'offer_price')
            ->whereHas('viewers', function ($query) use ($product) {
                $query->whereIn('users.id', $product->viewers->pluck('id'));
            })
            ->where('id', '!=', $product->id)
            ->where('category_id', $product->category_id)
            ->inRandomOrder()
            ->limit(10)
            ->get();

        // $recommendedProducts = $user->viewedProducts()->inRandomOrder()->limit(5)->get();

        return inertia('E-commerce/Products/Show', compact('product', 'shares', 'productQuestions', 'productsFromTheSameStore', 'alsoViewedProducts', 'productReviewsForAverageProgressBar', 'productReviews'));
    }
}
