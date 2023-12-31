<?php

namespace App\Http\Controllers\User;

use App\Actions\User\AddressBook\CreateAddressAction;
use App\Actions\User\AddressBook\UpdateAddressAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\User\AddressRequest;
use App\Models\Address;
use App\Models\City;
use App\Models\Region;
use App\Models\Township;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class AddressBookController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        $addresses = auth()->user()->addresses;

        $regions = Region::select("id", "name")->get();

        $cities = City::select("id", "name")->get();

        $townships = Township::select("id", "name")->get();

        return inertia('User/AddressBook', compact('addresses', "regions", "cities", "townships"));
    }

    public function store(AddressRequest $request): RedirectResponse
    {
        (new CreateAddressAction())->handle($request->validated());

        return back()->with('success', ':label has been successfully created.');
    }

    public function update(AddressRequest $request, Address $address): RedirectResponse
    {
        (new UpdateAddressAction())->handle($request->validated(), $address);

        return back()->with('success', ':label has been successfully updated.');
    }

    public function destroy(int $addressId): RedirectResponse
    {
        Address::find($addressId)->delete();

        return back()->with('success', ':label has been successfully deleted.');
    }
}
