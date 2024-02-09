<?php

namespace App\Models;

use App\Models\Scopes\FilterByScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class StoreProductCategory extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    /**
     *     @return array<string>
     */
    public function toSearchableArray(): array
    {
        return [
            'name' => $this->name,
        ];
    }

    protected static function booted(): void
    {
        parent::boot();

        static::addGlobalScope(new FilterByScope());
    }

    public function checkStoreAccess(int $storeId): void
    {
        if ($this->store_id !== $storeId) {
            abort(403, 'Unauthorized access to store.');
        }
    }
}
