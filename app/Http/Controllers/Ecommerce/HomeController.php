<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\CampaignBanner;
use App\Models\Collection;
use App\Models\Product;
use App\Models\ProductBanner;
use App\Models\SliderBanner;
use Illuminate\Contracts\View\View;
use Inertia\Response;
use Inertia\ResponseFactory;

class HomeController extends Controller
{
    public function __invoke(): Response|ResponseFactory
    {
        $brands = Brand::where('status', 'active')->get();

        $sliderBanners = SliderBanner::select('id', 'image', 'url')
            ->where('status', 'show')
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();

        $campaignBanner = CampaignBanner::select('id', 'image', 'url')
            ->where('status', 'show')
            ->first();

        $productBanners = ProductBanner::select('id', 'image', 'url')
            ->where('status', 'show')
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();


        $collections = Collection::select("id", "name", "slug")
        ->with(['products' => function ($query) {
            $query->where('status', 'approved');
        }])
        ->withCount(['products' => function ($query) {
            $query->where('status', 'approved');
        }])
        ->where("status", "show")
        ->limit(12)
        ->get();

        $products = Product::select('id', 'store_id', 'image', 'name', 'slug', 'price', 'offer_price')
            ->with(['productImages', 'store:id,store_type'])
            ->withApprovedReviewCount()
            ->withApprovedReviewAvg()
            ->where('status', 'approved')
            ->orderBy('id', 'desc')
            ->paginate(20);

        return inertia('E-commerce/Home', compact('brands', 'sliderBanners', 'campaignBanner', 'productBanners', 'collections', 'products'));
    }
    // public function __invoke(): View
    // {
    //     return view('mails.seller.store-activation');
    // }
}
