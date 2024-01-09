<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class CancellationItem extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<OrderItem,CancellationItem>
     */
    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne<Refund>
     */
    public function refund()
    {
        return $this->hasOne(Refund::class);
    }
}
