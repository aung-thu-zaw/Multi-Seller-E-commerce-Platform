<?php

namespace App\Actions\Admin\BlogManagement\BlogContents;

use App\Http\Traits\ImageUpload;
use App\Models\BlogContent;
use App\Models\Category;
use App\Services\UploadFiles\CategoryImageUploadService;

class UpdateBlogContentAction
{
    use ImageUpload;

    /**
     * @param  array<mixed>  $data
     */
    public function handle(array $data, BlogContent $blogContent): void
    {
        $thumbnail = isset($data['thumbnail']) && !is_string($data['thumbnail']) ? $this->updateImage($data['thumbnail'], $blogContent->thumbnail, 'blog-categories') : $blogContent->thumbnail;

        $blogContent->update([
            'blog_category_id' => $data['blog_category_id'],
            'author_id' => $data['author_id'],
            'title' => $data['title'],
            'content' => $data['content'],
            'status' => $data['status'],
            'thumbnail' => $thumbnail,
        ]);
    }
}
