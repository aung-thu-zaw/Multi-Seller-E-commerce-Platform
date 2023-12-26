<?php

namespace App\Models;

use App\Models\Scopes\FilterByScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute as CastAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
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
     * @return \Illuminate\Database\Eloquent\Casts\Attribute<Product, never>
     */
    protected function image(): CastAttribute
    {
        return CastAttribute::make(
            set: fn ($value) => str_starts_with($value, 'http') || !$value ? $value : asset("storage/products/$value"),
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<ProductImage>
     */
    public function productImages(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Brand,Product>
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Category,Product>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<ProductReview>
     */
    public function productReviews(): HasMany
    {
        return $this->hasMany(ProductReview::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Store,Product>
     */
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<Collection>
     */
    public function collections(): BelongsToMany
    {
        return $this->belongsToMany(Collection::class, 'collection_product');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<FlashSale>
     */
    public function flashSales(): BelongsToMany
    {
        return $this->belongsToMany(FlashSale::class, 'flash_sale_product')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Sku>
     */
    public function skus(): HasMany
    {
        return $this->hasMany(Sku::class);
    }

    // protected static function booted(): void
    // {
    //     parent::boot();

    //     static::addGlobalScope(new FilterByScope());
    // }

    public static function deleteImage(string $productImage): void
    {
        if (!empty($productImage) && file_exists(storage_path('app/public/products/'.pathinfo($productImage, PATHINFO_BASENAME)))) {
            unlink(storage_path('app/public/products/'.pathinfo($productImage, PATHINFO_BASENAME)));
        }
    }

    /**
     * @param  Builder<Product>  $query
     * @return Builder<Product>
     */
    public function scopeWithApprovedReviewCount(Builder $query)
    {
        return $query->withCount(['productReviews' => function ($query) {
            $query->where('status', 'approved');
        }]);
    }

    /**
     * @param  Builder<Product>  $query
     * @return Builder<Product>
     */
    public function scopeWithApprovedReviewAvg(Builder $query)
    {
        return $query->withAvg(['productReviews' => function ($query) {
            $query->where('status', 'approved');
        }], 'rating');
    }

    /**
    * @param array<string> $filterBy
    * @param Builder<Product> $query
    */

    public function scopeFilterBy(Builder $query, array $filterBy): void
    {
        $query->when(
            $filterBy["search"] ?? null,
            function ($query, $search) {
                $query->where(
                    function ($query) use ($search) {
                        $query->where("name", "LIKE", "%".$search."%");
                    }
                );
            }
        );

        $query->when($filterBy["price"] ?? null, function ($query, $price) {
            if ($price !== null) {
                $priceRange = explode("-", $price);

                if (count($priceRange) === 2) {
                    $minPrice = $priceRange[0];
                    $maxPrice = $priceRange[1];

                    $query->where(function ($query) use ($minPrice, $maxPrice) {
                        $query->whereBetween("price", [$minPrice, $maxPrice])
                            ->orWhereBetween("offer_price", [$minPrice, $maxPrice]);
                    });
                }
            }
        });

        $query->when($filterBy["category"] ?? null, function ($query, $categorySlug) {
            $query->whereHas("category", function ($query) use ($categorySlug) {
                $query->where("slug", $categorySlug);
            });
        });

        $query->when($filterBy["brand"] ?? null, function ($query, $brandSlug) {
            $brandSlugs = explode('--', $brandSlug);

            $query->whereHas("brand", function ($query) use ($brandSlugs) {
                $query->whereIn("slug", $brandSlugs);
            });
        });

        $query->when($filterBy["rating"] ?? null, function ($query, $minRating) {
            $query->whereHas("productReviews", function ($query) use ($minRating) {
                $query->havingRaw("AVG(product_reviews.rating) >= ?", [$minRating]);
            });
        });
    }

    /**
    * @param  Builder<Product>  $query
    * @return Builder<Product>
    */
    public function scopeSortBy(Builder $query, ?string $sortType)
    {
        switch ($sortType) {
            case 'newest_arrivals':
                return $query->latest();
            case 'price_high_to_low':
                return $query->orderBy('price', 'desc');
            case 'price_low_to_high':
                return $query->orderBy('price', 'asc');
            default:
                return $query->orderBy('id', 'desc');
        }
    }
}
