<?php

namespace App\Http\Controllers\Admin\Dashboard\EcommerceAdministration;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\Category;
use Inertia\Response;
use Inertia\ResponseFactory;

class AdminCategoryController extends Controller
{
    use HandlesQueryStringParameters;

    public function __construct()
    {
        $this->middleware('permission:categories.view', ['only' => ['index']]);
    }

    public function index(): Response|ResponseFactory
    {
        $categories = Category::search(request('search'))
                              ->query(function (Builder $builder) {
                                  $builder->with('children');
                              })
                              ->orderBy(request('sort', 'id'), request('direction', 'desc'))
                              ->paginate(request('per_page', 10))
                              ->appends(request()->all());

        return inertia('Admin/EcommerceAdministration/Categories/Index', compact('categories'));
    }

    public function create(): Response|ResponseFactory
    {
        $categories = Category::select('id', 'parent_id', 'name')->get();

        return inertia('Admin/EcommerceAdministration/Categories/Create', compact('categories'));
    }

}
