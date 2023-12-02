<?php

namespace App\Http\Controllers\Admin\Dashboard\BlogManagement;

use App\Http\Controllers\Controller;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\BlogComment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class BlogCommentController extends Controller
{
    use HandlesQueryStringParameters;

    public function index(): Response|ResponseFactory
    {
        $blogComments = BlogComment::search(request('search'))
            ->query(function (Builder $builder) {
                $builder->with('blogContent:id,title,slug')->select('id', 'blog_content_id', 'comment');
            })
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/BlogManagement/BlogComments/Index', compact('blogComments'));
    }

    public function destroy(Request $request, BlogComment $blogComment): RedirectResponse
    {
        $blogComment->delete();

        return to_route('admin.blog-comments.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully deleted.');
    }

    public function destroySelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        BlogComment::whereIn('id', $selectedItems)->delete();

        return to_route('admin.blog-comments.index', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully deleted.');
    }
}
