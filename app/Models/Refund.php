<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    use HasFactory;

    /**
      * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<ReturnItem,Refund>
      */
    public function returnItem()
    {
        return $this->belongsTo(ReturnItem::class);
    }

    /**
      * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<CancellationItem,Refund>
      */
    public function cancellationItem()
    {
        return $this->belongsTo(CancellationItem::class);
    }
}
