<?php

namespace App\Http\Controllers\Ecommerce\Products;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
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

        $products = Product::select('id', 'category_id', 'brand_id', 'store_id', 'image', 'name', 'description', 'slug', 'price', 'offer_price')
            ->with(['productImages', 'store:id,store_type'])
            ->withApprovedReviewCount()
            ->withApprovedReviewAvg()
            ->filterBy(request(["search", "category", "brand", "rating", "price"]))
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

        return inertia("E-commerce/FilteredSearchProducts/ProductSearch", compact("products", "categories", "brands"));
    }
}
