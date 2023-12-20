<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductQuestionAnswer extends Model
{
    use HasFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute<ProductQuestionAnswer, never>
     */
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date('j/F/Y h:i A', strtotime($value)),
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Store,ProductQuestionAnswer>
     */
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<ProductQuestion,ProductQuestionAnswer>
     */
    public function productQuestion(): BelongsTo
    {
        return $this->belongsTo(ProductQuestion::class);
    }
}
