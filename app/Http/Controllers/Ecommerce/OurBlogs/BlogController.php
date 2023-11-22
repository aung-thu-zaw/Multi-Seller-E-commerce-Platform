<?php

namespace App\Http\Controllers\Ecommerce\OurBlogs;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogContent;
use Inertia\Response;
use Inertia\ResponseFactory;

class BlogController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        $blogCategories = BlogCategory::where("status", "show")->get();

        $blogContents = BlogContent::with("author:id,name")
                                   ->filter(request(["search_blog", "blog_category"]))
                                   ->where("status", "published")
                                   ->orderBy(request("sort", "id"), request("direction", "desc"))
                                   ->paginate(15)
                                   ->withQueryString();

        return inertia("E-commerce/OurBlogs/Index", compact("blogCategories", "blogContents"));
    }
}
