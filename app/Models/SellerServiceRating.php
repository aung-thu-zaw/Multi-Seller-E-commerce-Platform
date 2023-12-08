<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SellerServiceRating extends Model
{
    use HasFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<ProductReview,SellerServiceRating>
     */
    public function productReview(): BelongsTo
    {
        return $this->belongsTo(ProductReview::class);
    }
}
