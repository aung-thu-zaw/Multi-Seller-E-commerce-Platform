<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model
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
     * @return \Illuminate\Database\Eloquent\Casts\Attribute<Category, never>
     */
    protected function image(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => str_starts_with($value, 'http') || !$value ? $value : asset("storage/categories/$value"),
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Category,Category>
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Category>
     */
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id')->with('children');
    }

    /**
     * @param  Builder<Category>  $query
     */
    public function scopeSearch(Builder $query, ?string $search): void
    {
        $query->when($search ?? null, function ($query, $keyword) {
            $query->where(function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%'.$keyword.'%');
            });
        });
    }

    public static function deleteImage(?string $categoryImage): void
    {
        if (!empty($categoryImage) && file_exists(storage_path('app/public/categories/'.pathinfo($categoryImage, PATHINFO_BASENAME)))) {
            unlink(storage_path('app/public/categories/'.pathinfo($categoryImage, PATHINFO_BASENAME)));
        }
    }
}
