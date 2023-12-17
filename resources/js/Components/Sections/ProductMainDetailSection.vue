<script setup>
import GreenBadge from '@/Components/Badges/GreenBadge.vue'
</script>


<template>
  <div class="rounded-md bg-white border border-gray-200 overflow-hidden">
    <div class="flex items-start justify-between space-x-10">
      <aside class="w-5/12 p-5">
        <!-- Dynamic Display Active Image -->
        <div class="text-center rounded mb-5">
          <img
            class="object-cover inline-block w-[500px] h-full"
            src="https://images.pexels.com/photos/4164088/pexels-photo-4164088.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
            alt="product.name"
          />
        </div>

        <!-- Multi Product Images -->
        <div class="space-x-2 overflow-auto text-center whitespace-nowrap scrollbar">
          <div class="inline-block border border-gray-400 p-1 rounded-md hover:border-blue-500">
            <img
              class="w-14 h-14"
              src="https://www.lezzat.co.uk/wp-content/uploads/2021/03/Amazon-Product-Photography-Agency-UK-1.jpg"
              alt="product.name"
            />
          </div>
          <div class="inline-block border border-gray-400 p-1 rounded-md hover:border-blue-500">
            <img
              class="w-14 h-14"
              src="https://us.123rf.com/450wm/rekalawa/rekalawa2308/rekalawa230800283/211352410-top-view-of-vintage-camera-and-travel-itemsle-background-with-copy-space.jpg?ver=6"
              alt="product.name"
            />
          </div>
          <div class="inline-block border border-gray-400 p-1 rounded-md hover:border-blue-500">
            <img
              class="w-14 h-14"
              src="https://images.pexels.com/photos/90946/pexels-photo-90946.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
              alt="product.name"
            />
          </div>
        </div>
      </aside>

      <div class="w-7/12 flex items-start justify-between">
        <main class="space-y-5 py-5">
          <!-- Product  -->
          <div class="w-full flex items-center justify-between">
            <div class="">
              <h2 class="font-semibold text-2xl">Cannon Camera X234 G Series</h2>
            </div>

            <!-- <div class="flex items-center space-x-2"> -->
            <!-- <button
                    class="rounded-full w-8 h-8 bg-gray-100 text-gray-700 hover:bg-gray-200 hover:text-gray-800 flex items-center text-xs justify-center border"
                  >
                    <i class="fa-solid fa-heart"></i>
                  </button> -->
            <!-- Popover -->
            <!-- <div class="hs-tooltip inline-block [--trigger:click] [--placement:bottom]">
                    <button
                      type="button"
                      class="hs-tooltip-toggle flex justify-center items-center h-10 w-10 text-sm font-semibold"
                    >
                      <span
                        class="rounded-full w-8 h-8 bg-gray-100 text-gray-700 hover:bg-gray-200 hover:text-gray-800 flex items-center justify-center border"
                      >
                        <i class="fa-solid fa-share-nodes"></i>
                      </span>
                      <div
                        class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-3 px-4 bg-white border text-sm text-gray-600 rounded-lg shadow-md"
                        role="tooltip"
                      >
                        <ul class="space-y-3">
                          <li>Facebook</li>
                          <li>Twitter</li>
                          <li>LinkedIn</li>
                          <li>Instagram</li>
                          <li>Youtube</li>
                        </ul>
                      </div>
                    </button>
                  </div> -->
            <!-- End Popover -->
            <!-- </div> -->
          </div>

          <!-- Average Product Review -->
          <!-- <div  class="flex items-center">
              <svg
                aria-hidden="true"
                class="w-5 h-5 text-yellow-400"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              >
                <title>Rating star</title>
                <path
                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                ></path>
              </svg>
              <p class="ml-2 text-sm font-bold text-gray-900 dark:text-white">
                {{ reviewAvg }}
              </p>
              <span class="w-1 h-1 mx-1.5 bg-gray-500 rounded-full dark:bg-gray-400"></span>
              <a
                href="#"
                class="text-sm font-medium text-gray-900 underline hover:no-underline dark:text-white"
                >{{ productReviews.length }} reviews</a
              >
            </div> -->
          <div class="flex items-center">
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

            <p class="text-sm font-medium text-gray-700 ml-3">No Reviews</p>
          </div>

          <!-- Current Total Product -->
          <div class="my-3">
            <span class="text-secondary-700 font-semibold text-sm mr-3">Total 5 Available</span>
            <GreenBadge> In stock </GreenBadge>
          </div>
          <!-- <div v-else-if="product.qty == 0" class="my-3">
              <span class="text-secondary-700 font-semibold text-sm mr-3"
                >{{ product.qty }} Available</span
              >

              <span class="text-red-500 font-bold text-sm bg-red-200 px-2 py-1 rounded-full"
                >Sold Out</span
              >
            </div> -->

          <!-- Product Brand -->
          <p class="text-gray-500 text-sm font-semibold">
            <i class="fa fa-award"></i>
            <!-- <span v-if="product.brand"> Brand : {{ product.brand.name }} </span> -->
            <span> Brand : No Brand </span>
          </p>

          <!-- Product Price -->
          <!-- <div v-if="product.discount" class="my-3">
              <p class="font-semibold text-xl mb-1">${{ product.discount }}</p>
              <p class="font-normal text-sm mb-3">
                <span class="text-secondary-600 line-through mr-3">${{ product.price }} </span>
                <span class="bg-green-200 text-green-500 py-[.2rem] px-2 rounded-full">
                  {{ (((product.price - product.discount) / product.price) * 100).toFixed(1) }}%
                </span>
              </p>
            </div> -->

          <div class="my-3">
            <p class="font-semibold text-xl mb-1">$ 500</p>
          </div>

          <!-- Choose Sizes  -->
          <!-- <div v-if="product.sizes.length" class="my-5 flex items-center">
              <span class="text-secondary-800 mr-5"> Sizes </span>
              <div v-for="size in product.sizes" :key="size.id" class="flex items-center">
                <div class="flex items-center mr-3">
                  <input
                    type="radio"
                    :id="size.name"
                    name="size"
                    :value="size.name"
                    class="hidden peer"
                    v-model="selectedSize"
                    required
                  />
                  <label
                    :for="size.name"
                    class="px-3 py-1 text-secondary-800 shadow-md bg-white border-2 border-gray-200 rounded-sm cursor-pointer peer-checked:border-gray-400 hover:text-gray-600 peer-checked:text-gray-600 hover:bg-gray-50"
                  >
                    <div class="rounded-sm uppercase font-bold text-sm">
                      {{ size.name }}
                    </div>
                  </label>
                </div>
              </div>
            </div> -->

          <!-- Choose Color  -->
          <!-- <div v-if="product.colors.length" class="my-5 flex items-center">
              <span class="text-secondary-800 mr-5"> Colors </span>
              <div v-for="color in product.colors" :key="color.id" class="flex items-center">
                <div class="flex items-center mr-3">
                  <input
                    type="radio"
                    :id="color.name"
                    name="color"
                    :value="color.name"
                    class="hidden peer"
                    v-model="selectedColor"
                    required
                  />
                  <label
                    :for="color.name"
                    class="w-7 h-7 text-gray-500 bg-white border-[3px] border-gray-100 shadow-md rounded-sm cursor-pointer peer-checked:border-gray-400 peer-checked:w-8 peer-checked:h-8 hover:text-gray-600 peer-checked:text-gray-600 hover:bg-gray-50"
                  >
                    <div
                      class="w-full h-full rounded-sm"
                      :class="'bg-' + color.name + '-600'"
                    ></div>
                  </label>
                </div>
              </div>
            </div> -->

          <!-- Handle Quantity -->
          <div class="my-5 flex items-center">
            <p class="font-medium text-md text-gray-700 mr-5">Quantity :</p>
            <div class="flex items-center space-x-3">
              <button
                class="focus:ring-2 focus:ring-orange-300 bg-orange-500 hover:bg-orange-600 rounded-full text-xs w-8 h-8 flex items-center justify-center"
              >
                <i class="fa-solid fa-plus text-white"></i>
              </button>

              <input
                type="number"
                class="p-2 w-[100px] font-semibold text-sm text-gray-800 border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-orange-300 focus:border-orange-400 rounded-md transition-all"
              />
              <button
                class="focus:ring-2 focus:ring-orange-300 bg-orange-500 hover:bg-orange-600 mr-2 rounded-full text-xs w-8 h-8 flex items-center justify-center"
              >
                <i class="fa-solid fa-minus text-white"></i>
              </button>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="flex flex-wrap space-x-4 mb-5">
            <button
              class="text-sm px-4 shadow-md py-3 font-bold rounded-[4px] active:animate-press bg-yellow-500 text-white hover:bg-yellow-600"
            >
              <i class="fa-solid fa-basket-shopping"></i>
              Buy now
            </button>
            <button
              class="text-sm px-4 shadow-md py-3 font-bold rounded-[4px] active:animate-press bg-blue-600 text-white hover:bg-blue-700"
            >
              <i class="fa-solid fa-cart-plus"></i>
              Add to cart
            </button>
            <!-- <button
                class="text-sm px-4 shadow-md py-3 font-bold rounded-[4px] active:animate-press bg-orange-600 text-white hover:bg-orange-700"
              >
                <i class="fa-solid fa-message"></i>
                Chat Now
              </button> -->
          </div>

          <!-- Product Shop Information -->
          <!-- <ShopInformationCard :product="product" :conversation="conversation" /> -->
        </main>

        <aside class="bg-gray-50">
          <div class="px-6 py-3.5 space-y-3">
            <div class="flex items-center justify-between">
              <h3 class="font-bold text-sm text-gray-800">Available Delivery</h3>

              <a href="#" class="font-semibold text-xs text-orange-600">Change</a>
            </div>
            <div class="font-medium text-gray-700 text-sm flex items-start space-x-2">
              <i class="fa-solid fa-location-dot"></i>
              <span> Tanintharyi, Myeik, Myeik </span>
            </div>
          </div>

          <hr />

          <div class="px-6 py-3.5 space-y-3">
            <div class="font-medium text-gray-700 text-sm flex items-start space-x-2">
              <i class="fa-solid fa-box"></i>

              <p>
                Standard Delivery
                <br />
                <span class="text-gray-500 text-xs"> 23 Dec - 27 Dec </span>
              </p>

              <span class="text-orange-600 text-sm font-medium"> Ks 12,00</span>
            </div>
            <div class="font-medium text-gray-700 text-sm flex items-start space-x-2">
              <i class="fa-solid fa-money-bill"></i>
              <span> Cash on Delivery Available </span>
            </div>
          </div>

          <hr />

          <div class="px-6 py-3.5 space-y-3">
            <h3 class="font-bold text-sm text-gray-800">Services</h3>
            <div class="font-medium text-gray-700 text-sm flex items-start space-x-2">
              <i class="fa-solid fa-truck"></i>
              <p>
                14 days free & easy return
                <br />
                <span class="text-gray-500 text-xs"> Change of mind is not applicable </span>
              </p>
            </div>
            <div class="font-medium text-gray-700 text-sm flex items-start space-x-2">
              <i class="fa-solid fa-shield"></i>
              <span> Warranty Available </span>
            </div>
          </div>

          <hr />

          <div class="px-6 py-3.5 space-y-3">
            <div class="flex items-center justify-between">
              <h3 class="font-bold text-sm text-gray-800">Sold By</h3>

              <button class="font-bold text-xs text-orange-600">
                <i class="fa-solid fa-message"></i>
                Chat Now
              </button>
            </div>
            <div class="font-semibold text-gray-700 text-md flex items-start space-x-2">
              K Mobile Shop
            </div>
          </div>
        </aside>
      </div>
    </div>
  </div>
</template>
