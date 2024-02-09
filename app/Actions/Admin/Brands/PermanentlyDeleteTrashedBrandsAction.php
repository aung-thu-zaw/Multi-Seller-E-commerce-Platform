<?php

namespace App\Actions\Admin\Brands;

use App\Models\Brand;
use Illuminate\Support\Collection;

class PermanentlyDeleteTrashedBrandsAction
{
    /**
     * @param  Collection<int,Brand>  $brands
     */
    public function handle(Collection $brands): void
    {
        $brands->each(function ($brand) {

            Brand::deleteImage($brand->logo);

            $brand->forceDelete();
        });
    }
}
