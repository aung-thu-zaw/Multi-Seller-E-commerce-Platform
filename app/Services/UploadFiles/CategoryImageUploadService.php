<?php

namespace App\Services\UploadFiles;

use App\Models\Category;
use Illuminate\Http\UploadedFile;

class CategoryImageUploadService
{
    public function createImage(UploadedFile $image): ?string
    {
        $originalName = $image->getClientOriginalName();

        $fileName = time().'-'.$originalName;

        $image->storeAs('categories', $fileName);

        return $fileName;
    }

    public function updateImage(UploadedFile $image, ?string $categoryImage): string
    {
        if (is_string($categoryImage)) {

            Category::deleteImage($categoryImage);
        }

        $originalName = $image->getClientOriginalName();

        $fileName = time().'-'.$originalName;

        $image->storeAs('categories', $fileName);

        return $fileName;
    }
}
