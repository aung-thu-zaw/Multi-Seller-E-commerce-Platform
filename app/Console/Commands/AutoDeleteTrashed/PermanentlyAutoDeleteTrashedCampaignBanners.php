<?php

namespace App\Console\Commands\AutoDeleteTrashed;

use App\Actions\Admin\Banners\CampaignBanners\PermanentlyDeleteTrashedCampaignBannersAction;
use App\Models\CampaignBanner;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PermanentlyAutoDeleteTrashedCampaignBanners extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'campaign-banners:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Campaign banners in the trash will be automatically deleted after 60 days';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $cutoffDate = Carbon::now()->subDays(60);

        $trashedCampaignBanners = CampaignBanner::onlyTrashed()->where('deleted_at', '<=', $cutoffDate)->get();

        (new PermanentlyDeleteTrashedCampaignBannersAction())->handle($trashedCampaignBanners);

    }
}
