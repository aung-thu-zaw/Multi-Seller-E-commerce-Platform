<?php

namespace App\Models;

use App\Models\Scopes\FilterByScope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;
    use HasSlug;

    /**
    * @var string[]
    */
    protected $guarded = [];

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
            set: fn ($value) => str_starts_with($value, 'http') || !$value ? $value : asset("storage/blog-categories/$value"),
        );
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new FilterByScope());
    }

    public static function deleteImage(?string $blogCategoryImage): void
    {
        if (!empty($blogCategoryImage) && file_exists(storage_path('app/public/blog-categories/'.pathinfo($blogCategoryImage, PATHINFO_BASENAME)))) {
            unlink(storage_path('app/public/blog-categories/'.pathinfo($blogCategoryImage, PATHINFO_BASENAME)));
        }
    }

}
