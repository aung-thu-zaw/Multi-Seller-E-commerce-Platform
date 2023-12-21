<?php

namespace App\Models;

use App\Models\Scopes\FilterByScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class FaqContent extends Model
{
    use HasFactory;
    use HasSlug;
    use Searchable;
    use SoftDeletes;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('question')
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
            'question' => $this->question,
        ];
    }

    // protected static function booted(): void
    // {
    //     parent::boot();

    //     static::addGlobalScope(new FilterByScope());
    // }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<FaqCategory,FaqContent>
     */
    public function faqCategory(): BelongsTo
    {
        return $this->belongsTo(FaqCategory::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<FaqSubcategory,FaqContent>
     */
    public function faqSubcategory(): BelongsTo
    {
        return $this->belongsTo(FaqSubcategory::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<FaqFeedback>
     */
    public function faqFeedbacks(): HasMany
    {
        return $this->hasMany(FaqFeedback::class);
    }

    /**
     * @param  array<string>  $filterBy
     * @param  Builder<FaqContent>  $query
     */
    public function scopeFilterBy(Builder $query, array $filterBy): void
    {
        $query->when(
            $filterBy['search_question'] ?? null,
            function ($query, $search_question) {
                $query->where(
                    function ($query) use ($search_question) {
                        $query->where('question', 'LIKE', '%'.$search_question.'%');
                    }
                );
            }
        );

        $query->when($filterBy['category'] ?? null, function ($query, $subCategorySlug) {
            $query->whereHas('faqSubcategory', function ($query) use ($subCategorySlug) {
                $query->where('slug', $subCategorySlug);
            });
        });
    }
}
