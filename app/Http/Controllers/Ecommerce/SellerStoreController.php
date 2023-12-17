<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Database\Eloquent\Builder;
use Inertia\Response;
use Inertia\ResponseFactory;

class SellerStoreController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        $stores = Store::search(request('search_store'))
            ->query(function (Builder $builder) {
                $builder->with(['products:id,store_id'])->select('id', 'slug', 'store_name', 'avatar');
            })
            ->where('status', 'active')
            ->paginate(30)
            ->appends(request()->all());

        return inertia('E-commerce/OurSellerStores/Index', compact('stores'));
    }

    public function show(Store $store): Response|ResponseFactory
    {
        return inertia('E-commerce/OurSellerStores/Show', compact('store'));
    }
}
