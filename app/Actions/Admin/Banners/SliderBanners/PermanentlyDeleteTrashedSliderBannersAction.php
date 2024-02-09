<?php

namespace App\Actions\Admin\Banners\SliderBanners;

use App\Models\SliderBanner;
use Illuminate\Support\Collection;

class PermanentlyDeleteTrashedSliderBannersAction
{
    /**
     * @param  Collection<int,SliderBanner>  $sliderBanners
     */
    public function handle(Collection $sliderBanners): void
    {
        $sliderBanners->each(function ($sliderBanner) {

            SliderBanner::deleteImage($sliderBanner->image);

            $sliderBanner->forceDelete();
        });
    }
}
