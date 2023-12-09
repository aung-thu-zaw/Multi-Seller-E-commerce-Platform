<?php

namespace App\Actions\Admin\RatingManagement\AutomatedFilterWords;

use Illuminate\Support\Collection;
use App\Models\AutomatedFilterWord;

class PermanentlyDeleteTrashedAutomatedFilterWordsAction
{
    /**
     * @param  Collection<int,AutomatedFilterWord>  $automatedFilterWords
     */

    public function handle(Collection $automatedFilterWords): void
    {
        $automatedFilterWords->each(function ($automatedFilterWord) {

            $automatedFilterWord->forceDelete();

        });
    }
}
