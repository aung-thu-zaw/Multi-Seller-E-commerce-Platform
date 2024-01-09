<?php

namespace App\Models;

use App\Models\Scopes\FilterByScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Scout\Searchable;

class ProductQuestion extends Model
{
    use HasFactory;
    use Searchable;


    /**
     *     @return array<string>
     */
    public function toSearchableArray(): array
    {
        return [
            'question' => $this->question,
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute<ProductQuestion, never>
     */
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date('j/F/Y h:i A', strtotime($value)),
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User,ProductQuestion>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Product,ProductQuestion>
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne<ProductQuestionAnswer>
     */
    public function productQuestionAnswer(): HasOne
    {
        return $this->hasOne(ProductQuestionAnswer::class);
    }

    protected static function booted(): void
    {
        parent::boot();

        static::addGlobalScope(new FilterByScope());
    }
}
