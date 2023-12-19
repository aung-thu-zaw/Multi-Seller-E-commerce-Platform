<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\Store;
use App\Models\StoreReview;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Inertia\ResponseFactory;

class SellerStoreController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        $stores = Store::where('store_name', 'like', '%' . request('search_store') . '%')
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

        $products = Product::select('id', 'store_id', 'image', 'name', 'description', 'slug', 'price', 'offer_price')
            ->with(['productImages',"store:id,store_type"])
            ->withApprovedReviewCount()
            ->withApprovedReviewAvg()
            ->where('store_id', $store->id)
            ->where('status', 'approved')
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(20)
            ->withQueryString();

        $productReviews = ProductReview::with([
           "product:id,name,image",
           "reviewer:id,name,avatar",
           "productReviewResponse.store:id,store_name,avatar",
           "productReviewImages"
        ])
        ->filterByRating(request("rating"))
        ->where("store_id", $store->id)
        ->where('status', 'approved')
        ->sortBy(request('review_sort'))
        ->paginate(5)
        ->withQueryString();


        $storeReviews = StoreReview::with([
            "reviewer:id,name,avatar",
            "storeReviewResponse.store:id,store_name,avatar",
         ])
         ->filterByRating(request("rating"))
         ->where("store_id", $store->id)
         ->where('status', 'approved')
         ->sortBy(request('review_sort'))
         ->paginate(5)
         ->withQueryString();

        $storeReviewsForAverageProgressBar = StoreReview::select("id", "rating")->where("store_id", $store->id)->where('status', 'approved')->get();

        return inertia('E-commerce/OurSellerStores/Show', compact('store', 'products', 'productReviews', 'storeReviews', 'storeReviewsForAverageProgressBar'));
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
