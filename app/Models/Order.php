<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Searchable;

    /**
     *     @return array<string>
     */
    public function toSearchableArray(): array
    {
        return [
            'invoice_no' => $this->invoice_no,
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User,Order>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
    * @return \Illuminate\Database\Eloquent\Casts\Attribute<Order, never>
    */
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date("j-F-Y", strtotime($value)),
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<OrderItem>
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
