<?php

namespace App\Actions\Admin\Categories;

use App\Models\Category;
use Illuminate\Support\Collection;

class PermanentlyDeleteTrashedCategoriesAction
{
    /**
     * @param  Collection<int,Category>  $categories
     */
    public function handle(Collection $categories): void
    {
        $categories->each(function ($category) {

            Category::deleteImage($category->image);

            $category->forceDelete();
        });
    }
}
