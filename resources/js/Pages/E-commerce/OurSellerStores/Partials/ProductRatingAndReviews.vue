<script setup>
import ReviewSortDropdown from '@/Components/Dropdowns/ProductReviews/ReveiwSortDropdown.vue'
import ReviewFilterDropdown from '@/Components/Dropdowns/ProductReviews/ReviewFilterDropdown.vue'
import StoreProductReviewCard from '@/Components/Cards/ProductReviews/StoreProductReviewCard.vue'
</script>

<template>
  <div class="py-10 border border-gray-200 bg-white rounded-md space-y-5">
    <div class="px-5">
      <div class="mb-5 flex items-center justify-between">
        <h3 class="font-bold text-md text-gray-800">Product Ratings and Reviews (597)</h3>

        <div class="space-x-5">
          <ReviewSortDropdown />

          <ReviewFilterDropdown />
        </div>
      </div>
      <div class="space-y-5">
        <!-- card -->
        <StoreProductReviewCard />
      </div>
    </div>
  </div>
</template>
