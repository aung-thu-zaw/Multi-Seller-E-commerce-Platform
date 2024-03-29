<?php

namespace App\Http\Controllers\User;

use App\Actions\User\AddressBook\CreateAddressAction;
use App\Actions\User\AddressBook\UpdateAddressAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\User\AddressRequest;
use App\Models\Address;
use App\Models\City;
use App\Models\Region;
use App\Models\ShippingArea;
use App\Models\Township;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Inertia\ResponseFactory;

class AddressBookController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        $addresses = auth()->user()->addresses()->with(['region:id,name', 'city:id,name', 'township:id,name'])->get();

        $shippingAreas = ShippingArea::with(['region','city','township'])->get();

        return inertia('User/AddressBook', compact('addresses', 'shippingAreas'));
    }

    public function store(AddressRequest $request): RedirectResponse
    {
        (new CreateAddressAction())->handle($request->validated());

        return back()->with('success', ':label has been successfully created.');
    }

    public function update(AddressRequest $request, int $addressId): RedirectResponse
    {
        $address = Address::find($addressId);

        (new UpdateAddressAction())->handle($request->validated(), $address);

        return back()->with('success', ':label has been successfully updated.');
    }

    public function destroy(int $addressId): RedirectResponse
    {
        Address::find($addressId)->delete();

        return back()->with('success', ':label has been successfully deleted.');
    }
}
