<script setup>
import Checkbox from '@/Components/Forms/Fields/Checkbox.vue'
import OneStarRating from '@/Components/Ratings/OneStarRating.vue'
import TwoStarRating from '@/Components/Ratings/TwoStarRating.vue'
import ThreeStarRating from '@/Components/Ratings/ThreeStarRating.vue'
import FourStarRating from '@/Components/Ratings/FourStarRating.vue'
import FiveStarRating from '@/Components/Ratings/FiveStarRating.vue'
</script>

<template>
  <div class="w-[250px] py-5 space-y-8">
    <div>
      <h1 class="font-bold text-lg text-gray-800 pb-3.5 mb-3 border-b">Category</h1>
      <!-- Category -->
      <ul class="font-medium text-sm text-gray-700 space-y-2">
        <li class="hover:text-orange-600">Facial Cleansers</li>
        <li class="hover:text-orange-600">Acne Care</li>
        <li class="hover:text-orange-600">Moisturizers</li>
        <li class="hover:text-orange-600">Sunscreen and Aftersun</li>
        <li class="hover:text-orange-600">Eye Drops</li>
        <li class="hover:text-orange-600">Lip Balm and Treatment</li>
        <li class="hover:text-orange-600">Serum & Essence</li>
        <li class="hover:text-orange-600">Sunscreen & After Sun</li>
        <li class="hover:text-orange-600">Ointments and Creams</li>
        <li class="hover:text-orange-600">Shampoo</li>
        <li class="hover:text-orange-600">Facial Cleanser</li>
      </ul>
    </div>

    <div>
      <h1 class="font-bold text-lg text-gray-800 pb-3.5 mb-3 border-b">Brand</h1>
      <!-- Category -->
      <ul class="font-medium text-sm text-gray-700 space-y-2">
        <li class="hover:text-orange-600 space-x-1">
          <Checkbox />
          <span> Acnes </span>
        </li>
        <li class="hover:text-orange-600 space-x-1">
          <Checkbox />
          <span> Hada Labo </span>
        </li>
        <li class="hover:text-orange-600 space-x-1">
          <Checkbox />
          <span> Sunplay </span>
        </li>
        <li class="hover:text-orange-600 space-x-1">
          <Checkbox />
          <span> Remos </span>
        </li>
        <li class="hover:text-orange-600 space-x-1">
          <Checkbox />
          <span> Selsun </span>
        </li>
        <li class="hover:text-orange-600 space-x-1">
          <Checkbox />
          <span> OXY </span>
        </li>
      </ul>
    </div>

    <div>
      <h1 class="font-bold text-lg text-gray-800 pb-3.5 mb-3 border-b">Warranty Type</h1>
      <!-- Category -->
      <ul class="font-medium text-sm text-gray-700 space-y-2">
        <li class="hover:text-orange-600 space-x-1">
          <Checkbox />
          <span> No Warranty </span>
        </li>

        <li class="hover:text-orange-600 space-x-1">
          <Checkbox />
          <span> 14 Days Warranty </span>
        </li>
      </ul>
    </div>

    <div>
      <h1 class="font-bold text-lg text-gray-800 pb-3.5 mb-3 border-b">Services</h1>
      <!-- Category -->
      <ul class="font-medium text-sm text-gray-700 space-y-2">
        <li class="hover:text-orange-600 space-x-1">
          <Checkbox />
          <span> Cash On Delivery </span>
        </li>

        <li class="hover:text-orange-600 space-x-1">
          <Checkbox />
          <span> Free Delivery </span>
        </li>
      </ul>
    </div>

    <div>
      <h1 class="font-bold text-lg text-gray-800 pb-3.5 mb-3 border-b">Rating</h1>
      <!-- Category -->
      <ul class="font-medium text-sm text-gray-700 space-y-2">
        <li class="flex items-center space-x-2">
          <div>
            <input
              type="radio"
              name="hs-default-radio"
              class="shrink-0 mt-0.5 border-gray-200 rounded-full text-orange-600 focus:ring-orange-500"
              id="hs-default-radio"
            />
          </div>
          <FiveStarRating />
        </li>
        <li class="flex items-center space-x-2">
          <div>
            <input
              type="radio"
              name="hs-default-radio"
              class="shrink-0 mt-0.5 border-gray-200 rounded-full text-orange-600 focus:ring-orange-500"
              id="hs-default-radio"
            />
          </div>
          <FourStarRating />
        </li>
        <li class="flex items-center space-x-2">
          <div>
            <input
              type="radio"
              name="hs-default-radio"
              class="shrink-0 mt-0.5 border-gray-200 rounded-full text-orange-600 focus:ring-orange-500"
              id="hs-default-radio"
            />
          </div>
          <ThreeStarRating />
        </li>
        <li class="flex items-center space-x-2">
          <div>
            <input
              type="radio"
              name="hs-default-radio"
              class="shrink-0 mt-0.5 border-gray-200 rounded-full text-orange-600 focus:ring-orange-500"
              id="hs-default-radio"
            />
          </div>
          <TwoStarRating />
        </li>
        <li class="flex items-center space-x-2">
          <div>
            <input
              type="radio"
              name="hs-default-radio"
              class="shrink-0 mt-0.5 border-gray-200 rounded-full text-orange-600 focus:ring-orange-500"
              id="hs-default-radio"
            />
          </div>
          <OneStarRating />
        </li>
      </ul>
    </div>

    <div>
      <h1 class="font-bold text-lg text-gray-800 pb-3.5 mb-3 border-b">Price</h1>
      <!-- Category -->
      <ul class="font-medium text-sm text-gray-700 space-y-2">
        <li class="">
          <form class="flex items-center">
            <input
              type="number"
              placeholder="Min"
              class="w-20 h-8 border-gray-300 rounded-sm text-gray-700 focus:ring-0 focus:border-gray-300"
            />
            <span class="mx-2 text-orange-500">-</span>
            <input
              type="number"
              placeholder="Max"
              class="w-20 h-8 border-gray-300 rounded-sm text-gray-700 focus:ring-0 focus:border-gray-300"
            />
            <button class="bg-orange-600 px-3 py-1 ml-4 text-white rounded-sm hover:bg-orange-700">
              <i class="fa-solid fa-play"></i>
            </button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</template>
