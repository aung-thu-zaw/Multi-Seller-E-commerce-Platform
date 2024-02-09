<?php

namespace App\Models;

use App\Models\Scopes\FilterByScope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class SliderBanner extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    /**
     *     @return array<string>
     */
    public function toSearchableArray(): array
    {
        return [
            'url' => $this->url,
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute<SliderBanner, never>
     */
    protected function image(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => str_starts_with($value, 'http') ? $value : asset("storage/slider-banners/$value"),
        );
    }

    protected static function booted(): void
    {
        parent::boot();

        static::addGlobalScope(new FilterByScope());
    }

    public static function deleteImage(string $sliderBannerImage): void
    {
        if (! empty($sliderBannerImage) && file_exists(storage_path('app/public/slider-banners/'.pathinfo($sliderBannerImage, PATHINFO_BASENAME)))) {
            unlink(storage_path('app/public/slider-banners/'.pathinfo($sliderBannerImage, PATHINFO_BASENAME)));
        }
    }
}
