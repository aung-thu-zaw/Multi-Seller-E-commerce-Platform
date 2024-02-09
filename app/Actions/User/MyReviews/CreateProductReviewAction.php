<?php

namespace App\Actions\User\MyReviews;

use App\Models\Product;
use App\Models\ProductReview;
use App\Models\ProductReviewImage;

class CreateProductReviewAction
{
    /**
     * @param  array<mixed>  $data
     */
    public function handle(array $data, Product $product): ProductReview
    {
        $productReview = ProductReview::create([
            'user_id' => auth()->id(),
            'store_id' => $product->store_id,
            'product_id' => $product->id,
            'comment' => $data['comment'],
            'rating' => $data['rating'],
        ]);

        if (isset($data['images'])) {

            foreach ($data['images'] as $image) {
                $originalName = $image->getClientOriginalName();

                $fileName = time().'-'.$originalName;

                $image->storeAs('product-reviews', $fileName);

                ProductReviewImage::create(['product_review_id' => $productReview->id, 'image' => $fileName]);
            }
        }

        return $productReview;

    }
}
