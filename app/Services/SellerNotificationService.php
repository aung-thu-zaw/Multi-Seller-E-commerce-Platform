<?php

namespace App\Services;

use App\Mail\Admin\SellerRequestApprovedEmail;
use App\Mail\Admin\SellerRequestRejectedEmail;
use App\Models\SellerInformation;
use App\Models\SellerRequest;
use App\Models\Store;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class SellerNotificationService
{
    public function sendApprovalEmail(User $user, SellerRequest $sellerRequest): void
    {
        Mail::to($user->email)->queue(new SellerRequestApprovedEmail($sellerRequest, $user->name));
    }

    public function sendRejectionEmail(User $user, string $reason): void
    {
        Mail::to($user->email)->queue(new SellerRequestRejectedEmail($reason, $user->name));
    }
}
