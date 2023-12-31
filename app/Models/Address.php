<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;

    protected $casts = [
        'is_default_billing' => 'boolean',
        'is_default_delivery' => 'boolean',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User,Address>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
