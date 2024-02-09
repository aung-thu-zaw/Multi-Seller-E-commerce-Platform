<?php

namespace App\Actions\Admin\OrderManagement;

use App\Models\Order;
use Illuminate\Support\Collection;

class PermanentlyDeleteTrashedOrdersAction
{
    /**
     * @param  Collection<int,Order>  $orders
     */
    public function handle(Collection $orders): void
    {
        $orders->each(function ($order) {

            $order->forceDelete();

        });
    }
}
