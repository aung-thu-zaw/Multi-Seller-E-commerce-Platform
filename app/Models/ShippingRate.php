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
}
