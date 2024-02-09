<?php

namespace App\Console\Commands\AutoDeleteTrashed;

use App\Actions\Admin\ShippingAreas\PermanentlyDeleteTrashedShippingAreasAction;
use App\Models\ShippingArea;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PermanentlyAutoDeleteTrashedShippingAreas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shipping-areas:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Shipping areas in the trash will be automatically deleted after 60 days';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $cutoffDate = Carbon::now()->subDays(60);

        $trashedShippingAreas = ShippingArea::onlyTrashed()->where('deleted_at', '<=', $cutoffDate)->get();

        (new PermanentlyDeleteTrashedShippingAreasAction())->handle($trashedShippingAreas);

    }
}
