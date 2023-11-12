<?php

namespace App\Http\Controllers\Admin\Dashboard\EcommerceAdministration;

use App\Http\Controllers\Controller;
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
        $categories = Category::with('children')->search(request("search"))
                              ->orderBy(request('sort', 'id'), request('direction', 'desc'))
                              ->paginate(request('per_page', 10))
                              ->appends(request()->all());

        return inertia('Admin/EcommerceAdministration/Categories/Index', compact('categories'));
    }

}
