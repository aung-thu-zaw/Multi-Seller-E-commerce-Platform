<?php

namespace App\Actions\Admin\Categories;

use App\Http\Traits\ImageUpload;
use App\Models\Category;

class UpdateCategoryAction
{
    use ImageUpload;

    /**
     * @param  array<mixed>  $data
     */
    public function handle(array $data, Category $category): void
    {
        $image = isset($data['image']) && ! is_string($data['image']) ? $this->updateImage($data['image'], $category->image, 'categories') : $category->image;

        $category->update([
            'parent_id' => $data['parent_id'],
            'name' => $data['name'],
            'status' => $data['status'],
            'image' => $image,
        ]);
    }
}
