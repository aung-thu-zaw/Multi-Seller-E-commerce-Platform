<?php

namespace App\Actions\Admin\Categories;

use App\Http\Traits\ImageUpload;
use App\Models\Category;
use App\Services\UploadFiles\CategoryImageUploadService;

class CreateCategoryAction
{
    use ImageUpload;

    /**
     * @param  array<mixed>  $data
     */
    public function handle(array $data): void
    {
        $image = isset($data['image']) ? $this->createImage($data['image'], 'categories') : null;

        Category::create([
            'parent_id' => $data['parent_id'],
            'name' => $data['name'],
            'status' => $data['status'],
            'image' => $image,
        ]);
    }
}
