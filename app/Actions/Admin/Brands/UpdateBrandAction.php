<?php

namespace App\Actions\Admin\Brands;

use App\Http\Traits\ImageUpload;
use App\Models\Brand;

class UpdateBrandAction
{
    use ImageUpload;

    /**
     * @param  array<mixed>  $data
     */
    public function handle(array $data, Brand $brand): void
    {
        $logo = isset($data['logo']) && ! is_string($data['logo']) ? $this->updateImage($data['logo'], $brand->logo, 'brands') : $brand->logo;

        $brand->update([
            'name' => $data['name'],
            'status' => $data['status'],
            'logo' => $logo,
        ]);
    }
}
