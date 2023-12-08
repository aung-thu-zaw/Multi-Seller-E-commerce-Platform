<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne<SellerServiceRating>
     */
    public function sellerServiceRating(): HasOne
    {
        return $this->hasOne(SellerServiceRating::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne<DeliveryServiceRating>
     */
    public function deliveryServiceRating(): HasOne
    {
        return $this->hasOne(DeliveryServiceRating::class);
    }
}
