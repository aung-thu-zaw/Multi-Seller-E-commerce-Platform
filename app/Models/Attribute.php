<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute as castAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Attribute extends Model
{
    use HasFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute<Attribute, never>
     */
    protected function name(): castAttribute
    {
        return castAttribute::make(
            set: fn ($value) => strtolower($value)
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<AttributeOption>
     */
    public function attributeOptions(): HasMany
    {
        return $this->hasMany(AttributeOption::class);
    }
}
