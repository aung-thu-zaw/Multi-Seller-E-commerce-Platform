<?php

namespace App\Actions\User\MyReviews;

use App\Models\Brand;
use Illuminate\Support\Collection;

class PermanentlyDeleteTrashedProductReviewsAction
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
