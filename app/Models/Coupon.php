<?php

namespace App\Models;

use App\Models\Scopes\FilterByScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Coupon extends Model
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
            'code' => $this->code,
        ];
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<User>
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'coupon_user')->withTimestamps();
    }


    protected static function booted(): void
    {
        parent::boot();

        static::addGlobalScope(new FilterByScope());
    }
}
