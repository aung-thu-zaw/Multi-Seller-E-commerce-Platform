<script setup>
import InertiaLinkButton from "@/Components/Buttons/InertiaLinkButton.vue";
import NormalButton from "@/Components/Buttons/NormalButton.vue";
import InputField from "@/Components/Forms/Fields/InputField.vue";
import InputLabel from "@/Components/Forms/Fields/InputLabel.vue";
import BrandCarousel from "@/Components/Carousels/BrandCarousel.vue";
import English from "@/assets/images/united-state.png";
import Myanmar from "@/assets/images/myanmar.png";
import { Link } from "@inertiajs/vue3";
</script>

<template>
  <section id="flash-sales" class="my-16">
    <div
      class="container max-w-screen-xl mx-auto border border-gray-200 bg-white rounded-md shadow-md"
    >
      <!-- Title -->
      <div
        class="text-slate-600 flex items-center justify-between border-b px-6 py-3"
      >
        <h2 class="text-2xl font-bold">
          <i class="fa-solid fa-bolt text-orange-600 animate-pulse"></i>
          {{ __("Flash Sales") }}
        </h2>
        <div class="flex items-center space-x-5">
          <div
            class="flex flex-col items-center justify-between font-semibold bg-orange-600 text-white ring-2 ring-orange-200 w-14 h-14 p-3 rounded-sm shadow"
          >
            <span class="text-sm">10</span>
            <span class="text-[.7rem]">Days</span>
          </div>
          <div
            class="flex flex-col items-center justify-between font-semibold bg-orange-600 text-white ring-2 ring-orange-200 w-14 h-14 p-3 rounded-sm shadow"
          >
            <span class="text-sm">5</span>
            <span class="text-[.7rem]">Hours</span>
          </div>
          <div
            class="flex flex-col items-center justify-between font-semibold bg-orange-600 text-white ring-2 ring-orange-200 w-14 h-14 p-3 rounded-sm shadow"
          >
            <span class="text-sm">3</span>
            <span class="text-[.7rem]">Minutes</span>
          </div>
          <div
            class="flex flex-col items-center justify-between font-semibold bg-orange-600 text-white ring-2 ring-orange-200 w-14 h-14 p-3 rounded-sm shadow"
          >
            <span class="text-sm animate-pulse">34</span>
            <span class="text-[.7rem]">Seconds</span>
          </div>
        </div>
        <Link
          href="#"
          class="font-bold text-sm rounded-full px-4 py-2 text-orange-600 border border-orange-600 hover:bg-orange-600 hover:text-white transition-all"
        >
          {{ __("Shop More") }}
          <i class="fa-solid fa-angles-right ml-1"></i>
        </Link>
      </div>

      <div class="grid grid-cols-5 gap-4 p-5">
        <!-- Product Card -->
        <div>
          <article
            class="shadow-sm rounded bg-white border border-gray-200 p-2 overflow-hidden h-[460px] hover:shadow-md hover:scale-105 transition-all"
          >
            <h3 class="block h-[250px] cursor-pointer relative">
              <img
                src="https://images.unsplash.com/photo-1554941426-e9604e34bc94?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Nnx8c2xpZGVyfGVufDB8fDB8fHww"
                class="mx-auto h-full w-full object-cover rounded"
              />
              <span
                class="absolute top-2 right-2 bg-gray-50 rounded-full flex items-center justify-center p-2 text-xs text-gray-600 hover:bg-gray-200 border"
              >
                <i class="fa-solid fa-heart"></i>
              </span>
            </h3>
            <div class="py-4 px-2">
              <span
                class="px-3 rounded-sm py-1 font-bold uppercase text-[0.6rem] text-white bg-orange-600"
              >
                <i class="fas fa-crown"></i>
                Official
              </span>
              <h3
                class="text-sm text-gray-800 font-medium line-clamp-2 cursor-pointer mt-1"
              >
                Cannon MS33 Photo Camera
              </h3>

              <div class="my-2">
                <div>
                  <span class="text-lg font-semibold text-orange-600 block">
                    $ 399
                  </span>
                  <span
                    class="text-[.8rem] text-gray-500 font-medium line-through mr-5"
                  >
                    $ 500
                  </span>
                  <span
                    class="text-[.6rem] px-2 py-1 bg-orange-200 rounded-full text-orange-600 font-bold"
                  >
                    50 % OFF
                  </span>
                </div>
                <!-- <div v-else>
                    <span class="font-semibold text-slate-600 mr-3">
                      ${{ formattedPrice }}
                    </span>
                  </div> -->
              </div>

              <!-- Rating -->
              <div class="flex items-center space-x-0.5 mt-5">
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
            </div>
          </article>
        </div>

        <!-- Product Card -->
        <div>
          <article
            class="shadow-sm rounded bg-white border border-gray-200 p-2 overflow-hidden h-[460px] hover:shadow-md hover:scale-105 transition-all"
          >
            <h3 class="block h-[250px] cursor-pointer relative">
              <img
                src="https://images.unsplash.com/photo-1619290463523-6d18f6a6b220?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MjZ8fHNsaWRlcnxlbnwwfHwwfHx8MA%3D%3D"
                class="mx-auto h-full w-full object-cover rounded"
              />
              <span
                class="absolute top-2 right-2 bg-gray-50 rounded-full flex items-center justify-center p-2 text-xs text-gray-600 hover:bg-gray-200 border"
              >
                <i class="fa-solid fa-heart"></i>
              </span>
            </h3>
            <div class="py-4 px-2">
              <span
                class="px-3 rounded-sm py-1 font-bold uppercase text-[0.6rem] text-white bg-orange-600"
              >
                <i class="fas fa-crown"></i>
                Official
              </span>
              <h3
                class="text-sm text-gray-800 font-medium line-clamp-2 cursor-pointer mt-1"
              >
                Cannon MS33 Photo Camera
              </h3>

              <div class="my-2">
                <div>
                  <span class="text-lg font-semibold text-orange-600 block">
                    $ 399
                  </span>
                  <span
                    class="text-[.8rem] text-gray-500 font-medium line-through mr-5"
                  >
                    $ 500
                  </span>
                  <span
                    class="text-[.6rem] px-2 py-1 bg-orange-200 rounded-full text-orange-600 font-bold"
                  >
                    50 % OFF
                  </span>
                </div>
                <!-- <div v-else>
                    <span class="font-semibold text-slate-600 mr-3">
                      ${{ formattedPrice }}
                    </span>
                  </div> -->
              </div>

              <!-- Rating -->
              <div class="flex items-center space-x-0.5 mt-5">
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
            </div>
          </article>
        </div>

        <!-- Product Card -->
        <div>
          <article
            class="shadow-sm rounded bg-white border border-gray-200 p-2 overflow-hidden h-[460px] hover:shadow-md hover:scale-105 transition-all"
          >
            <h3 class="block h-[250px] cursor-pointer relative">
              <img
                src="https://images.unsplash.com/photo-1616205255807-b55f2513eced?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NDZ8fHNsaWRlcnxlbnwwfHwwfHx8MA%3D%3D"
                class="mx-auto h-full w-full object-cover rounded"
              />
              <span
                class="absolute top-2 right-2 bg-gray-50 rounded-full flex items-center justify-center p-2 text-xs text-gray-600 hover:bg-gray-200 border"
              >
                <i class="fa-solid fa-heart"></i>
              </span>
            </h3>
            <div class="py-4 px-2">
              <span
                class="px-3 rounded-sm py-1 font-bold uppercase text-[0.6rem] text-white bg-orange-600"
              >
                <i class="fas fa-crown"></i>
                Official
              </span>
              <h3
                class="text-sm text-gray-800 font-medium line-clamp-2 cursor-pointer mt-1"
              >
                Cannon MS33 Photo Camera
              </h3>

              <div class="my-2">
                <div>
                  <span class="text-lg font-semibold text-orange-600 block">
                    $ 399
                  </span>
                  <span
                    class="text-[.8rem] text-gray-500 font-medium line-through mr-5"
                  >
                    $ 500
                  </span>
                  <span
                    class="text-[.6rem] px-2 py-1 bg-orange-200 rounded-full text-orange-600 font-bold"
                  >
                    50 % OFF
                  </span>
                </div>
                <!-- <div v-else>
                    <span class="font-semibold text-slate-600 mr-3">
                      ${{ formattedPrice }}
                    </span>
                  </div> -->
              </div>

              <!-- Rating -->
              <div class="flex items-center space-x-0.5 mt-5">
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
            </div>
          </article>
        </div>

        <!-- Product Card -->
        <div>
          <article
            class="shadow-sm rounded bg-white border border-gray-200 p-2 overflow-hidden h-[460px] hover:shadow-md hover:scale-105 transition-all"
          >
            <h3 class="block h-[250px] cursor-pointer relative">
              <img
                src="https://images.unsplash.com/photo-1554941426-fdb44a2aae8b?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NDh8fHNsaWRlcnxlbnwwfHwwfHx8MA%3D%3D"
                class="mx-auto h-full w-full object-cover rounded"
              />
              <span
                class="absolute top-2 right-2 bg-gray-50 rounded-full flex items-center justify-center p-2 text-xs text-gray-600 hover:bg-gray-200 border"
              >
                <i class="fa-solid fa-heart"></i>
              </span>
            </h3>
            <div class="py-4 px-2">
              <span
                class="px-3 rounded-sm py-1 font-bold uppercase text-[0.6rem] text-white bg-orange-600"
              >
                <i class="fas fa-crown"></i>
                Official
              </span>
              <h3
                class="text-sm text-gray-800 font-medium line-clamp-2 cursor-pointer mt-1"
              >
                Cannon MS33 Photo Camera
              </h3>

              <div class="my-2">
                <div>
                  <span class="text-lg font-semibold text-orange-600 block">
                    $ 399
                  </span>
                  <span
                    class="text-[.8rem] text-gray-500 font-medium line-through mr-5"
                  >
                    $ 500
                  </span>
                  <span
                    class="text-[.6rem] px-2 py-1 bg-orange-200 rounded-full text-orange-600 font-bold"
                  >
                    50 % OFF
                  </span>
                </div>
                <!-- <div v-else>
                    <span class="font-semibold text-slate-600 mr-3">
                      ${{ formattedPrice }}
                    </span>
                  </div> -->
              </div>

              <!-- Rating -->
              <div class="flex items-center space-x-0.5 mt-5">
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
            </div>
          </article>
        </div>

        <!-- Product Card -->
        <div>
          <article
            class="shadow-sm rounded bg-white border border-gray-200 p-2 overflow-hidden h-[460px] hover:shadow-md hover:scale-105 transition-all"
          >
            <h3 class="block h-[250px] cursor-pointer relative">
              <img
                src="https://images.unsplash.com/photo-1554940563-d7137919598a?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NjR8fHNsaWRlcnxlbnwwfHwwfHx8MA%3D%3D"
                class="mx-auto h-full w-full object-cover rounded"
              />
              <span
                class="absolute top-2 right-2 bg-gray-50 rounded-full flex items-center justify-center p-2 text-xs text-gray-600 hover:bg-gray-200 border"
              >
                <i class="fa-solid fa-heart"></i>
              </span>
            </h3>
            <div class="py-4 px-2">
              <span
                class="px-3 rounded-sm py-1 font-bold uppercase text-[0.6rem] text-white bg-orange-600"
              >
                <i class="fas fa-crown"></i>
                Official
              </span>
              <h3
                class="text-sm text-gray-800 font-medium line-clamp-2 cursor-pointer mt-1"
              >
                Cannon MS33 Photo Camera
              </h3>

              <div class="my-2">
                <div>
                  <span class="text-lg font-semibold text-orange-600 block">
                    $ 399
                  </span>
                  <span
                    class="text-[.8rem] text-gray-500 font-medium line-through mr-5"
                  >
                    $ 500
                  </span>
                  <span
                    class="text-[.6rem] px-2 py-1 bg-orange-200 rounded-full text-orange-600 font-bold"
                  >
                    50 % OFF
                  </span>
                </div>
                <!-- <div v-else>
                    <span class="font-semibold text-slate-600 mr-3">
                      ${{ formattedPrice }}
                    </span>
                  </div> -->
              </div>

              <!-- Rating -->
              <div class="flex items-center space-x-0.5 mt-5">
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
            </div>
          </article>
        </div>
      </div>
    </div>
  </section>
</template>
