<?php

namespace App\Actions\Admin\Brands;

use App\Http\Traits\ImageUpload;
use App\Models\Brand;

class CreateBrandAction
{
    use ImageUpload;

    /**
     * @param  array<mixed>  $data
     */
    public function handle(array $data): void
    {
        $logo = isset($data['logo']) ? $this->createImage($data["logo"], "brands") : null;

        Brand::create([
            'name' => $data['name'],
            'status' => $data['status'],
            'logo' => $logo,
        ]);
    }
}
