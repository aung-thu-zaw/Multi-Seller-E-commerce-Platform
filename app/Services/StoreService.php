<?php

namespace App\Services;

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
            'store_type' => $sellerRequest->store_type,
            'contact_phone' => $sellerRequest->contact_phone,
            'contact_email' => $sellerRequest->contact_email,
            'address' => $sellerRequest->address,
            'status' => 'inactive',
        ]);
    }
}
