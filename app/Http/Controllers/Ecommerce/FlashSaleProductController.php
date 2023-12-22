<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class FlashSaleProductController extends Controller
{
    public function __invoke(): Response|ResponseFactory
    {
        $flashSale = FlashSale::first();

        $products = $flashSale->products()->select('products.id', 'store_id', 'image', 'name', 'slug', 'price', 'offer_price')
        ->with(['productImages', 'store:id,store_type'])
        ->withApprovedReviewCount()
        ->withApprovedReviewAvg()
        ->orderBy('products.id', 'desc')
        ->paginate(20);

        return inertia("E-commerce/FlashSaleProducts/Show", compact("flashSale", "products"));
    }
}
