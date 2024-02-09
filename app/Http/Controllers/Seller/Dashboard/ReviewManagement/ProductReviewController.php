<?php

namespace App\Http\Controllers\Seller\Dashboard\ReviewManagement;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use App\Models\Scopes\FilterByScope;
use App\Models\Store;
use Illuminate\Database\Eloquent\Builder;
use Inertia\Response;
use Inertia\ResponseFactory;

class ProductReviewController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        $productReviews = ProductReview::search(request('search'))
            ->query(function (Builder $builder) {
                $builder->with(['product' => function ($query) {
                    $query->select('id', 'name', 'slug', 'image')
                        ->withoutGlobalScope(FilterByScope::class);
                },'reviewer' => function ($query) {
                    $query->select('id', 'name')
                        ->withoutGlobalScope(FilterByScope::class);
                }])->filterByScope();
            })
            ->where('store_id', Store::getStoreId())
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Seller/ReviewManagement/ProductReviews/Index', compact('productReviews'));
    }
}
