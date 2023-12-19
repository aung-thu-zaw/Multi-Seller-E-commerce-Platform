<script setup>
import ReviewSortDropdown from '@/Components/Dropdowns/Reviews/ReviewSortDropdown.vue'
import ReviewFilterDropdown from '@/Components/Dropdowns/Reviews/ReviewFilterDropdown.vue'
import StoreProductReviewCard from '@/Components/Cards/Reviews/StoreProductReviewCard.vue'
import Pagination from '@/Components/Paginations/Pagination.vue'

defineProps({ store: Object, productReviews: Object })
</script>

<template>
  <div class="py-10 border border-gray-200 bg-white rounded-md space-y-5">
    <div class="px-5">
      <div class="mb-5 flex items-center justify-between">
        <h3 class="font-bold text-md text-gray-800">
          Product Ratings and Reviews ({{ productReviews.total }})
        </h3>

        <div class="space-x-5">
          <ReviewSortDropdown :store="store" />

          <ReviewFilterDropdown :store="store" />
        </div>
      </div>
      <div v-if="productReviews.data.length" class="space-y-5">
        <!-- card -->
        <StoreProductReviewCard
          v-for="productReview in productReviews.data"
          :key="productReview.id"
          :productReview="productReview"
        />

        <!-- Pagination -->
        <div class="my-5 py-5">
          <Pagination :links="productReviews.links" />
        </div>
      </div>
      <div v-else class="py-20">
        <p class="text-center font-bold text-md text-orange-600">
          <i class="fa-solid fa-file-circle-xmark"></i>
          {{
            $page.props.ziggy.query.rating
              ? __('This store does not have any product reviews for :label stars', {
                  label: $page.props.ziggy.query.rating
                })
              : __('This store does not have any product reviews.')
          }}
        </p>
      </div>
    </div>
  </div>
</template>
