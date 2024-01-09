<?php

namespace App\Http\Controllers\Seller\Dashboard\ReviewManagement;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use App\Models\Store;
use Illuminate\Database\Eloquent\Builder;
use Inertia\Response;
use Inertia\ResponseFactory;

class ProductReviewController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        $storeId = Store::getStoreId();

        $productReviews = ProductReview::search(request('search'))
            ->query(function (Builder $builder) {
                $builder->with(['reviewer:id,name', 'product:id,name,image,slug']);
            })
            ->where('store_id', $storeId)
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Seller/ReviewManagement/ProductReviews/Index', compact('productReviews'));
    }
}
