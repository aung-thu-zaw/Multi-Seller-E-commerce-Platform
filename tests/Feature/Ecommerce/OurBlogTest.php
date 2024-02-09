<?php

use App\Models\BlogCategory;
use App\Models\BlogContent;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\get;

it('successfully renders the blog index page with correct props', function () {
    // Arrange
    $author = User::factory()->create(['role' => 'admin']);
    $blogCategory = BlogCategory::factory(10)->create(['status' => 'show']);
    BlogContent::factory(20)->create(['blog_category_id' => $blogCategory->pluck('id')->first(), 'author_id' => $author->id, 'status' => 'published']);

    // Act & Assert
    get(route('blogs.index'))
        ->assertOk()
        ->assertInertia(
            fn (Assert $page) => $page
                ->component('E-commerce/OurBlogs/Index')
                ->has('blogCategories', 10)
                ->has(
                    'blogCategories.0',
                    fn (Assert $page) => $page
                        ->has('id')
                        ->has('name')
                        ->has('slug')
                        ->has('image'),
                )
                ->has('blogContents.data', 15)
                ->has(
                    'blogContents.data.0',
                    fn (Assert $page) => $page
                        ->has('id')
                        ->has('author_id')
                        ->has('title')
                        ->has('slug')
                        ->has('thumbnail')
                        ->has('content')
                        ->has('published_at')
                        ->has('author', fn (Assert $page) => $page->has('id')->has('name')),
                ),
        );
});

it('successfully renders the blog show page with correct props', function () {
    // Arrange
    $author = User::factory()->create(['role' => 'admin']);
    $blogCategory = BlogCategory::factory(10)->create(['status' => 'show']);
    $blogContent = BlogContent::factory()->create(['blog_category_id' => $blogCategory->pluck('id')->first(), 'author_id' => $author->id, 'status' => 'published']);

    // Act & Assert
    get(route('blogs.show', $blogContent))
        ->assertOk()
        ->assertInertia(
            fn (Assert $page) => $page
                ->component('E-commerce/OurBlogs/Show')
                ->has('blogCategories', 10)
                ->has(
                    'blogCategories.0',
                    fn (Assert $page) => $page
                        ->has('id')
                        ->has('name')
                        ->has('slug')
                        ->has('image'),
                )
                ->has(
                    'blogContent',
                    fn (Assert $page) => $page
                        ->has('id')
                        ->has('author_id')
                        ->has('blog_category_id')
                        ->has('title')
                        ->has('slug')
                        ->has('thumbnail')
                        ->has('content')
                        ->has('published_at')
                        ->has('author', fn (Assert $page) => $page->has('id')->has('name'))
                        ->has('blog_category', fn (Assert $page) => $page->has('id')->has('name'))
                        ->has('blog_tags')
                        ->etc()
                )
                ->has('relatedBlogContents')
                ->has('blogComments')
        );
});
