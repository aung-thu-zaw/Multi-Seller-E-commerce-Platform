<script setup>
import StoreRatingWithProgressBar from '@/Components/Ratings/StoreRatingWithProgressBar.vue'
import ReviewSortDropdown from '@/Components/Dropdowns/Reviews/Stores/ReviewSortDropdown.vue'
import ReviewFilterDropdown from '@/Components/Dropdowns/Reviews/Stores/ReviewFilterDropdown.vue'
import ReviewCard from '@/Components/Cards/Reviews/ReviewCard.vue'
import SellerResponseCard from '@/Components/Cards/Reviews/SellerResponseCard.vue'
import Pagination from '@/Components/Paginations/Pagination.vue'

defineProps({ store: Object, storeReviews: Object, storeReviewsForAverageProgressBar: Object })
</script>

<template>
  <div class="py-10 border border-gray-200 bg-white rounded-md space-y-5">
    <!-- Store Avg Stars With Progress Bar -->
    <StoreRatingWithProgressBar
      :store="store"
      :storeReviewsForAverageProgressBar="storeReviewsForAverageProgressBar"
    />

    <hr />

    <div class="px-5">
      <div class="mb-5 flex items-center justify-between">
        <h3 class="font-bold text-md text-gray-800">
          Store Ratings and Reviews ({{ storeReviews.total }})
        </h3>

        <div class="space-x-5">
          <ReviewSortDropdown :store="store" />

          <ReviewFilterDropdown :store="store" />
        </div>
      </div>

      <div v-if="storeReviews.data.length" class="space-y-5">
        <div
          v-for="storeReview in storeReviews.data"
          :key="storeReview.id"
          class="border border-gray-200 rounded-md flex flex-col items-center space-y-6 justify-between p-6"
        >
          <!-- Review -->
          <ReviewCard :review="storeReview" />

          <hr />

          <!-- Reply -->
          <SellerResponseCard
            v-show="storeReview.store_review_response"
            :response="storeReview.store_review_response"
          />
        </div>

        <!-- Pagination -->
        <div class="my-5 py-5">
          <Pagination :links="storeReviews.links" />
        </div>
      </div>
      <div v-else class="py-20 flex items-center border w-full">
        <p class="text-center font-bold text-md text-gray-600 w-full">
          <i class="fa-solid fa-file-circle-xmark"></i>
          {{
            $page.props.ziggy.query.rating
              ? __('This store does not have any store reviews for :label stars', {
                  label: $page.props.ziggy.query.rating
                })
              : __('This store does not have any store reviews.')
          }}
        </p>
      </div>
    </div>
  </div>
</template>
