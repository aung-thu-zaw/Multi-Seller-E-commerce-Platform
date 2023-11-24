<script setup>
import InertiaLinkButton from '@/Components/Buttons/InertiaLinkButton.vue'
import NormalButton from '@/Components/Buttons/NormalButton.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import BrandCarousel from '@/Components/Carousels/BrandCarousel.vue'
import English from '@/assets/images/united-state.png'
import Myanmar from '@/assets/images/myanmar.png'
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <section id="product-for-you" class="my-5">
    <div class="container max-w-screen-xl mx-auto bg-transparent rounded-md pt-6">
      <!-- Title -->
      <div class="text-slate-600 flex items-center justify-between py-3">
        <h2 class="text-2xl font-bold">
          {{ __('Products For You') }}
        </h2>

        <div class="flex items-center space-x-2">
          <span
            class="font-bold text-sm bg-orange-500 text-white px-3 py-1.5 rounded-sm transition-all cursor-pointer"
            >New Arrivals</span
          >
          <span
            class="font-bold text-sm text-gray-600 hover:bg-orange-50 px-3 py-1.5 rounded-sm transition-all cursor-pointer"
            >Featured Product</span
          >
          <span
            class="font-bold text-sm text-gray-600 hover:bg-orange-50 px-3 py-1.5 rounded-sm transition-all cursor-pointer"
            >Top Product</span
          >
        </div>
      </div>

      <hr class="mb-3" />

      <div class="grid grid-cols-5 gap-3 py-3">
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
              <div
                class="badge-gradient shadow px-3 rounded-sm py-1 font-bold uppercase text-[0.6rem] text-white bg-orange-600 inline-block border border-orange-400 space-x-2"
              >
                <span>
                  <i class="fas fa-crown"></i>
                  Official
                </span>
                <span class="font-bold text-orange-500"> Flagship </span>
              </div>

              <h3 class="text-sm text-gray-800 font-medium line-clamp-2 cursor-pointer mt-1">
                Cannon MS33 Photo Camera
              </h3>

              <div class="my-2">
                <div>
                  <span class="text-lg font-semibold text-orange-600 block"> $ 399 </span>
                  <span class="text-[.8rem] text-gray-500 font-medium line-through mr-5">
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
              <h3 class="text-sm text-gray-800 font-medium line-clamp-2 cursor-pointer mt-1">
                Cannon MS33 Photo Camera
              </h3>

              <div class="my-2">
                <div>
                  <span class="text-lg font-semibold text-orange-600 block"> $ 399 </span>
                  <span class="text-[.8rem] text-gray-500 font-medium line-through mr-5">
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
              <h3 class="text-sm text-gray-800 font-medium line-clamp-2 cursor-pointer mt-1">
                Cannon MS33 Photo Camera
              </h3>

              <div class="my-2">
                <div>
                  <span class="text-lg font-semibold text-orange-600 block"> $ 399 </span>
                  <span class="text-[.8rem] text-gray-500 font-medium line-through mr-5">
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
              <h3 class="text-sm text-gray-800 font-medium line-clamp-2 cursor-pointer mt-1">
                Cannon MS33 Photo Camera
              </h3>

              <div class="my-2">
                <div>
                  <span class="text-lg font-semibold text-orange-600 block"> $ 399 </span>
                  <span class="text-[.8rem] text-gray-500 font-medium line-through mr-5">
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
              <h3 class="text-sm text-gray-800 font-medium line-clamp-2 cursor-pointer mt-1">
                Cannon MS33 Photo Camera
              </h3>

              <div class="my-2">
                <div>
                  <span class="text-lg font-semibold text-orange-600 block"> $ 399 </span>
                  <span class="text-[.8rem] text-gray-500 font-medium line-through mr-5">
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
              <div
                class="badge-gradient shadow px-3 rounded-sm py-1 font-bold uppercase text-[0.6rem] text-white bg-orange-600 inline-block border border-orange-400 space-x-2"
              >
                <span>
                  <i class="fas fa-crown"></i>
                  Official
                </span>
                <span class="font-bold text-orange-500"> Flagship </span>
              </div>

              <h3 class="text-sm text-gray-800 font-medium line-clamp-2 cursor-pointer mt-1">
                Cannon MS33 Photo Camera
              </h3>

              <div class="my-2">
                <div>
                  <span class="text-lg font-semibold text-orange-600 block"> $ 399 </span>
                  <span class="text-[.8rem] text-gray-500 font-medium line-through mr-5">
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
              <h3 class="text-sm text-gray-800 font-medium line-clamp-2 cursor-pointer mt-1">
                Cannon MS33 Photo Camera
              </h3>

              <div class="my-2">
                <div>
                  <span class="text-lg font-semibold text-orange-600 block"> $ 399 </span>
                  <span class="text-[.8rem] text-gray-500 font-medium line-through mr-5">
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
              <h3 class="text-sm text-gray-800 font-medium line-clamp-2 cursor-pointer mt-1">
                Cannon MS33 Photo Camera
              </h3>

              <div class="my-2">
                <div>
                  <span class="text-lg font-semibold text-orange-600 block"> $ 399 </span>
                  <span class="text-[.8rem] text-gray-500 font-medium line-through mr-5">
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
              <h3 class="text-sm text-gray-800 font-medium line-clamp-2 cursor-pointer mt-1">
                Cannon MS33 Photo Camera
              </h3>

              <div class="my-2">
                <div>
                  <span class="text-lg font-semibold text-orange-600 block"> $ 399 </span>
                  <span class="text-[.8rem] text-gray-500 font-medium line-through mr-5">
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
              <h3 class="text-sm text-gray-800 font-medium line-clamp-2 cursor-pointer mt-1">
                Cannon MS33 Photo Camera
              </h3>

              <div class="my-2">
                <div>
                  <span class="text-lg font-semibold text-orange-600 block"> $ 399 </span>
                  <span class="text-[.8rem] text-gray-500 font-medium line-through mr-5">
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
              <div
                class="badge-gradient shadow px-3 rounded-sm py-1 font-bold uppercase text-[0.6rem] text-white bg-orange-600 inline-block border border-orange-400 space-x-2"
              >
                <span>
                  <i class="fas fa-crown"></i>
                  Official
                </span>
                <span class="font-bold text-orange-500"> Flagship </span>
              </div>

              <h3 class="text-sm text-gray-800 font-medium line-clamp-2 cursor-pointer mt-1">
                Cannon MS33 Photo Camera
              </h3>

              <div class="my-2">
                <div>
                  <span class="text-lg font-semibold text-orange-600 block"> $ 399 </span>
                  <span class="text-[.8rem] text-gray-500 font-medium line-through mr-5">
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
              <h3 class="text-sm text-gray-800 font-medium line-clamp-2 cursor-pointer mt-1">
                Cannon MS33 Photo Camera
              </h3>

              <div class="my-2">
                <div>
                  <span class="text-lg font-semibold text-orange-600 block"> $ 399 </span>
                  <span class="text-[.8rem] text-gray-500 font-medium line-through mr-5">
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
              <h3 class="text-sm text-gray-800 font-medium line-clamp-2 cursor-pointer mt-1">
                Cannon MS33 Photo Camera
              </h3>

              <div class="my-2">
                <div>
                  <span class="text-lg font-semibold text-orange-600 block"> $ 399 </span>
                  <span class="text-[.8rem] text-gray-500 font-medium line-through mr-5">
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
              <h3 class="text-sm text-gray-800 font-medium line-clamp-2 cursor-pointer mt-1">
                Cannon MS33 Photo Camera
              </h3>

              <div class="my-2">
                <div>
                  <span class="text-lg font-semibold text-orange-600 block"> $ 399 </span>
                  <span class="text-[.8rem] text-gray-500 font-medium line-through mr-5">
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
              <h3 class="text-sm text-gray-800 font-medium line-clamp-2 cursor-pointer mt-1">
                Cannon MS33 Photo Camera
              </h3>

              <div class="my-2">
                <div>
                  <span class="text-lg font-semibold text-orange-600 block"> $ 399 </span>
                  <span class="text-[.8rem] text-gray-500 font-medium line-through mr-5">
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
              <div
                class="badge-gradient shadow px-3 rounded-sm py-1 font-bold uppercase text-[0.6rem] text-white bg-orange-600 inline-block border border-orange-400 space-x-2"
              >
                <span>
                  <i class="fas fa-crown"></i>
                  Official
                </span>
                <span class="font-bold text-orange-500"> Flagship </span>
              </div>

              <h3 class="text-sm text-gray-800 font-medium line-clamp-2 cursor-pointer mt-1">
                Cannon MS33 Photo Camera
              </h3>

              <div class="my-2">
                <div>
                  <span class="text-lg font-semibold text-orange-600 block"> $ 399 </span>
                  <span class="text-[.8rem] text-gray-500 font-medium line-through mr-5">
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
              <h3 class="text-sm text-gray-800 font-medium line-clamp-2 cursor-pointer mt-1">
                Cannon MS33 Photo Camera
              </h3>

              <div class="my-2">
                <div>
                  <span class="text-lg font-semibold text-orange-600 block"> $ 399 </span>
                  <span class="text-[.8rem] text-gray-500 font-medium line-through mr-5">
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
              <h3 class="text-sm text-gray-800 font-medium line-clamp-2 cursor-pointer mt-1">
                Cannon MS33 Photo Camera
              </h3>

              <div class="my-2">
                <div>
                  <span class="text-lg font-semibold text-orange-600 block"> $ 399 </span>
                  <span class="text-[.8rem] text-gray-500 font-medium line-through mr-5">
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
              <h3 class="text-sm text-gray-800 font-medium line-clamp-2 cursor-pointer mt-1">
                Cannon MS33 Photo Camera
              </h3>

              <div class="my-2">
                <div>
                  <span class="text-lg font-semibold text-orange-600 block"> $ 399 </span>
                  <span class="text-[.8rem] text-gray-500 font-medium line-through mr-5">
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
              <h3 class="text-sm text-gray-800 font-medium line-clamp-2 cursor-pointer mt-1">
                Cannon MS33 Photo Camera
              </h3>

              <div class="my-2">
                <div>
                  <span class="text-lg font-semibold text-orange-600 block"> $ 399 </span>
                  <span class="text-[.8rem] text-gray-500 font-medium line-through mr-5">
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

      <div class="my-8 flex items-center justify-center">
        <button
          class="border text-sm border-orange-600 px-24 py-3 font-bold text-orange-600 rounded-sm shadow-md bg-orange-600 bg-opacity-0 hover:bg-opacity-100 hover:text-white transition-all"
        >
          Load More Product
        </button>
      </div>
    </div>
  </section>
</template>
