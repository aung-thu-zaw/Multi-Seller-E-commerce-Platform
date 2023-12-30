<?php

namespace App\Models;

use App\Models\Scopes\FilterByScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class ShippingArea extends Model
{
    use HasFactory;
    use HasSlug;
    use Searchable;
    use SoftDeletes;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
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
            'name' => $this->name,
        ];
    }

    protected static function booted(): void
    {
        parent::booted();

        static::addGlobalScope(new FilterByScope());
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Region,ShippingArea>
     */
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<City,ShippingArea>
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Township,ShippingArea>
     */
    public function township(): BelongsTo
    {
        return $this->belongsTo(Township::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<ShippingRate>
     */
    public function shippingRates(): HasMany
    {
        return $this->hasMany(ShippingRate::class);
    }

}
