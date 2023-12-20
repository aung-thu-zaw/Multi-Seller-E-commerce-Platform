<?php

namespace App\Services;

use App\Models\BusinessInformation;
use App\Models\SellerRequest;
use App\Models\User;

class SellerVerificationService
{
    public function handleApproval(User $user, SellerRequest $sellerRequest): void
    {
        $user->update(['role' => 'seller']);

        (new StoreService())->createStore($user, $sellerRequest);

        BusinessInformation::create([
            'seller_id' => $user->id,
        ]);

        (new SellerNotificationService())->sendApprovalEmail($user, $sellerRequest);
    }

    public function handleRejection(User $user, string $reasonForRejection): void
    {
        (new SellerNotificationService())->sendRejectionEmail($user, $reasonForRejection);
    }
}
