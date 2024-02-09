<?php

namespace App\Actions\Admin\Banners\CampaignBanners;

use App\Models\CampaignBanner;
use Illuminate\Support\Collection;

class PermanentlyDeleteTrashedCampaignBannersAction
{
    /**
     * @param  Collection<int,CampaignBanner>  $campaignBanners
     */
    public function handle(Collection $campaignBanners): void
    {
        $campaignBanners->each(function ($campaignBanner) {

            CampaignBanner::deleteImage($campaignBanner->image);

            $campaignBanner->forceDelete();
        });
    }
}
