<?php

namespace App\Actions\User\AddressBook;

use App\Models\Address;

class CreateAddressAction
{
    /**
     * @param  array<mixed>  $data
     */
    public function handle(array $data): void
    {
        Address::create([
            'user_id' => auth()->id(),
            'name' => $data["name"],
            'phone' => $data["phone"],
            'email' => $data["email"],
            'region' => $data["region"],
            'city' => $data["city"],
            'township' => $data["township"],
            'postal_code' => $data["postal_code"],
            'address' => $data["address"],
            'landmark' => $data["landmark"],
            'is_default_billing' => $data["is_default_billing"],
            'is_default_shipping' => $data["is_default_shipping"],
            'address_type' => $data["address_type"],
        ]);

    }
}
