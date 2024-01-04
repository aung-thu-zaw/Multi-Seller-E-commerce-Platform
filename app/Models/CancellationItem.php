<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CancellationItem extends Model
{
    use HasFactory;
    use SoftDeletes;

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
