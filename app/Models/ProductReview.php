<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductReview extends Model
{
    use HasFactory;

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
        return $this->belongsTo(User::class, "user_id");
    }

    /**
    * @return \Illuminate\Database\Eloquent\Casts\Attribute<ProductReview, never>
    */
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date("j F, Y", strtotime($value)),
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
}
