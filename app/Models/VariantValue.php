<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class VariantValue extends Model
{
    use HasFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute<VariantValue, never>
     */
    protected function value(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtolower($value)
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<ProductVariant>
     */
    public function productVariants(): BelongsToMany
    {
        return $this->belongsToMany(ProductVariant::class, 'product_variant_variant_value')->withPivot("variant_type_id");
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<VariantType,VariantValue>
     */
    public function variantType(): BelongsTo
    {
        return $this->belongsTo(VariantType::class, 'variant_type_id');
    }
}
