<?php

namespace App\Http\Controllers\Ecommerce\Products;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Product;
use App\Models\ProductQuestion;
use App\Models\ProductReview;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class ProductDetailController extends Controller
{
    public function show(Request $request, Product $product): Response|ResponseFactory
    {
        $product->load(['productImages', 'brand:id,name', 'store:id,store_type,seller_id', 'skus']);

        $attributes = Attribute::pluck('name', 'id');

        $options = $this->getSelectableOptionsFromProduct($product);

        $price = $this->calculatePrice($product, $request);

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

        return inertia('E-commerce/Products/Show', compact('product', 'attributes', 'options', 'price', 'productQuestions', 'productsFromTheSameStore', 'alsoViewedProducts', 'productReviewsForAverageProgressBar', 'productReviews'));
    }

    private function calculatePrice(Product $product, Request $request): ?array
    {
        $price = null;
        if ($request->filled('attributes')) {
            $price = [
                'found' => false,
                'price' => null,
                'sku' => null,
            ];

            $skuQuery = $product->skus()->where(function ($q) use ($request) {
                foreach ($request->input('attributes', []) as $attribute => $option) {
                    $q->whereHas('attributeOptions', function (Builder $q) use ($attribute, $option) {
                        return $q->where('id', $option)
                            ->where('attribute_id', $attribute);
                    });
                }
            });
            if ($sku = $skuQuery->first()) {
                $price['found'] = true;
                $price['price'] = $sku->price;
                $price['sku'] = $sku->code;
            }
        }

        return $price;
    }

    private function getSelectableOptionsFromProduct(Product $product): array
    {
        $product->load([
            'skus.attributeOptions.attribute',
        ]);

        $allOptions = [];

        foreach ($product->skus as $sku) {
            foreach ($sku->attributeOptions->groupBy('attribute_id') as $attributeID => $options) {
                $allOptions[$attributeID][] = $options->toArray();
            }
        }
        foreach ($allOptions as $attribute => $options) {

            $allOptions[$attribute] = collect($options)
                ->flatten(1)
                ->unique('id')
                ->toArray();
        }

        return $allOptions;
    }
}
