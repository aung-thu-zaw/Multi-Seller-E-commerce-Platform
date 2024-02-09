<script setup>
import ProductGridCard from '@/Components/Cards/Products/ProductGridCard.vue'

defineProps({ alsoViewedProducts: Object })
</script>

<template>
  <section>
    <div class="max-w-screen-xl mx-auto bg-transparent rounded-md pt-6">
      <!-- Title -->
      <div class="text-gray-700 flex items-center justify-between mb-5">
        <h2 class="text-xl font-bold">
          {{ __('People Who Viewed This Item Also Viewed') }}
        </h2>
      </div>

      <div class="grid grid-cols-4 gap-3 py-3">
        <ProductGridCard
          v-for="product in alsoViewedProducts"
          :key="product.id"
          :product="product"
        />
      </div>
    </div>
  </section>
</template>
