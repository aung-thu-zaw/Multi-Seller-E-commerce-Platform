<?php

namespace App\Console\Commands\AutoDeleteTrashed;

use App\Actions\Admin\ShippingRates\PermanentlyDeleteTrashedShippingRatesAction;
use App\Models\ShippingRate;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PermanentlyAutoDeleteTrashedShippingRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shipping-rates:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Shipping rates in the trash will be automatically deleted after 60 days';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $cutoffDate = Carbon::now()->subDays(60);

        $trashedShippingRates = ShippingRate::onlyTrashed()->where('deleted_at', '<=', $cutoffDate)->get();

        (new PermanentlyDeleteTrashedShippingRatesAction())->handle($trashedShippingRates);

    }
}
