<?php

namespace App\Http\Controllers\Seller\Dashboard\ReviewManagement;

use App\Http\Controllers\Controller;
use App\Models\Scopes\FilterByScope;
use App\Models\Store;
use App\Models\StoreReview;
use Illuminate\Database\Eloquent\Builder;
use Inertia\Response;
use Inertia\ResponseFactory;

class StoreReviewController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        $storeReviews = StoreReview::search(request('search'))
            ->query(function (Builder $builder) {
                $builder->with(['reviewer' => function ($query) {
                    $query->select('id', 'name')
                        ->withoutGlobalScope(FilterByScope::class);
                }]);
            })
            ->where('store_id', Store::getStoreId())
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Seller/ReviewManagement/StoreReviews/Index', compact('storeReviews'));
    }
}
