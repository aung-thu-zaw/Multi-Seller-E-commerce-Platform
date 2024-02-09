<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use Inertia\Response;
use Inertia\ResponseFactory;

class ProductCollectionController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        $collections = Collection::select('id', 'name', 'slug')
            ->with(['products' => function ($query) {
                $query->where('status', 'approved');
            }])
            ->withCount(['products' => function ($query) {
                $query->where('status', 'approved');
            }])
            ->where('status', 'show')
            ->paginate(20);

        return inertia('E-commerce/ProductCollections/Index', compact('collections'));
    }

    public function show(Collection $collection): Response|ResponseFactory
    {
        $products = $collection->products()->select('id', 'store_id', 'image', 'name', 'slug', 'price', 'offer_price')
            ->with(['productImages', 'store:id,store_type'])
            ->withApprovedReviewCount()
            ->withApprovedReviewAvg()
            ->where('status', 'approved')
            ->paginate(20);

        return inertia('E-commerce/ProductCollections/Show', compact('collection', 'products'));
    }
}
