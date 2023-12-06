<?php

namespace App\Actions\Admin\Faqs;

use App\Models\FaqSubcategory;
use Illuminate\Support\Collection;

class PermanentlyDeleteTrashedFaqSubcategoriesAction
{
    /**
     * @param  Collection<int,FaqSubcategory>  $faqSubcategories
     */
    public function handle(Collection $faqSubcategories): void
    {
        $faqSubcategories->each(function ($faqSubcategory) {

            $faqSubcategory->forceDelete();

        });
    }
}
