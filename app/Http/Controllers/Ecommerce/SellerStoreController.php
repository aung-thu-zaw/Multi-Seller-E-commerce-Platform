<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\Store;
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
            ->withCount(['productReviews' => function ($query) {
                $query->where('status', 'approved');
            }])
            ->withAvg(['productReviews' => function ($query) {
                $query->where('status', 'approved');
            }], 'rating')
            ->where('store_id', $store->id)
            ->where('status', 'approved')
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(20)
            ->withQueryString();

        $productReviews = ProductReview::with(["product:id,name,image","reviewer:id,name,avatar","productReviewResponse.store:id,store_name,avatar","productReviewImages"])
        ->where("store_id", $store->id)
        ->where("status", "approved")
        ->paginate(5)
        ->withQueryString();

        return inertia('E-commerce/OurSellerStores/Show', compact('store', 'products', 'productReviews'));
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
