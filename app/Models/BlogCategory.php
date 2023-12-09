<?php

namespace App\Models;

use App\Models\Scopes\FilterByScope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class BlogCategory extends Model
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
     * @return \Illuminate\Database\Eloquent\Casts\Attribute<BlogCategory, never>
     */
    protected function image(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => str_starts_with($value, 'http') || ! $value ? $value : asset("storage/blog-categories/$value"),
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<BlogContent>
     */
    public function blogContents(): HasMany
    {
        return $this->hasMany(BlogContent::class);
    }

    protected static function booted(): void
    {
        parent::boot();

        static::addGlobalScope(new FilterByScope());
    }

    public static function deleteImage(?string $blogCategoryImage): void
    {
        if (! empty($blogCategoryImage) && file_exists(storage_path('app/public/blog-categories/'.pathinfo($blogCategoryImage, PATHINFO_BASENAME)))) {
            unlink(storage_path('app/public/blog-categories/'.pathinfo($blogCategoryImage, PATHINFO_BASENAME)));
        }
    }
}
