<?php

namespace App\Models;

use App\Models\Scopes\FilterByScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class StoreReview extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    /**
     *     @return array<string>
     */
    public function toSearchableArray(): array
    {
        return [
            'comment' => $this->comment,
        ];
    }

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

    /**
     * @param  Builder<StoreReview>  $builder
     *
     */
    public function scopeFilterByScope(Builder $builder): void
    {
        $builder->when(request('created_from'), function ($query, $createdFrom) {
            $query->whereDate('created_at', '>=', $createdFrom);
        })
            ->when(request('created_until'), function ($query, $createdUntil) {
                $query->whereDate('created_at', '<=', $createdUntil);
            })
            ->when(request('deleted_from'), function ($query, $deletedFrom) {
                $query->whereDate('deleted_at', '>=', $deletedFrom);
            })
            ->when(request('deleted_until'), function ($query, $deletedUntil) {
                $query->whereDate('deleted_at', '<=', $deletedUntil);
            })
            ->when(request('filter_by_status'), function ($query, $filterByStatus) {
                $query->where('response_status', $filterByStatus);
            });
    }
}
