<script setup>
import { computed } from 'vue'

const props = defineProps({ product: Object, productReviewsForAverageProgressBar: Object })

const avgRating = computed(() => {
  const rawAvgRating = props.product?.product_reviews_avg_rating

  const avgRatingValue = parseFloat(rawAvgRating)

  if (!Number.isNaN(avgRatingValue)) {
    return avgRatingValue.toFixed(1)
  }

  return null
})

const starRating = (rating) => {
  const totalRatings = props.productReviewsForAverageProgressBar.filter(
    (review) => review.rating === rating
  )
  const totalReviews = props.productReviewsForAverageProgressBar.length

  if (totalReviews === 0) {
    return 0
  }

  return ((totalRatings.length / totalReviews) * 100).toFixed(0)
}

const oneStarRating = computed(() => starRating(1))
const twoStarsRating = computed(() => starRating(2))
const threeStarsRating = computed(() => starRating(3))
const fourStarsRating = computed(() => starRating(4))
const fiveStarsRating = computed(() => starRating(5))
</script>

<template>
  <div class="text-center mb-10">
    <div class="border border-gray-200 w-[350px] mx-auto px-3 py-5 mb-5 rounded-md shadow">
      <h1 class="text-lg font-bold text-gray-700">
        <i class="fa-solid fa-star"></i>
        Average Ratings And Reviews
      </h1>
    </div>

    <div class="flex items-center justify-center space-x-3 mb-3">
      <!-- Rating -->
      <div class="flex items-center space-x-0.5">
        <template v-for="starIndex in 5" :key="starIndex">
          <svg
            :class="{
              'text-yellow-400': avgRating >= starIndex,
              'text-gray-300': avgRating < starIndex
            }"
            class="flex-shrink-0 w-4 h-4"
            xmlns="http://www.w3.org/2000/svg"
            width="16"
            height="16"
            fill="currentColor"
            viewBox="0 0 16 16"
          >
            <path
              d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
            />
          </svg>
        </template>
      </div>
      <!-- End Rating -->

      <p class="font-bold text-gray-600 text-sm text-center">{{ avgRating }} out of 5</p>
    </div>

    <p class="text-sm font-medium text-gray-600">
      Based on {{ productReviewsForAverageProgressBar.length }} customer ratings
    </p>

    <div class="w-[600px] mx-auto">
      <div class="flex items-center justify-center mt-4">
        <a href="#" class="text-sm font-medium text-orange-600">5 star</a>
        <div class="w-2/4 h-4 mx-4 bg-gray-200 rounded">
          <div class="h-4 bg-yellow-300 rounded" :style="{ width: `${fiveStarsRating}%` }"></div>
        </div>
        <span class="text-sm font-medium text-gray-500">{{ fiveStarsRating }}%</span>
      </div>
      <div class="flex items-center justify-center mt-4">
        <a href="#" class="text-sm font-medium text-orange-600">4 star</a>
        <div class="w-2/4 h-4 mx-4 bg-gray-200 rounded">
          <div class="h-4 bg-yellow-300 rounded" :style="{ width: `${fourStarsRating}%` }"></div>
        </div>
        <span class="text-sm font-medium text-gray-500">{{ fourStarsRating }}%</span>
      </div>
      <div class="flex items-center justify-center mt-4">
        <a href="#" class="text-sm font-medium text-orange-600">3 star</a>
        <div class="w-2/4 h-4 mx-4 bg-gray-200 rounded">
          <div class="h-4 bg-yellow-300 rounded" :style="{ width: `${threeStarsRating}%` }"></div>
        </div>
        <span class="text-sm font-medium text-gray-500">{{ threeStarsRating }}%</span>
      </div>
      <div class="flex items-center justify-center mt-4">
        <a href="#" class="text-sm font-medium text-orange-600">2 star</a>
        <div class="w-2/4 h-4 mx-4 bg-gray-200 rounded">
          <div class="h-4 bg-yellow-300 rounded" :style="{ width: `${twoStarsRating}%` }"></div>
        </div>
        <span class="text-sm font-medium text-gray-500">{{ twoStarsRating }}%</span>
      </div>
      <div class="flex items-center justify-center mt-4">
        <a href="#" class="text-sm font-medium text-orange-600">1 star</a>
        <div class="w-2/4 h-4 mx-4 bg-gray-200 rounded">
          <div class="h-4 bg-yellow-300 rounded" :style="{ width: `${oneStarRating}%` }"></div>
        </div>
        <span class="text-sm font-medium text-gray-500">{{ oneStarRating }}%</span>
      </div>
    </div>
  </div>
</template>
