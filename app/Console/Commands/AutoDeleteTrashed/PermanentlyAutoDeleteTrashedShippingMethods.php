<?php

namespace App\Console\Commands\AutoDeleteTrashed;

use App\Actions\Admin\ShippingMethods\PermanentlyDeleteTrashedShippingMethodsAction;
use App\Models\ShippingMethod;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PermanentlyAutoDeleteTrashedShippingMethods extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shipping-methods:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Shipping methods in the trash will be automatically deleted after 60 days';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $cutoffDate = Carbon::now()->subDays(60);

        $trashedShippingMethods = ShippingMethod::onlyTrashed()->where('deleted_at', '<=', $cutoffDate)->get();

        (new PermanentlyDeleteTrashedShippingMethodsAction())->handle($trashedShippingMethods);

    }
}
