<?php

namespace App\Http\Controllers\Admin\Dashboard\EcommerceAdministration;

use App\Actions\Admin\Categories\CreateCategoryAction;
use App\Actions\Admin\Categories\UpdateCategoryAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Categories\CategoryRequest;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class AdminCategoryController extends Controller
{
    use HandlesQueryStringParameters;

    public function __construct()
    {
        $this->middleware('permission:categories.view', ['only' => ['index']]);
        $this->middleware('permission:categories.create', ['only' => ['create', 'store']]);
    }

    public function index(): Response|ResponseFactory
    {
        $categories = Category::search(request('search'))
                              ->query(function (Builder $builder) {
                                  $builder->with('children');
                              })
                              ->orderBy(request('sort', 'id'), request('direction', 'desc'))
                              ->paginate(request('per_page', 5))
                              ->appends(request()->all());

        return inertia('Admin/Categories/Index', compact('categories'));
    }

    public function create(): Response|ResponseFactory
    {
        $categories = Category::select('id', 'parent_id', 'name')->get();

        return inertia('Admin/Categories/Create', compact('categories'));
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        (new CreateCategoryAction())->handle($request->validated());

        return to_route('admin.categories.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully created.');
    }

    public function edit(Category $category): Response|ResponseFactory
    {
        $categories = Category::select('id', 'parent_id', 'name')->get();

        return inertia('Admin/Categories/Edit', compact('category', 'categories'));
    }

    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        (new UpdateCategoryAction())->handle($request->validated(), $category);

        return to_route('admin.categories.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully updated.');
    }

    public function destroy(Request $request, Category $category): RedirectResponse
    {
        $category->delete();

        return to_route('admin.categories.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully deleted.');
    }

}
