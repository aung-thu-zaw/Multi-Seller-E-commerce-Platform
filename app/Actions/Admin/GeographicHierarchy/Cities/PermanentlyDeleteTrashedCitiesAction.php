<?php

namespace App\Actions\Admin\GeographicHierarchy\Cities;

use App\Models\City;
use Illuminate\Support\Collection;

class PermanentlyDeleteTrashedCitiesAction
{
    /**
     * @param  Collection<int,City>  $cities
     */
    public function handle(Collection $cities): void
    {
        $cities->each(function ($city) {

            $city->forceDelete();
        });
    }
}
