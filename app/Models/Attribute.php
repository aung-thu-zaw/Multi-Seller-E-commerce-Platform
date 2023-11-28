<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Attribute extends Model
{
    use HasFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Option>
     */
    public function options(): HasMany
    {
        return $this->hasMany(Option::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<ProductVariant>
     */
    public function variants(): BelongsToMany
    {
        return $this->belongsToMany(ProductVariant::class, 'product_variant_attributes')->withPivot('option_id');
    }
}
