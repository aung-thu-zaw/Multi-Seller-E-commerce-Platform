<?php

namespace App\Actions\Admin\SellerManagement\StoreManage;

use App\Models\Store;
use Illuminate\Support\Collection;

class PermanentlyDeleteTrashedStoresAction
{
    /**
     * @param  Collection<int,Store>  $stores
     */
    public function handle(Collection $stores): void
    {
        $stores->each(function ($store) {

            Store::deleteAvatar($store->avatar);

            Store::deleteCover($store->cover);

            $store->forceDelete();

        });
    }
}
