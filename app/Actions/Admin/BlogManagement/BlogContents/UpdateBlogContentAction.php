<?php

namespace App\Actions\Admin\BlogManagement\BlogContents;

use App\Http\Traits\ImageUpload;
use App\Models\BlogContent;
use App\Services\HandleBlogTagService;

class UpdateBlogContentAction
{
    use ImageUpload;

    /**
     * @param  array<mixed>  $data
     */
    public function handle(array $data, BlogContent $blogContent): void
    {
        $thumbnail = isset($data['thumbnail']) && ! is_string($data['thumbnail']) ? $this->updateImage($data['thumbnail'], $blogContent->thumbnail, 'blog-contents') : $blogContent->thumbnail;

        $blogContent->update([
            'blog_category_id' => $data['blog_category_id'],
            'author_id' => auth()->id(),
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
