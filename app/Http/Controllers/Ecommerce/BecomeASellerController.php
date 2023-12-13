<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ecommerce\BecomeASellerRequest;
use App\Http\Traits\ImageUpload;
use App\Models\SellerInformation;
use App\Models\SellerRequest;
use App\Models\Store;
use Illuminate\Http\RedirectResponse;
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
        SellerRequest::create([
             'seller_id' => auth()->id(),
             'store_name' => $request->store_name,
             'store_type' => $request->store_type,
             'contact_email' => $request->contact_email,
             'contact_phone' => $request->contact_phone,
             'address' => $request->address,
             'additional_information' => $request->additional_information,
             'status' => 'pending',
         ]);

        return back()->with('success', 'Your request has been successfully sent.');
    }
}
