<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StoreReview extends Model
{
    use HasFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User,StoreReview>
     */
    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Store,StoreReview>
     */
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute<StoreReview, never>
     */
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date('j F, Y', strtotime($value)),
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne<StoreReviewResponse>
     */
    public function storeReviewResponse(): HasOne
    {
        return $this->hasOne(StoreReviewResponse::class);
    }

    /**
     * @param  Builder<StoreReview>  $query
     * @return Builder<StoreReview>
     */
    public function scopeFilterByRating(Builder $query, ?string $rating)
    {
        if ($rating !== 'all') {
            return $query->where('rating', $rating);
        }

        return $query;
    }

    /**
     * @param  Builder<StoreReview>  $query
     * @return Builder<StoreReview>
     */
    public function scopeSortBy(Builder $query, ?string $sortType)
    {
        switch ($sortType) {
            case 'recent':
                return $query->latest();
            case 'rating_high_to_low':
                return $query->orderBy('rating', 'desc');
            case 'rating_low_to_high':
                return $query->orderBy('rating', 'asc');
            default:
                return $query->orderBy('id', 'desc');
        }
    }
}
