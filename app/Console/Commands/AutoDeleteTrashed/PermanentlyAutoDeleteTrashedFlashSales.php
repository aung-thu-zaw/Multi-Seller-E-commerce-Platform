<?php

namespace App\Console\Commands\AutoDeleteTrashed;

use App\Actions\Admin\FlashSales\PermanentlyDeleteTrashedFlashSalesAction;
use App\Models\FlashSale;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PermanentlyAutoDeleteTrashedFlashSales extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flash-sales:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Flash sales in the trash will be automatically deleted after 60 days';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $cutoffDate = Carbon::now()->subDays(60);

        $trashedFlashSales = FlashSale::onlyTrashed()->where('deleted_at', '<=', $cutoffDate)->get();

        (new PermanentlyDeleteTrashedFlashSalesAction())->handle($trashedFlashSales);

    }
}
