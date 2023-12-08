<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeliveryServiceRating extends Model
{
    use HasFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<ProductReview,DeliveryServiceRating>
     */
    public function productReview(): BelongsTo
    {
        return $this->belongsTo(ProductReview::class);
    }

}
