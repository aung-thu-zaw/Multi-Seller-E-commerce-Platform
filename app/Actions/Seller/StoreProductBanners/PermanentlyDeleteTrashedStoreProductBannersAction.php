<?php

namespace App\Actions\Seller\StoreProductBanners;

use App\Models\Store;
use App\Models\StoreProductBanner;
use Illuminate\Support\Collection;

class PermanentlyDeleteTrashedStoreProductBannersAction
{
    /**
     * @param  Collection<int,StoreProductBanner>  $storeProductBanners
     */
    public function handle(Collection $storeProductBanners): void
    {
        $storeProductBanners->each(function ($storeProductBanner) {

            $storeProductBanner->checkStoreAccess(Store::getStoreId());

            StoreProductBanner::deleteImage($storeProductBanner->image);

            $storeProductBanner->forceDelete();
        });
    }
}
