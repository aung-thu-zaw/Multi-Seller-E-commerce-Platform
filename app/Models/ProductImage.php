<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductImage extends Model
{
    use HasFactory;


    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute<ProductImage, never>
     */
    protected function image(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => str_starts_with($value, 'http') || !$value ? $value : asset("storage/products/$value"),
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Product,ProductImage>
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public static function deleteImage(string $productImage): void
    {
        if (!empty($productImage) && file_exists(storage_path('app/public/products/'.pathinfo($productImage, PATHINFO_BASENAME)))) {
            unlink(storage_path('app/public/products/'.pathinfo($productImage, PATHINFO_BASENAME)));
        }
    }
}
