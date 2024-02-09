<?php

namespace App\Actions\Admin\Faqs;

use App\Models\FaqContent;
use Illuminate\Support\Collection;

class PermanentlyDeleteTrashedFaqContentsAction
{
    /**
     * @param  Collection<int,FaqContent>  $faqContents
     */
    public function handle(Collection $faqContents): void
    {
        $faqContents->each(function ($faqContent) {

            $faqContent->forceDelete();

        });
    }
}
