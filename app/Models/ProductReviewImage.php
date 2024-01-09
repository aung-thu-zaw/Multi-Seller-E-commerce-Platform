<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductReviewImage extends Model
{
    use HasFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute<ProductReviewImage, never>
     */
    protected function image(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => str_starts_with($value, 'http') || ! $value ? $value : asset("storage/product-reviews/$value"),
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<ProductReview,ProductReviewImage>
     */
    public function productReview(): BelongsTo
    {
        return $this->belongsTo(ProductReview::class);
    }

    public static function deleteImage(string $productReviewImage): void
    {
        if (! empty($productReviewImage) && file_exists(storage_path('app/public/product-reviews/'.pathinfo($productReviewImage, PATHINFO_BASENAME)))) {
            unlink(storage_path('app/public/product-reviews/'.pathinfo($productReviewImage, PATHINFO_BASENAME)));
        }
    }
}
