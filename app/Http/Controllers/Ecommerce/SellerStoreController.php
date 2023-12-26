<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\Store;
use App\Models\StoreReview;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Inertia\ResponseFactory;

class SellerStoreController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        $stores = Store::where('store_name', 'like', '%'.request('search_store').'%')
            ->withCount(['products', 'followers'])
            ->withAvg(['storeReviews' => function ($query) {
                $query->where('status', 'approved');
            }], 'rating')
            ->where('status', 'active')
            ->paginate(30)
            ->appends(request()->all());

        return inertia('E-commerce/OurSellerStores/Index', compact('stores'));
    }

    public function show(Store $store): Response|ResponseFactory
    {
        $store->load(['followers:id']);

        $store->loadAvg('storeReviews', 'rating');

        $justForYouProducts = Product::select('id', 'category_id', 'brand_id', 'store_id', 'image', 'name', 'slug', 'price', 'offer_price')
            ->with(['productImages', 'store:id,store_type'])
            ->withApprovedReviewCount()
            ->withApprovedReviewAvg()
            ->where('store_id', $store->id)
            ->where('status', 'approved')
            ->inRandomOrder()
            ->limit(25)
            ->get();

        $products = Product::select('id', 'category_id', 'brand_id', 'store_id', 'image', 'name', 'description', 'slug', 'price', 'offer_price')
            ->with(['productImages', 'store:id,store_type'])
            ->withApprovedReviewCount()
            ->withApprovedReviewAvg()
            ->filterBy(request(["search", "category", "brand", "rating", "price"]))
            ->where('store_id', $store->id)
            ->where('status', 'approved')
            ->sortBy(request('sort'))
            ->paginate(20)
            ->withQueryString();

        $categoryIds = $products->pluck('category_id')->unique()->toArray();
        $brandIds = $products->pluck('brand_id')->unique()->toArray();

        $categories = [];
        $brands = [];

        if (!empty($categoryIds)) {
            $categories = Category::select("id", "name", "slug")->whereIn('id', $categoryIds)->where("status", "show")->get();
        }

        if (!empty($brandIds)) {
            $brands = Brand::select("id", "name", "slug")->whereIn('id', $brandIds)->where("status", "active")->get();
        }

        if(request("category")) {

            $selectedCategory = Category::where("slug", request("category"))->first();

            $brands = Brand::select("id", "name", "slug")->where("category_id", $selectedCategory->id)->where("status", "active")->get();
        }

        if (request("brand")) {
            $brandSlugs = explode('--', request("brand"));

            $selectedBrands = Brand::whereIn("slug", $brandSlugs)->where("status", "active")->get();

            if ($selectedBrands->isNotEmpty()) {
                $categoryIds = $selectedBrands->pluck('category_id')->unique()->toArray();

                $categories = Category::select("id", "name", "slug")->whereIn('id', $categoryIds)->where("status", "show")->get();
            }
        }

        $productReviews = ProductReview::with([
            'product:id,name,image',
            'reviewer:id,name,avatar',
            'productReviewResponse.store:id,store_name,avatar',
            'productReviewImages',
        ])
            ->filterByRating(request('rating'))
            ->where('store_id', $store->id)
            ->where('status', 'approved')
            ->sortBy(request('review_sort'))
            ->paginate(5)
            ->withQueryString();

        $storeReviews = StoreReview::with([
            'reviewer:id,name,avatar',
            'storeReviewResponse.store:id,store_name,avatar',
        ])
            ->filterByRating(request('rating'))
            ->where('store_id', $store->id)
            ->where('status', 'approved')
            ->sortBy(request('review_sort'))
            ->paginate(5)
            ->withQueryString();

        $storeReviewsForAverageProgressBar = StoreReview::select('id', 'rating')->where('store_id', $store->id)->where('status', 'approved')->get();

        return inertia('E-commerce/OurSellerStores/Show', compact('store', 'brands', 'categories', 'justForYouProducts', 'products', 'productReviews', 'storeReviews', 'storeReviewsForAverageProgressBar'));
    }

    public function followStore(Store $store): RedirectResponse
    {
        $user = User::findOrFail(auth()->id());

        $user->follow($store);

        return back()->with('success', 'You have successfully followed this store.');
    }

    public function unFollowStore(Store $store): RedirectResponse
    {
        $user = User::findOrFail(auth()->id());

        $user->unfollow($store);

        return back()->with('success', 'You have successfully unfollowed this store.');
    }
}
