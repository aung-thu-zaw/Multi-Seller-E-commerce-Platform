<?php

namespace App\Actions\Admin\Faqs;

use App\Models\FaqCategory;
use Illuminate\Support\Collection;

class PermanentlyDeleteTrashedFaqCategoriesAction
{
    /**
     * @param  Collection<int,FaqCategory>  $faqCategories
     */
    public function handle(Collection $faqCategories): void
    {
        $faqCategories->each(function ($faqCategory) {

            $faqCategory->forceDelete();

        });
    }
}
