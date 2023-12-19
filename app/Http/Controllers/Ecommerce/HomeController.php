<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductBanner;
use Illuminate\Contracts\View\View;
use Inertia\Response;
use Inertia\ResponseFactory;

class HomeController extends Controller
{
    public function __invoke(): Response|ResponseFactory
    {
        $productBanners = ProductBanner::select("id", "image", "url")
        ->where("status", "show")
        ->orderBy("id", "desc")
        ->limit(10)
        ->get();

        $products = Product::select('id', 'store_id', 'image', 'name', 'slug', 'price', 'offer_price')
        ->with(['productImages',"store:id,store_type"])
        ->withApprovedReviewCount()
        ->withApprovedReviewAvg()
        ->where('status', 'approved')
        ->orderBy("id", "desc")
        ->paginate(20);

        return inertia('E-commerce/Home', compact("productBanners", "products"));
    }
    // public function __invoke(): View
    // {
    //     return view('mails.seller.store-activation');
    // }
}
