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

class FaqSubcategory extends Model
{
    use HasFactory;
    use HasSlug;
    use Searchable;
    use SoftDeletes;

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

    // protected static function booted(): void
    // {
    //     parent::boot();

    //     static::addGlobalScope(new FilterByScope());
    // }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<FaqCategory,FaqSubcategory>
     */
    public function faqCategory(): BelongsTo
    {
        return $this->belongsTo(FaqCategory::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<FaqContent>
     */
    public function faqContents(): HasMany
    {
        return $this->hasMany(FaqContent::class);
    }
}
