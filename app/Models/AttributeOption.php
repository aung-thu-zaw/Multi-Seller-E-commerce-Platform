<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute as castAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AttributeOption extends Model
{
    use HasFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute<AttributeOption, never>
     */
    protected function value(): castAttribute
    {
        return castAttribute::make(
            set: fn ($value) => strtolower($value)
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Attribute,AttributeOption>
     */
    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class);
    }
}
