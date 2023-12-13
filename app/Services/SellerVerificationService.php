<?php

namespace App\Services;

use App\Models\SellerInformation;
use App\Models\SellerRequest;
use App\Models\User;

class SellerVerificationService
{
    public function handleApproval(User $user, SellerRequest $sellerRequest): void
    {
        $user->update(['role' => 'seller']);

        $store = (new StoreService())->createStore($user, $sellerRequest);

        SellerInformation::create([
            'seller_id' => $user->id,
            'store_id' => $store->id,
            'store_contact_email' => $store->contact_phone,
            'store_contact_phone' => $store->contact_email,
        ]);

        (new SellerNotificationService())->sendApprovalEmail($user, $sellerRequest);
    }

    public function handleRejection(User $user, string $reasonForRejection): void
    {
        (new SellerNotificationService())->sendRejectionEmail($user, $reasonForRejection);
    }
}
