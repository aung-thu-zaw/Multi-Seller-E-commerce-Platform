<?php

namespace App\Actions\Admin\FlashSales;

use App\Models\FlashSale;
use Illuminate\Support\Collection;

class PermanentlyDeleteTrashedFlashSalesAction
{
    /**
    * @param Collection<int,FlashSale> $flashSales
    */

    public function handle(Collection $flashSales): void
    {
        $flashSales->each(function ($flashSale) {

            $flashSale->forceDelete();

        });
    }
}
