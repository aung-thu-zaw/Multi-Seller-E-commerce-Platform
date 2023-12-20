<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductReviewResponse extends Model
{
    use HasFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute<ProductReviewResponse, never>
     */
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date('j F, Y', strtotime($value)),
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<ProductReview,ProductReviewResponse>
     */
    public function productReview(): BelongsTo
    {
        return $this->belongsTo(ProductReview::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Store,ProductReviewResponse>
     */
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}
