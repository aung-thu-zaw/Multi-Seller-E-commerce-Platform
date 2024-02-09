<?php

namespace App\Models;

use App\Models\Scopes\FilterByScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class ShippingRate extends Model
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
    //         'name' => $this->name,
    //     ];
    // }

    protected static function booted(): void
    {
        parent::booted();

        static::addGlobalScope(new FilterByScope());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<ShippingArea,ShippingRate>
     */
    public function shippingArea()
    {
        return $this->belongsTo(ShippingArea::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<ShippingMethod,ShippingRate>
     */
    public function shippingMethod()
    {
        return $this->belongsTo(ShippingMethod::class);
    }
}
