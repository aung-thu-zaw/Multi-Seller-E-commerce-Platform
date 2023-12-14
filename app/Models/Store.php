<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Store extends Model
{
    use HasFactory;
    use HasSlug;
    use Searchable;
    use SoftDeletes;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('store_name')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     *     @return array<string>
     */
    public function toSearchableArray(): array
    {
        return [
            'store_name' => $this->store_name,
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute<Store, never>
     */
    protected function avatar(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => str_starts_with($value, 'http') || !$value ? $value : asset("storage/stores/avatars/$value"),
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute<Store, never>
     */
    protected function cover(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => str_starts_with($value, 'http') || !$value ? $value : asset("storage/stores/covers/$value"),
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User,Store>
     */
    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class,"seller_id");
    }

    public static function deleteAvatar(?string $avatar): void
    {
        if (!empty($avatar) && file_exists(storage_path('app/public/stores/avatars/'.pathinfo($avatar, PATHINFO_BASENAME)))) {
            unlink(storage_path('app/public/stores/avatars/'.pathinfo($avatar, PATHINFO_BASENAME)));
        }
    }

    public static function deleteCover(?string $cover): void
    {
        if (!empty($cover) && file_exists(storage_path('app/public/stores/covers/'.pathinfo($cover, PATHINFO_BASENAME)))) {
            unlink(storage_path('app/public/stores/covers/'.pathinfo($cover, PATHINFO_BASENAME)));
        }
    }
}
