<?php

namespace App\Console\Commands\AutoDeleteTrashed;

use App\Actions\Admin\Brands\PermanentlyDeleteTrashedBrandsAction;
use App\Models\Brand;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PermanentlyAutoDeleteTrashedBrands extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'brands:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Brands in the trash will be automatically deleted after 60 days';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $cutoffDate = Carbon::now()->subDays(60);

        $brands = Brand::onlyTrashed()->where('deleted_at', '<=', $cutoffDate)->get();

        (new PermanentlyDeleteTrashedBrandsAction())->handle($brands);

    }
}
