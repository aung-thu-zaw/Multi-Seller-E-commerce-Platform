<?php

namespace App\Actions\Admin\GeographicHierarchy\Townships;

use App\Models\Township;
use Illuminate\Support\Collection;

class PermanentlyDeleteTrashedTownshipsAction
{
    /**
     * @param  Collection<int,Township>  $townships
     */
    public function handle(Collection $townships): void
    {
        $townships->each(function ($township) {

            $township->forceDelete();
        });
    }
}
