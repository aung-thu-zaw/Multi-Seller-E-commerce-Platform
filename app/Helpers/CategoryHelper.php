<?php

namespace App\Helpers;

use App\Models\Category;

class CategoryHelper
{
    public static function getChildCategoryIds(int $categoryId)
    {
        $childIds = Category::where('parent_id', $categoryId)->pluck('id')->toArray();
        foreach ($childIds as $childId) {
            $childIds = array_merge($childIds, self::getChildCategoryIds($childId));
        }

        return $childIds;
    }
}
