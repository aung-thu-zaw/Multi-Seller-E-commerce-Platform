<?php

namespace App\Http\Controllers\Seller\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ProductQuestion;
use App\Models\Scopes\FilterByScope;
use App\Models\Store;
use Illuminate\Database\Eloquent\Builder;
use Inertia\Response;
use Inertia\ResponseFactory;

class ProductQuestionController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        $productQuestions = ProductQuestion::search(request('search'))
            ->query(function (Builder $builder) {
                $builder->with(['product' => function ($query) {
                    $query->select('id', 'name', 'slug', 'image')
                        ->withoutGlobalScope(FilterByScope::class);
                }])
                    ->whereHas('product', function (Builder $builder) {
                        $builder->withoutGlobalScope(FilterByScope::class)->where('store_id', Store::getStoreId());
                    });
            })
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Seller/ProductQuestions/Index', compact('productQuestions'));
    }
}
