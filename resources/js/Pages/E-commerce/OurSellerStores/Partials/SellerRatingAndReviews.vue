<script setup>
import ReviewSortDropdown from '@/Components/Dropdowns/Reviews/ReviewSortDropdown.vue'
import ReviewFilterDropdown from '@/Components/Dropdowns/Reviews/ReviewFilterDropdown.vue'
import ReviewCard from '@/Components/Cards/Reviews/ReviewCard.vue'
import SellerResponseCard from '@/Components/Cards/Reviews/SellerResponseCard.vue'
</script>

<template>
  <div class="py-10 border border-gray-200 bg-white rounded-md space-y-5">
    <!-- Store Avg Stars With Progress Bar -->
    <div class="text-center mb-10">
      <div class="border border-gray-200 w-[350px] mx-auto px-3 py-5 mb-5 rounded-md">
        <h1 class="text-lg font-bold text-gray-700">
          <i class="fa-solid fa-star"></i>
          Seller Ratings And Reviews
        </h1>
      </div>

      <div class="flex items-center justify-center space-x-3 mb-3">
        <!-- Rating -->
        <div class="flex items-center space-x-0.5">
          <svg
            class="flex-shrink-0 w-4 h-4 text-yellow-400"
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
          <svg
            class="flex-shrink-0 w-4 h-4 text-yellow-400"
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
          <svg
            class="flex-shrink-0 w-4 h-4 text-yellow-400"
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
          <svg
            class="flex-shrink-0 w-4 h-4 text-gray-300"
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
          <svg
            class="flex-shrink-0 w-4 h-4 text-gray-300"
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
        </div>
        <!-- End Rating -->

        <p class="font-bold text-gray-600 text-sm text-center">3.5 out of 5</p>
      </div>

      <p class="text-sm font-medium text-gray-600">Based on 135 customer ratings</p>

      <div class="w-[600px] mx-auto">
        <div class="flex items-center justify-center mt-4">
          <a href="#" class="text-sm font-medium text-orange-600">5 star</a>
          <div class="w-2/4 h-4 mx-4 bg-gray-200 rounded">
            <div class="h-4 bg-yellow-300 rounded" style="width: 70%"></div>
          </div>
          <span class="text-sm font-medium text-gray-500">70%</span>
        </div>
        <div class="flex items-center justify-center mt-4">
          <a href="#" class="text-sm font-medium text-orange-600">4 star</a>
          <div class="w-2/4 h-4 mx-4 bg-gray-200 rounded">
            <div class="h-4 bg-yellow-300 rounded" style="width: 17%"></div>
          </div>
          <span class="text-sm font-medium text-gray-500">17%</span>
        </div>
        <div class="flex items-center justify-center mt-4">
          <a href="#" class="text-sm font-medium text-orange-600">3 star</a>
          <div class="w-2/4 h-4 mx-4 bg-gray-200 rounded">
            <div class="h-4 bg-yellow-300 rounded" style="width: 8%"></div>
          </div>
          <span class="text-sm font-medium text-gray-500">8%</span>
        </div>
        <div class="flex items-center justify-center mt-4">
          <a href="#" class="text-sm font-medium text-orange-600">2 star</a>
          <div class="w-2/4 h-4 mx-4 bg-gray-200 rounded">
            <div class="h-4 bg-yellow-300 rounded" style="width: 4%"></div>
          </div>
          <span class="text-sm font-medium text-gray-500">4%</span>
        </div>
        <div class="flex items-center justify-center mt-4">
          <a href="#" class="text-sm font-medium text-orange-600">1 star</a>
          <div class="w-2/4 h-4 mx-4 bg-gray-200 rounded">
            <div class="h-4 bg-yellow-300 rounded" style="width: 1%"></div>
          </div>
          <span class="text-sm font-medium text-gray-500">1%</span>
        </div>
      </div>
    </div>

    <hr />

    <div class="px-5">
      <div class="mb-5 flex items-center justify-between">
        <h3 class="font-bold text-md text-gray-800">Seller Ratings and Reviews (597)</h3>

        <div class="space-x-5">
          <ReviewSortDropdown />

          <ReviewFilterDropdown />
        </div>
      </div>

      <div
        class="border border-gray-200 rounded-md flex flex-col items-center space-y-6 justify-between p-6"
      >
        <!-- Review -->
        <ReviewCard />

        <hr />

        <!-- Reply -->
        <SellerResponseCard />
      </div>
    </div>

    <hr />
  </div>
</template>
