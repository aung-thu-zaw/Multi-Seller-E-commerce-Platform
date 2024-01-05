<?php

namespace App\Actions\Seller\StoreProductCategories;

use App\Models\Store;
use App\Models\StoreProductCategory;
use Illuminate\Support\Collection;

class PermanentlyDeleteTrashedStoreProductCategoriesAction
{
    /**
     * @param  Collection<int,StoreProductCategory>  $storeProductCategories
     */
    public function handle(Collection $storeProductCategories): void
    {
        $storeProductCategories->each(function ($storeProductCategory) {

            $storeProductCategory->checkStoreAccess(Store::getStoreId());

            $storeProductCategory->forceDelete();
        });
    }
}
