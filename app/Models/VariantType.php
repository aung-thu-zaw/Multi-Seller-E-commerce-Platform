<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VariantType extends Model
{
    use HasFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<VariantValue>
     */
    public function variantValues(): HasMany
    {
        return $this->hasMany(VariantValue::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute<VariantType, never>
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtolower($value)
        );
    }
}
