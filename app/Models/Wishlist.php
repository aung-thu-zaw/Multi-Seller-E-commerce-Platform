<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wishlist extends Model
{
    use HasFactory;

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User,Wishlist>
    */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Product,Wishlist>
    */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Store,Wishlist>
    */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
