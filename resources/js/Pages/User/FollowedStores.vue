<script setup>
import UserDashboardLayout from '@/Layouts/UserDashboardLayout.vue'
import NormalButton from '@/Components/Buttons/NormalButton.vue'
import { Head, Link } from '@inertiajs/vue3'
</script>

<template>
  <Head :title="__('Followed Stores')" />
  <UserDashboardLayout>
    <h1 class="font-bold text-md text-gray-700 mb-5 pb-5 border-b">
      <i class="fa-solid fa-store"></i>
      {{ __('Followed Stores') }}
    </h1>

    <div class="px-8 py-10 border border-gray-200 bg-white rounded-md space-y-5">
      <!-- card -->
      <div
        class="border border-gray-200 rounded-md flex items-center justify-between space-x-5 p-5"
      >
        <div class="flex items-center">
          <div class="min-w-[100px] overflow-hidden">
            <img
              src="https://img.freepik.com/free-vector/shop-with-we-are-open-sign_23-2148557016.jpg"
              alt="product image"
              class="w-20 h-20 object-cover"
            />
          </div>
          <div class="space-y-2">
            <div class="flex items-center space-x-2">
              <h3 class="font-semibold text-sm text-gray-700">
                Naviforce NF9049 | Men’s Dual Movement
              </h3>

              <span
                class="shadow px-3 rounded-full py-1 font-bold uppercase text-[0.6rem] text-white bg-orange-600 inline-block border border-orange-400 space-x-2"
              >
                <i class="fas fa-crown"></i>
                Official
              </span>
            </div>

            <div class="flex items-center space-x-3 my-5">
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

              <p class="font-bold text-gray-600 text-xs">3.5 out of 5</p>
            </div>
          </div>
        </div>

        <div class="space-x-5">
          <a class="text-sm font-semibold text-blue-600">
            <i class="fa-solid fa-check"></i>
            Following
          </a>

          <span class="border border-gray-500"></span>
          <a class="text-sm font-semibold text-orange-600">
            <i class="fa-solid fa-store"></i>
            Visit Store
          </a>
        </div>
      </div>

      <!-- card -->
      <div
        class="border border-gray-200 rounded-md flex items-center justify-between space-x-5 p-5"
      >
        <div class="flex items-center">
          <div class="min-w-[100px] overflow-hidden">
            <img
              src="https://img.freepik.com/free-vector/shop-with-we-are-open-sign_23-2148557016.jpg"
              alt="product image"
              class="w-20 h-20 object-cover"
            />
          </div>
          <div class="space-y-2">
            <div class="flex items-center space-x-2">
              <h3 class="font-semibold text-sm text-gray-700">
                Naviforce NF9049 | Men’s Dual Movement
              </h3>

              <span
                class="shadow px-3 rounded-full py-1 font-bold uppercase text-[0.6rem] text-white bg-orange-600 inline-block border border-orange-400 space-x-2"
              >
                <i class="fas fa-crown"></i>
                Official
              </span>
            </div>

            <div class="flex items-center space-x-3 my-5">
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

              <p class="font-bold text-gray-600 text-xs">3.5 out of 5</p>
            </div>
          </div>
        </div>

        <div class="space-x-5">
          <a class="text-sm font-semibold text-blue-600">
            <i class="fa-solid fa-check"></i>
            Following
          </a>

          <span class="border border-gray-500"></span>
          <a class="text-sm font-semibold text-orange-600">
            <i class="fa-solid fa-store"></i>
            Visit Store
          </a>
        </div>
      </div>

      <!-- card -->
      <div
        class="border border-gray-200 rounded-md flex items-center justify-between space-x-5 p-5"
      >
        <div class="flex items-center">
          <div class="min-w-[100px] overflow-hidden">
            <img
              src="https://img.freepik.com/free-vector/shop-with-we-are-open-sign_23-2148557016.jpg"
              alt="product image"
              class="w-20 h-20 object-cover"
            />
          </div>
          <div class="space-y-2">
            <div class="flex items-center space-x-2">
              <h3 class="font-semibold text-sm text-gray-700">
                Naviforce NF9049 | Men’s Dual Movement
              </h3>

              <span
                class="shadow px-3 rounded-full py-1 font-bold uppercase text-[0.6rem] text-white bg-orange-600 inline-block border border-orange-400 space-x-2"
              >
                <i class="fas fa-crown"></i>
                Official
              </span>
            </div>

            <div class="flex items-center space-x-3 my-5">
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

              <p class="font-bold text-gray-600 text-xs">3.5 out of 5</p>
            </div>
          </div>
        </div>

        <div class="space-x-5">
          <a class="text-sm font-semibold text-blue-600">
            <i class="fa-solid fa-check"></i>
            Following
          </a>

          <span class="border border-gray-500"></span>
          <a class="text-sm font-semibold text-orange-600">
            <i class="fa-solid fa-store"></i>
            Visit Store
          </a>
        </div>
      </div>

      <!-- card -->
      <div
        class="border border-gray-200 rounded-md flex items-center justify-between space-x-5 p-5"
      >
        <div class="flex items-center">
          <div class="min-w-[100px] overflow-hidden">
            <img
              src="https://img.freepik.com/free-vector/shop-with-we-are-open-sign_23-2148557016.jpg"
              alt="product image"
              class="w-20 h-20 object-cover"
            />
          </div>
          <div class="space-y-2">
            <div class="flex items-center space-x-2">
              <h3 class="font-semibold text-sm text-gray-700">
                Naviforce NF9049 | Men’s Dual Movement
              </h3>

              <span
                class="shadow px-3 rounded-full py-1 font-bold uppercase text-[0.6rem] text-white bg-orange-600 inline-block border border-orange-400 space-x-2"
              >
                <i class="fas fa-crown"></i>
                Official
              </span>
            </div>

            <div class="flex items-center space-x-3 my-5">
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

              <p class="font-bold text-gray-600 text-xs">3.5 out of 5</p>
            </div>
          </div>
        </div>

        <div class="space-x-5">
          <a class="text-sm font-semibold text-blue-600">
            <i class="fa-solid fa-check"></i>
            Following
          </a>

          <span class="border border-gray-500"></span>
          <a class="text-sm font-semibold text-orange-600">
            <i class="fa-solid fa-store"></i>
            Visit Store
          </a>
        </div>
      </div>

      <!-- card -->
      <div
        class="border border-gray-200 rounded-md flex items-center justify-between space-x-5 p-5"
      >
        <div class="flex items-center">
          <div class="min-w-[100px] overflow-hidden">
            <img
              src="https://img.freepik.com/free-vector/shop-with-we-are-open-sign_23-2148557016.jpg"
              alt="product image"
              class="w-20 h-20 object-cover"
            />
          </div>
          <div class="space-y-2">
            <div class="flex items-center space-x-2">
              <h3 class="font-semibold text-sm text-gray-700">
                Naviforce NF9049 | Men’s Dual Movement
              </h3>

              <span
                class="shadow px-3 rounded-full py-1 font-bold uppercase text-[0.6rem] text-white bg-orange-600 inline-block border border-orange-400 space-x-2"
              >
                <i class="fas fa-crown"></i>
                Official
              </span>
            </div>

            <div class="flex items-center space-x-3 my-5">
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

              <p class="font-bold text-gray-600 text-xs">3.5 out of 5</p>
            </div>
          </div>
        </div>

        <div class="space-x-5">
          <a class="text-sm font-semibold text-blue-600">
            <i class="fa-solid fa-check"></i>
            Following
          </a>

          <span class="border border-gray-500"></span>
          <a class="text-sm font-semibold text-orange-600">
            <i class="fa-solid fa-store"></i>
            Visit Store
          </a>
        </div>
      </div>

      <!-- card -->
      <div
        class="border border-gray-200 rounded-md flex items-center justify-between space-x-5 p-5"
      >
        <div class="flex items-center">
          <div class="min-w-[100px] overflow-hidden">
            <img
              src="https://img.freepik.com/free-vector/shop-with-we-are-open-sign_23-2148557016.jpg"
              alt="product image"
              class="w-20 h-20 object-cover"
            />
          </div>
          <div class="space-y-2">
            <div class="flex items-center space-x-2">
              <h3 class="font-semibold text-sm text-gray-700">
                Naviforce NF9049 | Men’s Dual Movement
              </h3>

              <span
                class="shadow px-3 rounded-full py-1 font-bold uppercase text-[0.6rem] text-white bg-orange-600 inline-block border border-orange-400 space-x-2"
              >
                <i class="fas fa-crown"></i>
                Official
              </span>
            </div>

            <div class="flex items-center space-x-3 my-5">
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

              <p class="font-bold text-gray-600 text-xs">3.5 out of 5</p>
            </div>
          </div>
        </div>

        <div class="space-x-5">
          <a class="text-sm font-semibold text-blue-600">
            <i class="fa-solid fa-check"></i>
            Following
          </a>

          <span class="border border-gray-500"></span>
          <a class="text-sm font-semibold text-orange-600">
            <i class="fa-solid fa-store"></i>
            Visit Store
          </a>
        </div>
      </div>

      <!-- <h2 class="font-semibold text-md text-center text-gray-600">
        <i class="fas fa-shop"></i>

        You didn't follow any shop.
      </h2> -->
    </div>
  </UserDashboardLayout>
</template>
