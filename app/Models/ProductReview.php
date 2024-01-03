<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductReview extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Product,ProductReview>
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User,ProductReview>
     */
    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute<ProductReview, never>
     */
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date('j F, Y', strtotime($value)),
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne<SellerServiceRating>
     */
    public function sellerServiceRating(): HasOne
    {
        return $this->hasOne(SellerServiceRating::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne<ProductReviewResponse>
     */
    public function productReviewResponse(): HasOne
    {
        return $this->hasOne(ProductReviewResponse::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne<DeliveryServiceRating>
     */
    public function deliveryServiceRating(): HasOne
    {
        return $this->hasOne(DeliveryServiceRating::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<ProductReviewImage>
     */
    public function productReviewImages(): HasMany
    {
        return $this->hasMany(ProductReviewImage::class);
    }

    /**
     * @param  Builder<ProductReview>  $query
     * @return Builder<ProductReview>
     */
    public function scopeFilterByRating(Builder $query, ?string $rating)
    {
        if ($rating !== 'all') {
            return $query->where('rating', $rating);
        }

        return $query;
    }

    /**
     * @param  Builder<ProductReview>  $query
     * @return Builder<ProductReview>
     */
    public function scopeSortBy(Builder $query, ?string $sortType)
    {
        switch ($sortType) {
            case 'recent':
                return $query->latest();
            case 'rating_high_to_low':
                return $query->orderBy('rating', 'desc');
            case 'rating_low_to_high':
                return $query->orderBy('rating', 'asc');
            default:
                return $query->orderBy('id', 'desc');
        }
    }
}
