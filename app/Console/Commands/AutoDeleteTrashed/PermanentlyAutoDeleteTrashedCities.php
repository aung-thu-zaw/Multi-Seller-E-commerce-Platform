<?php

namespace App\Console\Commands\AutoDeleteTrashed;

use App\Actions\Admin\GeographicHierarchy\Cities\PermanentlyDeleteTrashedCitiesAction;
use App\Models\City;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PermanentlyAutoDeleteTrashedCities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cities:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cities in the trash will be automatically deleted after 60 days';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $cutoffDate = Carbon::now()->subDays(60);

        $trashedCities = City::onlyTrashed()->where('deleted_at', '<=', $cutoffDate)->get();

        (new PermanentlyDeleteTrashedCitiesAction())->handle($trashedCities);

    }
}
