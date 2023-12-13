<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ecommerce\BecomeASellerRequest;
use App\Http\Traits\ImageUpload;
use App\Models\Store;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Inertia\ResponseFactory;

class BecomeASellerController extends Controller
{
    use ImageUpload;

    public function create(): Response|ResponseFactory
    {
        return inertia("E-commerce/BecomeASeller/Index");
    }

    public function store(BecomeASellerRequest $request): RedirectResponse
    {
        $avatar = isset($request->avatar) ? $this->createImage($request->avatar, 'avatars/stores') : null;

        Store::create([
            "seller_id" => auth()->id(),
            "store_name" => $request->store_name,
            "contact_email" => $request->contact_email,
            "contact_phone" => $request->contact_phone,
            "store_type" => $request->store_type,
            "address" => $request->address,
            "description" => $request->description,
            "avatar" => $avatar,
            "status" => "inactive"
        ]);

        return back()->with("success","Your request has been successfully sent.");
    }
}
