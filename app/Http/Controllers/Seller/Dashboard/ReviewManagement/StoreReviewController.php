<?php

namespace App\Http\Controllers\Seller\Dashboard\ReviewManagement;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\StoreReview;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class StoreReviewController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        $storeId = Store::getStoreId();

        $storeReviews = StoreReview::search(request('search'))
            ->query(function (Builder $builder) {
                $builder->with(['reviewer:id,name']);
            })
            ->where("store_id", $storeId)
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Seller/ReviewManagement/StoreReviews/Index', compact('storeReviews'));
    }
}
