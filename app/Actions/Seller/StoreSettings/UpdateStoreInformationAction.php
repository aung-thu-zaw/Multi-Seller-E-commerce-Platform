<?php

namespace App\Actions\Seller\StoreSettings;

use App\Http\Traits\ImageUpload;
use App\Models\Store;

class UpdateStoreInformationAction
{
    use ImageUpload;

    /**
     * @param  array<mixed>  $data
     */
    public function handle(array $data, Store $store): void
    {
        $avatar = isset($data['avatar']) && ! is_string($data['avatar']) ? $this->updateImage($data['avatar'], $store->avatar, 'stores/avatars') : $store->avatar;
        $cover = isset($data['cover']) && ! is_string($data['cover']) ? $this->updateImage($data['cover'], $store->cover, 'stores/covers') : $store->cover;

        $store->update([
            'store_name' => $data['store_name'],
            'description' => $data['description'],
            'contact_email' => $data['contact_email'],
            'contact_phone' => $data['contact_phone'],
            'address' => $data['address'],
            'avatar' => $avatar,
            'cover' => $cover,
        ]);
    }
}
