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
     * @return \Illuminate\Database\Eloquent\Casts\Attribute<Store, never>
     */
    protected function avatar(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => str_starts_with($value, 'http') || !$value ? $value : asset("storage/avatars/stores/$value"),
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User,Store>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function deleteAvatar(?string $avatar): void
    {
        if (!empty($avatar) && file_exists(storage_path('app/public/avatars/stores/'.pathinfo($avatar, PATHINFO_BASENAME)))) {
            unlink(storage_path('app/public/avatars/stores/'.pathinfo($avatar, PATHINFO_BASENAME)));
        }
    }
}
