<?php

namespace App\Actions\Admin\SellerManagement\SellerRequests;

use App\Models\SellerRequest;
use Illuminate\Support\Collection;

class PermanentlyDeleteTrashedSellerRequestsAction
{
    /**
     * @param  Collection<int,SellerRequest>  $sellerRequests
     */
    public function handle(Collection $sellerRequests): void
    {
        $sellerRequests->each(function ($sellerRequest) {

            $sellerRequest->forceDelete();

        });
    }
}
