<script setup>
import ReviewCard from './ReviewCard.vue'
import SellerResponseCard from './SellerResponseCard.vue'

defineProps({ productReview: Object })
</script>

<template>
  <div
    class="border border-gray-200 rounded-md flex flex-col items-center space-y-6 justify-between p-6"
  >
    <div class="w-full flex items-start bg-gray-100 px-5 py-2.5 rounded-md border border-gray-200">
      <div class="min-w-[100px] overflow-hidden">
        <img
          :src="productReview?.product?.image"
          alt="product-image"
          class="w-20 h-20 object-cover rounded-md"
        />
      </div>
      <div class="space-y-1">
        <h3 class="font-semibold text-sm text-gray-700 line-clamp-2">
          {{ productReview?.product?.name }}
        </h3>

        <div class="space-x-1 flex items-center text-xs font-medium mb-5">
          <p>Brand : Water</p>
          <span class="text-gray-500">|</span>
          <p>Color : Orange</p>
          <span class="text-gray-500">|</span>
          <p>Size : Lg</p>
        </div>
      </div>
    </div>

    <!-- Review -->
    <ReviewCard :review="productReview" />

    <hr />

    <!-- Reply -->
    <SellerResponseCard
      v-show="productReview.product_review_response"
      :response="productReview.product_review_response"
    />
  </div>
</template>
