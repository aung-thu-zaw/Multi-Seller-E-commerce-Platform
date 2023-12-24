<?php

namespace App\Models;

use App\Models\Scopes\FilterByScope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Brand extends Model
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

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute<Brand, never>
     */
    protected function logo(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => str_starts_with($value, 'http') || !$value ? $value : asset("storage/brands/$value"),
        );
    }

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Category,Brand>
    */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // protected static function booted(): void
    // {
    //     parent::boot();

    //     static::addGlobalScope(new FilterByScope());
    // }

    public static function deleteImage(string $brandImage): void
    {
        if (!empty($brandImage) && file_exists(storage_path('app/public/brands/'.pathinfo($brandImage, PATHINFO_BASENAME)))) {
            unlink(storage_path('app/public/brands/'.pathinfo($brandImage, PATHINFO_BASENAME)));
        }
    }
}
