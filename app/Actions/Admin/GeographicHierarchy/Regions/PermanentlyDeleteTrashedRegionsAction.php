<?php

namespace App\Actions\Admin\GeographicHierarchy\Regions;

use App\Models\Region;
use Illuminate\Support\Collection;

class PermanentlyDeleteTrashedRegionsAction
{
    /**
     * @param  Collection<int,Region>  $regions
     */
    public function handle(Collection $regions): void
    {
        $regions->each(function ($region) {

            $region->forceDelete();
        });
    }
}
