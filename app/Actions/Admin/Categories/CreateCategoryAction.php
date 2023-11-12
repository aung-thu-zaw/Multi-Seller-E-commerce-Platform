<?php

namespace App\Actions\Admin\Categories;

use App\Models\Category;
use App\Services\UploadFiles\CategoryImageUploadService;

class CreateCategoryAction
{
    /**
     * @param  array<mixed>  $data
     */
    public function handle(array $data): void
    {
        $image = isset($data['image']) ? (new CategoryImageUploadService())->createImage($data['image']) : null;

        Category::create([
            'parent_id' => $data['parent_id'],
            'name' => $data['name'],
            'status' => $data['status'],
            'image' => $image,
        ]);
    }
}
