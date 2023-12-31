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
            'region_id' => $data["region_id"],
            'city_id' => $data["city_id"],
            'township_id' => $data["township_id"],
            'postal_code' => $data["postal_code"],
            'address' => $data["address"],
            'landmark' => $data["landmark"],
            'is_default_billing' => $data["is_default_billing"],
            'is_default_delivery' => $data["is_default_delivery"],
            'address_type' => $data["address_type"],
        ]);

    }
}
