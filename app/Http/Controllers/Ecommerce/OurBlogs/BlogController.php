<?php

namespace App\Http\Controllers\Ecommerce\OurBlogs;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\BlogContent;
use Inertia\Response;
use Inertia\ResponseFactory;
use Jorenvh\Share\Share;

class BlogController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        $blogCategories = BlogCategory::select('id', 'name', 'slug', 'image')
            ->where('status', 'show')
            ->get();

        $blogContents = BlogContent::with('author:id,name')
            ->select('id', 'author_id', 'thumbnail', 'title', 'slug', 'content', 'published_at')
            ->filter(request(['search_blog', 'blog_category', 'tag']))
            ->where('status', 'published')
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(15)
            ->withQueryString();

        return inertia('E-commerce/OurBlogs/Index', compact('blogCategories', 'blogContents'));
    }

    public function show(BlogContent $blogContent): Response|ResponseFactory
    {
        $shares = (new Share())
            ->currentPage("$blogContent->title")
            ->facebook()
            ->twitter()
            ->linkedIn()
            ->reddit()
            ->telegram()
            ->whatsApp()
            ->getRawLinks();

        $blogCategories = BlogCategory::select('id', 'name', 'slug', 'image')
            ->where('status', 'show')
            ->get();

        $blogContent->load(['author:id,name', 'blogCategory:id,name', 'blogTags:id,name']);

        $relatedBlogContents = BlogContent::with('author:id,name')
            ->select('id', 'author_id', 'thumbnail', 'title', 'slug', 'published_at')
            ->where('blog_category_id', $blogContent->blog_category_id)
            ->where('slug', '!=', $blogContent->slug)
            ->limit(10)
            ->get();

        $blogComments = BlogComment::with(['user:id,name,avatar', 'blogCommentReplies.user:id,name,avatar'])
            ->where('blog_content_id', $blogContent->id)
            ->orderBy('id', 'desc')
            ->paginate(5);

        return inertia('E-commerce/OurBlogs/Show', compact('shares', 'blogCategories', 'blogContent', 'relatedBlogContents', 'blogComments'));
    }
}
