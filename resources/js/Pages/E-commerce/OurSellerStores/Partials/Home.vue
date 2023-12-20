<script setup>
import SliderCarousel from '@/Components/Carousels/SliderCarousel.vue'
import ProductGridCard from '@/Components/Cards/Products/ProductGridCard.vue'
</script>

<template>
  <div class="w-full mx-auto bg-transparent rounded-md pt-6">
    <div class="mb-5">
      <SliderCarousel />
    </div>

    <!-- Title -->
    <div class="text-slate-600 flex items-center justify-between py-3">
      <h2 class="text-2xl font-bold">
        {{ __('Just For You') }}
      </h2>
    </div>

    <div class="grid grid-cols-5 gap-3 py-3">
      <!-- Product Card -->
      <!-- <ProductGridCard /> -->
    </div>
  </div>
</template>
