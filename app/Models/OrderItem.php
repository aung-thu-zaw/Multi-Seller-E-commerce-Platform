<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class OrderItem extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Searchable;

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
}
