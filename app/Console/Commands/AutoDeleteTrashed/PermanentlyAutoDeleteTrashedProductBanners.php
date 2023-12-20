<?php

namespace App\Console\Commands\AutoDeleteTrashed;

use App\Actions\Admin\Banners\ProductBanners\PermanentlyDeleteTrashedProductBannersAction;
use App\Models\ProductBanner;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PermanentlyAutoDeleteTrashedProductBanners extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product-banners:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Product banners in the trash will be automatically deleted after 60 days';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $cutoffDate = Carbon::now()->subDays(60);

        $trashedProductBanners = ProductBanner::onlyTrashed()->where('deleted_at', '<=', $cutoffDate)->get();

        (new PermanentlyDeleteTrashedProductBannersAction())->handle($trashedProductBanners);

    }
}
