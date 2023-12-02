<?php

namespace App\Models;

use App\Models\Scopes\FilterByScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class StoreProductCategory extends Model
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
        parent::boot();

        static::addGlobalScope(new FilterByScope());
    }

    public static function getStoreId(): int
    {
        return Store::where('seller_id', auth()->id())->value('id');
    }

    public function checkStoreAccess(): void
    {
        $store = self::getStoreId();

        if ($this->store_id !== $store) {
            abort(403, 'Unauthorized access to store.');
        }
    }
}
