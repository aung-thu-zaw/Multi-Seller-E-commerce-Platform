<?php

namespace App\Models;

use App\Models\Scopes\FilterByScope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class StoreProductBanner extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    public function getRouteKeyName()
    {
        return 'uuid';
    }

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
     * @return \Illuminate\Database\Eloquent\Casts\Attribute<StoreProductBanner, never>
     */
    protected function image(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => str_starts_with($value, 'http') ? $value : asset("storage/store-product-banners/$value"),
        );
    }

    protected static function booted(): void
    {
        parent::boot();

        static::addGlobalScope(new FilterByScope());
    }

    public static function deleteImage(string $storeProductBannerImage): void
    {
        if (! empty($storeProductBannerImage) && file_exists(storage_path('app/public/store-product-banners/'.pathinfo($storeProductBannerImage, PATHINFO_BASENAME)))) {
            unlink(storage_path('app/public/store-product-banners/'.pathinfo($storeProductBannerImage, PATHINFO_BASENAME)));
        }
    }

    public function checkStoreAccess(int $storeId): void
    {
        if ($this->store_id !== $storeId) {
            abort(403, 'Unauthorized access to store.');
        }
    }
}
