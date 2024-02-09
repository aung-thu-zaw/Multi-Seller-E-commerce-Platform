<script setup>
import ProductRatingWithProgressBar from '@/Components/Ratings/ProductRatingWithProgressBar.vue'
import ReviewSortDropdown from '@/Components/Dropdowns/Reviews/Products/ReviewSortDropdown.vue'
import ReviewFilterDropdown from '@/Components/Dropdowns/Reviews/Products/ReviewFilterDropdown.vue'
import ReviewCard from '@/Components/Cards/Reviews/ReviewCard.vue'
import SellerResponseCard from '@/Components/Cards/Reviews/SellerResponseCard.vue'
import Pagination from '@/Components/Paginations/Pagination.vue'

defineProps({
  product: Object,
  productReviewsForAverageProgressBar: Object,
  productReviews: Object
})
</script>

<template>
  <div class="py-10 border border-gray-200 bg-white rounded-md space-y-5">
    <!-- Product Avg Stars With Progress Bar -->
    <ProductRatingWithProgressBar
      :product="product"
      :productReviewsForAverageProgressBar="productReviewsForAverageProgressBar"
    />

    <hr />

    <div class="px-5">
      <div class="mb-5 flex items-center justify-between">
        <h3 class="font-bold text-md text-gray-800">
          Product Ratings and Reviews ({{ productReviews.total }})
        </h3>
        <div class="space-x-5">
          <ReviewSortDropdown :product="product" />

          <ReviewFilterDropdown :product="product" />
        </div>
      </div>

      <div v-if="productReviews.data.length" class="space-y-5">
        <div
          v-for="productReview in productReviews.data"
          :key="productReview.id"
          class="border border-gray-200 rounded-md flex flex-col items-center space-y-6 justify-between p-6"
        >
          <!-- Review -->
          <ReviewCard :review="productReview" />

          <hr />

          <!-- Reply -->
          <SellerResponseCard
            v-show="productReview.product_review_response"
            :response="productReview.product_review_response"
          />
        </div>

        <!-- Pagination -->
        <div class="my-5 py-5">
          <Pagination :links="productReviews.links" />
        </div>
      </div>
      <div v-else class="py-20 flex items-center w-full">
        <p class="text-center font-bold text-md text-gray-600 w-full">
          <i class="fa-solid fa-file-circle-xmark"></i>
          {{
            $page.props.ziggy.query.rating
              ? __('This product does not have any product reviews for :label stars', {
                  label: $page.props.ziggy.query.rating
                })
              : __('This product does not have any product reviews.')
          }}
        </p>
      </div>
    </div>
  </div>
</template>
