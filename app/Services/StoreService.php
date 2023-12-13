<?php

namespace App\Services;

use App\Models\SellerInformation;
use App\Models\SellerRequest;
use App\Models\Store;
use App\Models\User;

class StoreService
{
    public function createStore(User $user, SellerRequest $sellerRequest): Store
    {
        return Store::create([
            'seller_id' => $user->id,
            'store_name' => $sellerRequest->store_name,
            'contact_phone' => $sellerRequest->contact_phone,
            'contact_email' => $sellerRequest->contact_email,
            'location' => $sellerRequest->address,
            'status' => 'inactive',
        ]);
    }
}
