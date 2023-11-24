<?php

namespace App\Actions\Admin\BlogManagement\BlogContents;

use App\Http\Traits\ImageUpload;
use App\Models\BlogContent;
use App\Services\HandleBlogTagService;

class CreateBlogContentAction
{
    use ImageUpload;

    /**
     * @param  array<mixed>  $data
     */
    public function handle(array $data): void
    {
        $thumbnail = isset($data['thumbnail']) ? $this->createImage($data['thumbnail'], 'blog-contents') : null;

        $blogContent = BlogContent::create([
            'blog_category_id' => $data['blog_category_id'],
            'author_id' => $data['author_id'],
            'title' => $data['title'],
            'content' => $data['content'],
            'status' => $data['status'],
            'thumbnail' => $thumbnail,
        ]);

        if (isset($data['tags'])) {

            (new HandleBlogTagService())->handle($data['tags'], $blogContent);

        }
    }
}
