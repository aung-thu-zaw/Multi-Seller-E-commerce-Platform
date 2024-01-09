<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class OrderItem extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    // /**
    //  *     @return array<string>
    //  */
    // public function toSearchableArray(): array
    // {
    //     return [
    //         'tracking_no' => $this->tracking_no,
    //     ];
    // }

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute<OrderItem, never>
     */
    protected function shippedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? date('j-F-Y ( g:i:s ) A', strtotime($value)) : null,
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute<OrderItem, never>
     */
    protected function deliveredAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? date('j-F-Y ( g:i:s ) A', strtotime($value)) : null,
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Product,OrderItem>
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Store,OrderItem>
     */
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Order,OrderItem>
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne<ReturnItem>
     */
    public function returnItem(): HasOne
    {
        return $this->hasOne(ReturnItem::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne<CancellationItem>
     */
    public function cancellationItem(): HasOne
    {
        return $this->hasOne(CancellationItem::class);
    }
}
