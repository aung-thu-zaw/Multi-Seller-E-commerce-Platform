<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ecommerce\BecomeASellerRequest;
use App\Http\Traits\ImageUpload;
use App\Mail\Admin\NewSellerRequestEmail;
use App\Mail\User\SellerRequestStatusEmail;
use App\Models\SellerRequest;
use App\Models\User;
use App\Notifications\Admin\NewSellerRequestNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Inertia\Response;
use Inertia\ResponseFactory;

class BecomeASellerController extends Controller
{
    use ImageUpload;

    public function create(): Response|ResponseFactory
    {
        return inertia('E-commerce/BecomeASeller/Index');
    }

    public function store(BecomeASellerRequest $request): RedirectResponse
    {
        $user = User::find(auth()->id());

        $sellerRequest = SellerRequest::create([
            'user_id' => $user->id,
            'store_name' => $request->store_name,
            'store_type' => $request->store_type,
            'contact_email' => $request->contact_email,
            'contact_phone' => $request->contact_phone,
            'address' => $request->address,
            'additional_information' => $request->additional_information,
            'status' => 'pending',
        ]);

        Mail::to($user->email)->queue(new SellerRequestStatusEmail($user->name, $sellerRequest));

        $admins = User::where('role', 'admin')->permission(['claims-as-a-seller.edit'])->get();

        $admins->each(function ($admin) use ($user, $sellerRequest) {
            Mail::to($admin->email)->queue(new NewSellerRequestEmail($user, $sellerRequest));
            $admin->notify(new NewSellerRequestNotification($user, $sellerRequest));
        });

        return back()->with('success', 'Your request has been successfully sent.');
    }
}
