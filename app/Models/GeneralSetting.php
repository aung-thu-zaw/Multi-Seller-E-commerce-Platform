<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    use HasFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute<GeneralSetting, never>
     */
    protected function headerLogo(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => str_starts_with($value, 'http') || ! $value ? $value : asset("storage/settings/$value"),
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute<GeneralSetting, never>
     */
    protected function footerLogo(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => str_starts_with($value, 'http') || ! $value ? $value : asset("storage/settings/$value"),
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute<GeneralSetting, never>
     */
    protected function favicon(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => str_starts_with($value, 'http') || ! $value ? $value : asset("storage/settings/$value"),
        );
    }

    public static function deleteImage(string $brandImage): void
    {
        if (! empty($brandImage) && file_exists(storage_path('app/public/settings/'.pathinfo($brandImage, PATHINFO_BASENAME)))) {
            unlink(storage_path('app/public/settings/'.pathinfo($brandImage, PATHINFO_BASENAME)));
        }
    }
}
