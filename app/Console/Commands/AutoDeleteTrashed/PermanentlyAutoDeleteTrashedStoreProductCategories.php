<?php

namespace App\Console\Commands\AutoDeleteTrashed;

use App\Actions\Seller\StoreProductCategories\PermanentlyDeleteTrashedStoreProductCategoriesAction;
use App\Models\StoreProductCategory;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PermanentlyAutoDeleteTrashedStoreProductCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'store-product-categories:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store product categories in the trash will be automatically deleted after 60 days';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $cutoffDate = Carbon::now()->subDays(60);

        $trashedStoreProductCategories = StoreProductCategory::onlyTrashed()->where('deleted_at', '<=', $cutoffDate)->get();

        (new PermanentlyDeleteTrashedStoreProductCategoriesAction())->handle($trashedStoreProductCategories);

    }
}
