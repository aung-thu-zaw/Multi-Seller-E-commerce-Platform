<?php

namespace App\Actions\Admin\RatingManagement\AutomatedFilterWords;

use App\Models\AutomatedFilterWord;
use Illuminate\Support\Collection;

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
