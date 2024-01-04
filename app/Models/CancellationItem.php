<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class CancellationItem extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Searchable;

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
