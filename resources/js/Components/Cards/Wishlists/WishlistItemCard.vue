<script setup>
import NormalButton from '@/Components/Buttons/NormalButton.vue'

defineProps({ wishlist: Object })
</script>

<template>
  <div
    class="border border-gray-200 rounded-md flex items-start justify-between space-x-5 p-5 mb-4"
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
          Naviforce NF9049 | Men’s Dual Movement Stainless Steel Watch, Original, Black & Blue Watch
          Strap Color:Black
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
      <NormalButton class="text-white bg-blue-600 hover:bg-blue-700">
        <i class="fa-solid fa-cart-plus"></i>
        Add to cart
      </NormalButton>
      <NormalButton class="text-white bg-red-600 hover:bg-red-700">
        <i class="fa-solid fa-trash-can"></i>
        Remove
      </NormalButton>
    </div>
  </div>
</template>
