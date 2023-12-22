<?php

namespace App\Http\Controllers\Ecommerce\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SearchHistory;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class ProductSearchController extends Controller
{
    public function __invoke(): Response|ResponseFactory
    {
        SearchHistory::firstOrCreate(["user_id" => auth()->id() ?? null,"keyword" => request("search")]);

        $products = Product::select('id', 'store_id', 'image', 'name', 'slug', 'price', 'offer_price')
        ->with(['productImages', 'store:id,store_type'])
        ->withApprovedReviewCount()
        ->withApprovedReviewAvg()
        ->where('status', 'approved')
        ->orderBy(request("sort", "id"), request("direction", "desc"))
        ->paginate(20)
        ->withQueryString();

        return inertia("E-commerce/FilteredSearchProducts/ProductSearch", compact("products"));
    }
}
