<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
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
        $stores = Store::search(request('search_store'))
            ->query(function (Builder $builder) {
                $builder->withCount(['products','followers']);
            })
            ->where('status', 'active')
            ->paginate(30)
            ->appends(request()->all());

        return inertia('E-commerce/OurSellerStores/Index', compact('stores'));
    }

    public function show(Store $store): Response|ResponseFactory
    {
        $store->load(["followers:id"]);

        return inertia('E-commerce/OurSellerStores/Show', compact('store'));
    }


    public function followStore(Store $store): RedirectResponse
    {
        $user = User::findOrFail(auth()->id());

        $user->follow($store);

        return back()->with("success", "You have successfully followed this store.");
    }

    public function unFollowStore(Store $store): RedirectResponse
    {
        $user = User::findOrFail(auth()->id());

        $user->unfollow($store);

        return back()->with("success", "You have successfully unfollowed this store.");
    }
}
