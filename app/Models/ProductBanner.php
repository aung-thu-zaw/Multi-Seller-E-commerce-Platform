<?php

namespace App\Models;

use App\Models\Scopes\FilterByScope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class ProductBanner extends Model
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
     * @return \Illuminate\Database\Eloquent\Casts\Attribute<ProductBanner, never>
     */
    protected function image(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => str_starts_with($value, 'http') ? $value : asset("storage/product-banners/$value"),
        );
    }

    protected static function booted(): void
    {
        parent::boot();

        static::addGlobalScope(new FilterByScope());
    }

    public static function deleteImage(string $productBannerImage): void
    {
        if (!empty($productBannerImage) && file_exists(storage_path('app/public/product-banners/'.pathinfo($productBannerImage, PATHINFO_BASENAME)))) {
            unlink(storage_path('app/public/product-banners/'.pathinfo($productBannerImage, PATHINFO_BASENAME)));
        }
    }
}
