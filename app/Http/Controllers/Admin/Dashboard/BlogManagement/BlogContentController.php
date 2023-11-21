<?php

namespace App\Http\Controllers\Admin\Dashboard\BlogManagement;

use App\Actions\Admin\BlogManagement\BlogContents\CreateBlogContentAction;
use App\Actions\Admin\BlogManagement\BlogContents\PermanentlyDeleteTrashedBlogContentsAction;
use App\Actions\Admin\BlogManagement\BlogContents\UpdateBlogContentAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\BlogManagement\BlogContents\StoreBlogContentRequest;
use App\Http\Requests\Dashboard\Admin\BlogManagement\BlogContents\UpdateBlogContentRequest;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\BlogContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class BlogContentController extends Controller
{
    use HandlesQueryStringParameters;

    public function __construct()
    {
        $this->middleware('permission:blog-contents.view', ['only' => ['index']]);
        $this->middleware('permission:blog-contents.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:blog-contents.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:blog-contents.delete', ['only' => ['destroy', 'destroySelected']]);
        $this->middleware('permission:blog-contents.view.trash', ['only' => ['trashed']]);
        $this->middleware('permission:blog-contents.restore', ['only' => ['restore', 'restoreSelected']]);
        $this->middleware('permission:blog-contents.force.delete', ['only' => ['forceDelete', 'forceDeleteSelected', 'forceDeleteAll']]);
    }

    public function index(): Response|ResponseFactory
    {
        $blogContents = BlogContent::search(request('search'))
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/BlogManagement/BlogContents/Index', compact('blogContents'));
    }

    public function create(): Response|ResponseFactory
    {
        return inertia('Admin/BlogManagement/BlogContents/Create');
    }

    public function store(StoreBlogContentRequest $request): RedirectResponse
    {
        (new CreateBlogContentAction())->handle($request->validated());

        return to_route('admin.blog-contents.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully created.');
    }

    public function edit(BlogContent $blogContent): Response|ResponseFactory
    {
        return inertia('Admin/BlogManagement/BlogContents/Edit', compact('blogContent'));
    }

    public function update(UpdateBlogContentRequest $request, BlogContent $blogContent): RedirectResponse
    {
        ( new UpdateBlogContentAction())->handle($request->validated(), $blogContent);

        return to_route('admin.blog-contents.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully updated.');
    }

    public function destroy(Request $request, BlogContent $blogContent): RedirectResponse
    {
        $blogContent->delete();

        return to_route('admin.blog-contents.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully deleted.');
    }

    public function destroySelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        BlogContent::whereIn('id', $selectedItems)->delete();

        return to_route('admin.blog-contents.index', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully deleted.');
    }

    public function trashed(): Response|ResponseFactory
    {
        $trashedBlogContents = BlogContent::search(request('search'))
            ->onlyTrashed()
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/BlogManagement/BlogContents/Trash', compact('trashedBlogContents'));
    }

    public function restore(Request $request, int $trashedBlogContentId): RedirectResponse
    {
        $trashedBlogContent = BlogContent::onlyTrashed()->findOrFail($trashedBlogContentId);

        $trashedBlogContent->restore();

        return to_route('admin.blog-contents.trashed', $this->getQueryStringParams($request))->with('success', ':label has been successfully restored.');
    }

    public function restoreSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        BlogContent::onlyTrashed()
            ->whereIn('id', $selectedItems)
            ->restore();

        return to_route('admin.blog-contents.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully restored.');
    }

    public function forceDelete(Request $request, int $trashedBlogContentId): RedirectResponse
    {
        $trashedBlogContent = BlogContent::onlyTrashed()->findOrFail($trashedBlogContentId);

        BlogContent::deleteImage($trashedBlogContent->thumbnail);

        $trashedBlogContent->forceDelete();

        return to_route('admin.blog-contents.trashed', $this->getQueryStringParams($request))->with('success', 'The :label has been permanently deleted.');
    }

    public function forceDeleteSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        $trashedBlogContents = BlogContent::onlyTrashed()->whereIn('id', $selectedItems)->get();

        (new PermanentlyDeleteTrashedBlogContentsAction())->handle($trashedBlogContents);

        return to_route('admin.blog-contents.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been permanently deleted.');
    }

    public function forceDeleteAll(Request $request): RedirectResponse
    {
        $trashedBlogContents = BlogContent::onlyTrashed()->get();

        (new PermanentlyDeleteTrashedBlogContentsAction())->handle($trashedBlogContents);

        return to_route('admin.blog-contents.trashed', $this->getQueryStringParams($request))->with('success', 'All :label have been permanently deleted.');
    }
}
