
<script setup>
import UserDashboardLayout from '@/Layouts/UserDashboardLayout.vue'
import NormalButton from '@/Components/Buttons/NormalButton.vue'
import { Head } from '@inertiajs/vue3'
</script>

<template>
  <Head :title="__('My Wishlists')" />

  <UserDashboardLayout>
    <h1 class="font-bold text-md text-gray-700 mb-5 pb-5 border-b">
      <i class="fa-solid fa-heart"></i>
      {{ __('My Wishlists') }} (10)
    </h1>

    <div class="py-10 border border-gray-200 bg-white rounded-md space-y-5">
      <div class="px-5">
        <div class="mb-5 flex items-center justify-between">
          <h3 class="font-bold text-md text-gray-800">Item(s) from K Mobile Shop</h3>
          <button
            class="font-bold text-xs text-orange-600 hover:bg-orange-100 rounded-full px-3 py-1.5 duration-300"
          >
            <i class="fa-solid fa-store"></i>
            Go To Store
            <i class="fa-solid fa-arrow-right ml-2"></i>
          </button>
        </div>

        <div class="space-y-3">
          <!-- card -->
          <div
            class="border border-gray-200 rounded-md flex items-start justify-between space-x-5 p-5"
          >
            <div class="w-[400px] flex items-start">
              <div class="min-w-[100px] overflow-hidden">
                <img
                  src="https://www.junglescout.com/wp-content/uploads/2021/01/product-photo-water-bottle-hero.png"
                  alt="product image"
                  class="w-20 h-20 object-cover"
                />
              </div>
              <div class="space-y-2">
                <h3 class="font-semibold text-sm text-gray-700">
                  Naviforce NF9049 | Men’s Dual Movement Stainless Steel Watch, Original, Black &
                  Blue Watch Strap Color:Black
                </h3>
                <p class="text-[.8rem] text-orange-600 font-bold">Only 4 item(s) left</p>
              </div>
            </div>

            <div class="space-y-1">
              <p class="font-bold text-orange-600 text-xl">$ 350</p>
              <div class="font-bold space-x-2">
                <span class="text-gray-600 text-sm line-through"> $ 350 </span>
                <span
                  class="px-2 py-1 text-xs text-orange-600 bg-orange-100 rounded-full border border-orange-400"
                >
                  -23 % OFF
                </span>
              </div>
              <p class="font-medium text-green-600 text-sm">Price dropped</p>
            </div>
            <div class="space-x-3">
              <NormalButton>
                <i class="fa-solid fa-cart-plus"></i>
                Add to cart
              </NormalButton>
              <NormalButton class="text-white bg-red-600 ring-2 ring-red-300 hover:bg-red-700">
                <i class="fa-solid fa-trash-can"></i>
                Remove
              </NormalButton>
            </div>
          </div>
          <!-- card -->
          <div
            class="border border-gray-200 rounded-md flex items-start justify-between space-x-5 p-5"
          >
            <div class="w-[400px] flex items-start">
              <div class="min-w-[100px] overflow-hidden">
                <img
                  src="https://www.junglescout.com/wp-content/uploads/2021/01/product-photo-water-bottle-hero.png"
                  alt="product image"
                  class="w-20 h-20 object-cover"
                />
              </div>
              <div class="space-y-2">
                <h3 class="font-semibold text-sm text-gray-700">
                  Naviforce NF9049 | Men’s Dual Movement Stainless Steel Watch, Original, Black &
                  Blue Watch Strap Color:Black
                </h3>
                <p class="text-[.8rem] text-orange-600 font-bold">Only 4 item(s) left</p>
              </div>
            </div>

            <div class="space-y-1">
              <p class="font-bold text-orange-600 text-xl">$ 350</p>
              <div class="font-bold space-x-2">
                <span class="text-gray-600 text-sm line-through"> $ 350 </span>
                <span
                  class="px-2 py-1 text-xs text-orange-600 bg-orange-100 rounded-full border border-orange-400"
                >
                  -23 % OFF
                </span>
              </div>
              <p class="font-medium text-green-600 text-sm">Price dropped</p>
            </div>
            <div class="space-x-3">
              <NormalButton>
                <i class="fa-solid fa-cart-plus"></i>
                Add to cart
              </NormalButton>
              <NormalButton class="text-white bg-red-600 ring-2 ring-red-300 hover:bg-red-700">
                <i class="fa-solid fa-trash-can"></i>
                Remove
              </NormalButton>
            </div>
          </div>
          <!-- card -->
          <div
            class="border border-gray-200 rounded-md flex items-start justify-between space-x-5 p-5"
          >
            <div class="w-[400px] flex items-start">
              <div class="min-w-[100px] overflow-hidden">
                <img
                  src="https://www.junglescout.com/wp-content/uploads/2021/01/product-photo-water-bottle-hero.png"
                  alt="product image"
                  class="w-20 h-20 object-cover"
                />
              </div>
              <div class="space-y-2">
                <h3 class="font-semibold text-sm text-gray-700">
                  Naviforce NF9049 | Men’s Dual Movement Stainless Steel Watch, Original, Black &
                  Blue Watch Strap Color:Black
                </h3>
                <p class="text-[.8rem] text-orange-600 font-bold">Only 4 item(s) left</p>
              </div>
            </div>

            <div class="space-y-1">
              <p class="font-bold text-orange-600 text-xl">$ 350</p>
              <div class="font-bold space-x-2">
                <span class="text-gray-600 text-sm line-through"> $ 350 </span>
                <span
                  class="px-2 py-1 text-xs text-orange-600 bg-orange-100 rounded-full border border-orange-400"
                >
                  -23 % OFF
                </span>
              </div>
              <p class="font-medium text-green-600 text-sm">Price dropped</p>
            </div>
            <div class="space-x-3">
              <NormalButton>
                <i class="fa-solid fa-cart-plus"></i>
                Add to cart
              </NormalButton>
              <NormalButton class="text-white bg-red-600 ring-2 ring-red-300 hover:bg-red-700">
                <i class="fa-solid fa-trash-can"></i>
                Remove
              </NormalButton>
            </div>
          </div>
        </div>
      </div>

      <hr />

      <div class="px-5">
        <div class="mb-5 flex items-center justify-between">
          <h3 class="font-bold text-md text-gray-800">Item(s) from K Mobile Shop</h3>
          <button
            class="font-bold text-xs text-orange-600 hover:bg-orange-100 rounded-full px-3 py-1.5 duration-300"
          >
            <i class="fa-solid fa-store"></i>
            Go To Store
            <i class="fa-solid fa-arrow-right ml-2"></i>
          </button>
        </div>

        <div class="space-y-3">
          <!-- card -->
          <div
            class="border border-gray-200 rounded-md flex items-start justify-between space-x-5 p-5"
          >
            <div class="w-[400px] flex items-start">
              <div class="min-w-[100px] overflow-hidden">
                <img
                  src="https://www.junglescout.com/wp-content/uploads/2021/01/product-photo-water-bottle-hero.png"
                  alt="product image"
                  class="w-20 h-20 object-cover"
                />
              </div>
              <div class="space-y-2">
                <h3 class="font-semibold text-sm text-gray-700">
                  Naviforce NF9049 | Men’s Dual Movement Stainless Steel Watch, Original, Black &
                  Blue Watch Strap Color:Black
                </h3>
                <p class="text-[.8rem] text-orange-600 font-bold">Only 4 item(s) left</p>
              </div>
            </div>

            <div class="space-y-1">
              <p class="font-bold text-orange-600 text-xl">$ 350</p>
              <div class="font-bold space-x-2">
                <span class="text-gray-600 text-sm line-through"> $ 350 </span>
                <span
                  class="px-2 py-1 text-xs text-orange-600 bg-orange-100 rounded-full border border-orange-400"
                >
                  -23 % OFF
                </span>
              </div>
              <p class="font-medium text-green-600 text-sm">Price dropped</p>
            </div>
            <div class="space-x-3">
              <NormalButton>
                <i class="fa-solid fa-cart-plus"></i>
                Add to cart
              </NormalButton>
              <NormalButton class="text-white bg-red-600 ring-2 ring-red-300 hover:bg-red-700">
                <i class="fa-solid fa-trash-can"></i>
                Remove
              </NormalButton>
            </div>
          </div>
        </div>
      </div>

      <hr />

      <div class="px-5">
        <div class="mb-5 flex items-center justify-between">
          <h3 class="font-bold text-md text-gray-800">Item(s) from K Mobile Shop</h3>
          <button
            class="font-bold text-xs text-orange-600 hover:bg-orange-100 rounded-full px-3 py-1.5 duration-300"
          >
            <i class="fa-solid fa-store"></i>
            Go To Store
            <i class="fa-solid fa-arrow-right ml-2"></i>
          </button>
        </div>

        <div class="space-y-3">
          <!-- card -->
          <div
            class="border border-gray-200 rounded-md flex items-start justify-between space-x-5 p-5"
          >
            <div class="w-[400px] flex items-start">
              <div class="min-w-[100px] overflow-hidden">
                <img
                  src="https://www.junglescout.com/wp-content/uploads/2021/01/product-photo-water-bottle-hero.png"
                  alt="product image"
                  class="w-20 h-20 object-cover"
                />
              </div>
              <div class="space-y-2">
                <h3 class="font-semibold text-sm text-gray-700">
                  Naviforce NF9049 | Men’s Dual Movement Stainless Steel Watch, Original, Black &
                  Blue Watch Strap Color:Black
                </h3>
                <p class="text-[.8rem] text-orange-600 font-bold">Only 4 item(s) left</p>
              </div>
            </div>

            <div class="space-y-1">
              <p class="font-bold text-orange-600 text-xl">$ 350</p>
              <div class="font-bold space-x-2">
                <span class="text-gray-600 text-sm line-through"> $ 350 </span>
                <span
                  class="px-2 py-1 text-xs text-orange-600 bg-orange-100 rounded-full border border-orange-400"
                >
                  -23 % OFF
                </span>
              </div>
              <p class="font-medium text-green-600 text-sm">Price dropped</p>
            </div>
            <div class="space-x-3">
              <NormalButton>
                <i class="fa-solid fa-cart-plus"></i>
                Add to cart
              </NormalButton>
              <NormalButton class="text-white bg-red-600 ring-2 ring-red-300 hover:bg-red-700">
                <i class="fa-solid fa-trash-can"></i>
                Remove
              </NormalButton>
            </div>
          </div>
          <!-- card -->
          <div
            class="border border-gray-200 rounded-md flex items-start justify-between space-x-5 p-5"
          >
            <div class="w-[400px] flex items-start">
              <div class="min-w-[100px] overflow-hidden">
                <img
                  src="https://www.junglescout.com/wp-content/uploads/2021/01/product-photo-water-bottle-hero.png"
                  alt="product image"
                  class="w-20 h-20 object-cover"
                />
              </div>
              <div class="space-y-2">
                <h3 class="font-semibold text-sm text-gray-700">
                  Naviforce NF9049 | Men’s Dual Movement Stainless Steel Watch, Original, Black &
                  Blue Watch Strap Color:Black
                </h3>
                <p class="text-[.8rem] text-orange-600 font-bold">Only 4 item(s) left</p>
              </div>
            </div>

            <div class="space-y-1">
              <p class="font-bold text-orange-600 text-xl">$ 350</p>
              <div class="font-bold space-x-2">
                <span class="text-gray-600 text-sm line-through"> $ 350 </span>
                <span
                  class="px-2 py-1 text-xs text-orange-600 bg-orange-100 rounded-full border border-orange-400"
                >
                  -23 % OFF
                </span>
              </div>
              <p class="font-medium text-green-600 text-sm">Price dropped</p>
            </div>
            <div class="space-x-3">
              <NormalButton>
                <i class="fa-solid fa-cart-plus"></i>
                Add to cart
              </NormalButton>
              <NormalButton class="text-white bg-red-600 ring-2 ring-red-300 hover:bg-red-700">
                <i class="fa-solid fa-trash-can"></i>
                Remove
              </NormalButton>
            </div>
          </div>
        </div>
      </div>
      <!-- <h2 class="font-semibold text-md text-center text-gray-600">
        <i class="fas fa-heart"></i>
        <br />

        There are no favorites yet
        <br />

        Add your favorites to wishlists and they will show here.
      </h2> -->
    </div>
  </UserDashboardLayout>
</template>
