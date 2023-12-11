<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <div class="shadow-md bg-white rounded-md flex items-center h-[180px]">
    <div
      class="flex flex-col items-center justify-center w-[300px] h-full border-r border-r-slate-300 p-2"
    >
      <img
        src="https://img.freepik.com/free-vector/shop-with-we-are-open-sign_23-2148557016.jpg"
        alt=""
        class="rounded-full w-12 h-12 object-cover border border-orange-500 ring-2 ring-orange-300 shadow-md"
      />
      <div class="mt-3 flex flex-col items-center justify-between">
        <h1 class="font-bold text-sm text-slate-600 text-center line-clamp-2">
          K Mobile Shop
          <!-- <span class="text-green-400 rounded-xl">
            <i class="fa-solid fa-circle-check ml-2"></i>
          </span> -->
        </h1>

        <div class="space-y-2 mt-5">
          <!-- Rating -->
          <div class="flex items-center space-x-0.5">
            <svg
              class="flex-shrink-0 w-3.5 h-3.5 text-yellow-400"
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
              class="flex-shrink-0 w-3.5 h-3.5 text-yellow-400"
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
              class="flex-shrink-0 w-3.5 h-3.5 text-yellow-400"
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
              class="flex-shrink-0 w-3.5 h-3.5 text-gray-300"
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
              class="flex-shrink-0 w-3.5 h-3.5 text-gray-300"
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

          <p class="font-bold text-gray-600 text-xs text-center">3.5 out of 5</p>
        </div>
      </div>
    </div>
    <div class="w-full h-full px-3 py-5 flex flex-col items-center justify-between">
      <div class="flex items-start justify-between w-full">
        <div>
          <p class="text-md text-gray-600 font-semibold border-b border-b-slate-400 mb-2">
            Products
          </p>
          <p class="text-sm text-gray-500 text-center">13</p>
        </div>
        <div>
          <p class="text-md text-gray-600 font-semibold border-b border-b-slate-400 mb-2">
            Followers
          </p>
          <p class="text-sm text-gray-500 text-center">5</p>
        </div>
      </div>

      <Link
        as="button"
        href="#"
        class="border border-orange-600 px-2 py-2 text-orange-600 text-xs font-bold rounded-sm shadow hover:bg-orange-600 hover:text-white transition-all"
      >
        <i class="fa-solid fa-store"></i>
        {{ __('Visit Store') }}
      </Link>
    </div>
  </div>
</template>

