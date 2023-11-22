<?php

namespace App\Models;

use App\Models\Scopes\FilterByScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class BlogContent extends Model
{
    use HasFactory;
    use HasSlug;
    use Searchable;
    use SoftDeletes;

    /**
     * @var string[]
     */
    protected $guarded = [];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
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
            'title' => $this->title,
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute<BlogContent, never>
     */
    protected function thumbnail(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => str_starts_with($value, 'http') || !$value ? $value : asset("storage/blog-contents/$value"),
        );
    }

    /**
    * @return \Illuminate\Database\Eloquent\Casts\Attribute<BlogContent, never>
    */
    protected function publishedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date("F j, Y", strtotime($value)),
        );
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<BlogCategory,BlogContent>
     */
    public function blogCategory(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User,BlogContent>
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<BlogTag>
     */
    public function blogTags(): BelongsToMany
    {
        return $this->belongsToMany(BlogTag::class, 'blog_content_blog_tag');
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new FilterByScope());
    }

    /**
    * @param array<string> $filterBy
    * @param Builder<BlogContent> $query
    */

    public function scopeFilter(Builder $query, array $filterBy): void
    {
        $query->when(
            $filterBy["search_blog"] ?? null,
            function ($query, $keyword) {
                $query->where(
                    function ($query) use ($keyword) {
                        $query->where("title", "LIKE", "%".$keyword."%")
                              ->orWhere("content", "LIKE", "%".$keyword."%");
                    }
                );
            }
        );

        $query->when($filterBy["blog_category"] ?? null, function ($query, $categorySlug) {
            $query->whereHas("blogCategory", function ($query) use ($categorySlug) {
                $query->where("slug", $categorySlug);
            });
        });
    }


    public static function deleteImage(?string $blogContentImage): void
    {
        if (!empty($blogContentImage) && file_exists(storage_path('app/public/blog-contents/'.pathinfo($blogContentImage, PATHINFO_BASENAME)))) {
            unlink(storage_path('app/public/blog-contents/'.pathinfo($blogContentImage, PATHINFO_BASENAME)));
        }
    }
}
