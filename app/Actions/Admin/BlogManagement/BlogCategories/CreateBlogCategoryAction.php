<?php

namespace App\Actions\Admin\BlogManagement\BlogCategories;

use App\Http\Traits\ImageUpload;
use App\Models\BlogCategory;
use App\Models\Category;
use App\Services\UploadFiles\CategoryImageUploadService;

class CreateBlogCategoryAction
{
    use ImageUpload;

    /**
     * @param  array<mixed>  $data
     */
    public function handle(array $data): void
    {
        $image = isset($data['image']) ? $this->createImage($data['image'], 'blog-categories') : null;

        BlogCategory::create([
            'name' => $data['name'],
            'status' => $data['status'],
            'image' => $image,
        ]);
    }
}
