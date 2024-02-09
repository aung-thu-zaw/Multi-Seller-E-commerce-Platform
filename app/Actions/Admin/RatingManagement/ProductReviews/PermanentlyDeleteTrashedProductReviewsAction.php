<?php

namespace App\Actions\Admin\RatingManagement\ProductReviews;

use App\Models\ProductReview;
use App\Models\ProductReviewImage;
use Illuminate\Support\Collection;

class PermanentlyDeleteTrashedProductReviewsAction
{
    /**
     * @param  Collection<int,ProductReview>  $productReviews
     */
    public function handle(Collection $productReviews): void
    {
        $productReviews->each(function ($productReview) {

            $productReviewImages = ProductReviewImage::where("product_review_id", $productReview->id)->get();

            $productReviewImages->each(function ($image) {

                ProductReviewImage::deleteImage($image);

                $image->delete();

            });

            $productReview->forceDelete();

        });
    }
}
