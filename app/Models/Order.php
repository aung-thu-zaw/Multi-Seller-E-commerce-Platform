<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User,Order>
    */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
    * @return \Illuminate\Database\Eloquent\Relations\HasMany<OrderItem>
    */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
