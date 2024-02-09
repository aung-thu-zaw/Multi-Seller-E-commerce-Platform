<?php

namespace App\Console\Commands\AutoDeleteTrashed;

use App\Actions\Admin\Coupons\PermanentlyDeleteTrashedCouponsAction;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PermanentlyAutoDeleteTrashedCoupons extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coupons:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Coupons in the trash will be automatically deleted after 60 days';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $cutoffDate = Carbon::now()->subDays(60);

        $trashedCoupons = Coupon::onlyTrashed()->where('deleted_at', '<=', $cutoffDate)->get();

        (new PermanentlyDeleteTrashedCouponsAction())->handle($trashedCoupons);

    }
}
