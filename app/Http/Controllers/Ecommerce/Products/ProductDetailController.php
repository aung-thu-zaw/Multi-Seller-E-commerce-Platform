<?php

namespace App\Http\Controllers\Ecommerce\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class ProductDetailController extends Controller
{
    public function show(Product $product): Response|ResponseFactory
    {
        $product->load(["productImages","brand:id,name","store:id,store_type"]);

        $product->loadAvg(['productReviews' => function ($query) {
            $query->where('status', 'approved');
        }], 'rating');

        $productReviews = ProductReview::with([
            "reviewer:id,name,avatar",
            "productReviewResponse.store:id,store_name,avatar",
            "productReviewImages"
         ])
         ->filterByRating(request("rating"))
         ->where("product_id", $product->id)
         ->where('status', 'approved')
         ->sortBy(request('review_sort'))
         ->paginate(5)
         ->withQueryString();

        $productReviewsForAverageProgressBar = ProductReview::select("id", "rating")->where("product_id", $product->id)->where('status', 'approved')->get();

        $productsFromTheSameStore = Product::select('id', 'store_id', 'image', 'name', 'slug', 'price', 'offer_price')
        ->with(['productImages',"store:id,store_type"])
        ->withApprovedReviewCount()
        ->withApprovedReviewAvg()
        ->where("store_id", $product->store_id)
        ->where("id", "!=", $product->id)
        ->where('status', 'approved')
        ->orderBy("id", "desc")
        ->limit(5)
        ->get();


        return inertia("E-commerce/Products/Show", compact("product", "productsFromTheSameStore", "productReviewsForAverageProgressBar", "productReviews"));
    }
}
