<?php

namespace App\Console\Commands\AutoDeleteTrashed;

use App\Actions\Admin\GeographicHierarchy\Regions\PermanentlyDeleteTrashedRegionsAction;
use App\Models\Region;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PermanentlyAutoDeleteTrashedRegions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'regions:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Regions in the trash will be automatically deleted after 60 days';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $cutoffDate = Carbon::now()->subDays(60);

        $trashedRegions = Region::onlyTrashed()->where('deleted_at', '<=', $cutoffDate)->get();

        (new PermanentlyDeleteTrashedRegionsAction())->handle($trashedRegions);

    }
}
