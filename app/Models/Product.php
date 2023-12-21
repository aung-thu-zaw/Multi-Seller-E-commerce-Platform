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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<ProductVariant>
     */
    public function productVariants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
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
        return $this->belongsToMany(FlashSale::class, 'flash_sale_product')
            ->withPivot('discount_percent')
            ->withTimestamps();
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
     * Generate a unique SKU for the product.
     */
    public function generateUniqueSku(): string
    {
        // Generate a base SKU
        $sequenceNumber = $this->exists ? $this->id + 1 : 1;
        $baseSku = 'PROD'.str_pad(strval($sequenceNumber), 4, '0', STR_PAD_LEFT);

        // Check if the base SKU already exists
        $sku = $baseSku;
        $counter = 1;

        while (ProductVariant::where('sku', $sku)->exists()) {
            $sku = $baseSku.'-'.$counter++;
        }

        return $sku;
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
}
