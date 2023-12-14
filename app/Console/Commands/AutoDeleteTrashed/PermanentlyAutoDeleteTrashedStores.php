<?php

namespace App\Console\Commands\AutoDeleteTrashed;

use App\Actions\Admin\SellerManagement\StoreManage\PermanentlyDeleteTrashedStoresAction;
use App\Models\Brand;
use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PermanentlyAutoDeleteTrashedStores extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stores:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Stores in the trash will be automatically deleted after 60 days';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $cutoffDate = Carbon::now()->subDays(60);

        $trashedStores = Store::onlyTrashed()->where('deleted_at', '<=', $cutoffDate)->get();

        (new PermanentlyDeleteTrashedStoresAction())->handle($trashedStores);

    }
}
