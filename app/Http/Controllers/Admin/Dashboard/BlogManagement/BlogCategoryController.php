<?php

namespace App\Http\Controllers\Admin\Dashboard\BlogManagement;

use App\Actions\Admin\BlogManagement\BlogCategories\CreateBlogCategoryAction;
use App\Actions\Admin\BlogManagement\BlogCategories\PermanentlyDeleteTrashedBlogCategoriesAction;
use App\Actions\Admin\BlogManagement\BlogCategories\UpdateBlogCategoryAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\BlogManagement\BlogCategories\StoreBlogCategoryRequest;
use App\Http\Requests\Dashboard\Admin\BlogManagement\BlogCategories\UpdateBlogCategoryRequest;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\BlogCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class BlogCategoryController extends Controller
{
    use HandlesQueryStringParameters;

    public function __construct()
    {
        $this->middleware('permission:blog-categories.view', ['only' => ['index']]);
        $this->middleware('permission:blog-categories.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:blog-categories.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:blog-categories.delete', ['only' => ['destroy', 'destroySelected']]);
        $this->middleware('permission:blog-categories.view.trash', ['only' => ['trashed']]);
        $this->middleware('permission:blog-categories.restore', ['only' => ['restore', 'restoreSelected']]);
        $this->middleware('permission:blog-categories.force.delete', ['only' => ['forceDelete', 'forceDeleteSelected', 'forceDeleteAll']]);
    }

    public function index(): Response|ResponseFactory
    {
        $blogCategories = BlogCategory::search(request('search'))
                              ->orderBy(request('sort', 'id'), request('direction', 'desc'))
                              ->paginate(request('per_page', 5))
                              ->appends(request()->all());

        return inertia('Admin/BlogManagement/BlogCategories/Index', compact('blogCategories'));
    }

    public function create(): Response|ResponseFactory
    {
        return inertia('Admin/BlogManagement/BlogCategories/Create');
    }

    public function store(StoreBlogCategoryRequest $request): RedirectResponse
    {
        (new CreateBlogCategoryAction())->handle($request->validated());

        return to_route('admin.blog-categories.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully created.');
    }

    public function edit(BlogCategory $blogCategory): Response|ResponseFactory
    {
        return inertia('Admin/BlogManagement/BlogCategories/Edit', compact('blogCategory'));
    }

    public function update(UpdateBlogCategoryRequest $request, BlogCategory $blogCategory): RedirectResponse
    {
        (new UpdateBlogCategoryAction())->handle($request->validated(), $blogCategory);

        return to_route('admin.blog-categories.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully updated.');
    }

    public function destroy(Request $request, BlogCategory $blogCategory): RedirectResponse
    {
        $blogCategory->delete();

        return to_route('admin.blog-categories.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully deleted.');
    }

    public function destroySelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        BlogCategory::whereIn('id', $selectedItems)->delete();

        return to_route('admin.blog-categories.index', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully deleted.');
    }

    public function trashed(): Response|ResponseFactory
    {
        $trashedBlogCategories = BlogCategory::search(request('search'))
                                     ->onlyTrashed()
                                     ->orderBy(request('sort', 'id'), request('direction', 'desc'))
                                     ->paginate(request('per_page', 5))
                                     ->appends(request()->all());

        return inertia('Admin/BlogManagement/BlogCategories/Trash', compact('trashedBlogCategories'));
    }

    public function restore(Request $request, int $trashedBlogCategoryId): RedirectResponse
    {
        $trashedBlogCategory = BlogCategory::onlyTrashed()->findOrFail($trashedBlogCategoryId);

        $trashedBlogCategory->restore();

        return to_route('admin.blog-categories.trashed', $this->getQueryStringParams($request))->with('success', ':label has been successfully restored.');
    }

    public function restoreSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        BlogCategory::onlyTrashed()->whereIn('id', $selectedItems)->restore();

        return to_route('admin.blog-categories.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully restored.');
    }

    public function forceDelete(Request $request, int $trashedBlogCategoryId): RedirectResponse
    {
        $trashedBlogCategory = BlogCategory::onlyTrashed()->findOrFail($trashedBlogCategoryId);

        BlogCategory::deleteImage($trashedBlogCategory->image);

        $trashedBlogCategory->forceDelete();

        return to_route('admin.blog-categories.trashed', $this->getQueryStringParams($request))->with('success', 'The :label has been permanently deleted.');
    }

    public function forceDeleteSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        $trashedBlogCategories = BlogCategory::onlyTrashed()->whereIn('id', $selectedItems)->get();

        (new PermanentlyDeleteTrashedBlogCategoriesAction())->handle($trashedBlogCategories);

        return to_route('admin.blog-categories.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been permanently deleted.');
    }

    public function forceDeleteAll(Request $request): RedirectResponse
    {
        $trashedBlogCategories = BlogCategory::onlyTrashed()->get();

        (new PermanentlyDeleteTrashedBlogCategoriesAction())->handle($trashedBlogCategories);

        return to_route('admin.blog-categories.trashed', $this->getQueryStringParams($request))->with('success', 'All :label have been permanently deleted.');
    }
}
