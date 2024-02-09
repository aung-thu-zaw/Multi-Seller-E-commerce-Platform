<?php

namespace App\Actions\Admin\RatingManagement\StoreReviews;

use App\Models\StoreReview;
use Illuminate\Support\Collection;

class PermanentlyDeleteTrashedStoreReviewsAction
{
    /**
     * @param  Collection<int,StoreReview>  $storeReviews
     */
    public function handle(Collection $storeReviews): void
    {
        $storeReviews->each(function ($storeReview) {

            $storeReview->forceDelete();

        });
    }
}
