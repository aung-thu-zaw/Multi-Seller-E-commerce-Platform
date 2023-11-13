<?php

namespace App\Actions\Admin\Categories;

use App\Models\Category;
use App\Services\UploadFiles\CategoryImageUploadService;

class UpdateCategoryAction
{
    /**
     * @param  array<mixed>  $data
     */
    public function handle(array $data, Category $category): void
    {
        $image = isset($data['image']) ? (new CategoryImageUploadService())->updateImage($data['image'], $category->image) : $category->image;

        $category->update([
            'parent_id' => $data['parent_id'],
            'name' => $data['name'],
            'status' => $data['status'],
            'image' => $image,
        ]);
    }
}
