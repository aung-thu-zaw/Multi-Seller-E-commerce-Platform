<?php

namespace App\Actions\Admin\BlogManagement\BlogCategories;

use App\Http\Traits\ImageUpload;
use App\Models\BlogCategory;
use App\Models\Category;
use App\Services\UploadFiles\CategoryImageUploadService;

class UpdateBlogCategoryAction
{
    use ImageUpload;

    /**
     * @param  array<mixed>  $data
     */
    public function handle(array $data, BlogCategory $blogCategory): void
    {
        $image = isset($data['image']) && !is_string($data['image']) ? $this->updateImage($data['image'], $blogCategory->image, 'blog-categories') : $blogCategory->image;

        $blogCategory->update([
            'name' => $data['name'],
            'status' => $data['status'],
            'image' => $image,
        ]);
    }
}
