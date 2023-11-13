<?php

namespace App\Http\Controllers\Admin\Dashboard\EcommerceAdministration;

use App\Actions\Admin\Categories\CreateCategoryAction;
use App\Actions\Admin\Categories\PermanentlyDeleteTrashedCategoriesAction;
use App\Actions\Admin\Categories\UpdateCategoryAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Categories\CategoryRequest;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class CategoryController extends Controller
{
    use HandlesQueryStringParameters;

    public function __construct()
    {
        $this->middleware('permission:categories.view', ['only' => ['index']]);
        $this->middleware('permission:categories.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:categories.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:categories.delete', ['only' => ['destroy', 'destroySelected']]);
        $this->middleware('permission:categories.view.trash', ['only' => ['trashed']]);
        $this->middleware('permission:categories.restore', ['only' => ['restore', 'restoreSelected']]);
        $this->middleware('permission:categories.force.delete', ['only' => ['forceDelete', 'forceDeleteSelected', 'forceDeleteAll']]);
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

    public function destroySelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        Category::whereIn('id', $selectedItems)->delete();

        return to_route('admin.categories.index', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully deleted.');
    }

    public function trashed(): Response|ResponseFactory
    {
        $trashedCategories = Category::search(request('search'))
                                     ->onlyTrashed()
                                     ->orderBy(request('sort', 'id'), request('direction', 'desc'))
                                     ->paginate(request('per_page', 5))
                                     ->appends(request()->all());

        return inertia('Admin/Categories/Trash', compact('trashedCategories'));
    }

    public function restore(Request $request, int $trashedCategoryId): RedirectResponse
    {
        $trashedCategory = Category::onlyTrashed()->findOrFail($trashedCategoryId);

        $trashedCategory->restore();

        return to_route('admin.categories.trashed', $this->getQueryStringParams($request))->with('success', ':label has been successfully restored.');
    }

    public function restoreSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        Category::onlyTrashed()->whereIn('id', $selectedItems)->restore();

        return to_route('admin.categories.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully restored.');
    }

    public function forceDelete(Request $request, int $trashedCategoryId): RedirectResponse
    {
        $trashedCategory = Category::onlyTrashed()->findOrFail($trashedCategoryId);

        Category::deleteImage($trashedCategory->image);

        $trashedCategory->forceDelete();

        return to_route('admin.categories.trashed', $this->getQueryStringParams($request))->with('success', 'The :label has been permanently deleted.');
    }

    public function forceDeleteSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        $trashedCategories = Category::onlyTrashed()->whereIn('id', $selectedItems)->get();

        (new PermanentlyDeleteTrashedCategoriesAction())->handle($trashedCategories);

        return to_route('admin.categories.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been permanently deleted.');
    }

    public function forceDeleteAll(Request $request): RedirectResponse
    {
        $trashedCategories = Category::onlyTrashed()->get();

        (new PermanentlyDeleteTrashedCategoriesAction())->handle($trashedCategories);

        return to_route('admin.categories.trashed', $this->getQueryStringParams($request))->with('success', 'All :label have been permanently deleted.');
    }
}
