<?php

namespace App\Actions\Admin\Banners\ProductBanners;

use App\Models\ProductBanner;
use Illuminate\Support\Collection;

class PermanentlyDeleteTrashedProductBannersAction
{
    /**
     * @param  Collection<int,ProductBanner>  $productBanners
     */
    public function handle(Collection $productBanners): void
    {
        $productBanners->each(function ($productBanner) {

            ProductBanner::deleteImage($productBanner->image);

            $productBanner->forceDelete();
        });
    }
}
