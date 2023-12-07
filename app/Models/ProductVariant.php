<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;

class ProductVariant extends Model
{
    use HasFactory;
    use Searchable;

    /**
     *     @return array<string>
     */
    // public function toSearchableArray(): array
    // {
    //     return [
    //         'sku' => $this->sku,
    //     ];
    // }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Product,ProductVariant>
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<Attribute>
     */
    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class, 'product_variant_attributes')->withPivot('option_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<Option>
     */
    public function options(): BelongsToMany
    {
        return $this->belongsToMany(Option::class, 'product_variant_attributes');
    }
}
