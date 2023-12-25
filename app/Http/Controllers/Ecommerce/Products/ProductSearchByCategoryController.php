<?php

namespace App\Http\Controllers\Ecommerce\Products;

use App\Helpers\CategoryHelper;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class ProductSearchByCategoryController extends Controller
{
    public function __invoke(Category $category): Response|ResponseFactory
    {
        $category->load("parent.parent.parent.parent.parent");

        $categoryIds = CategoryHelper::getChildCategoryIds($category->id);
        $categoryIds[] = $category->id;

        $products = Product::select('id', 'category_id', 'brand_id', 'store_id', 'image', 'name', 'description', 'slug', 'price', 'offer_price')
            ->with(['productImages', 'store:id,store_type'])
            ->withApprovedReviewCount()
            ->withApprovedReviewAvg()
            ->filterBy(request(["search", "category", "brand", "rating", "price"]))
            ->whereIn("category_id", $categoryIds)
            ->where('status', 'approved')
            ->sortBy(request('sort'))
            ->paginate(20)
            ->withQueryString();

        $categories = $category->children()->select("id", "name", "slug")->where("status", "show")->get();

        $brands = Brand::select("id", "name", "slug")->whereIn('category_id', $categoryIds)->where("status", "active")->get();

        return inertia("E-commerce/FilteredSearchProducts/ProductSearchByCategory", compact("category", "products", "categories", "brands"));
    }
}
