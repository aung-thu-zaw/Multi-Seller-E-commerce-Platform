<script setup>
import FlashSaleCountdownTimer from '@/Components/FlashSaleCountdownTimer.vue'
import ProductGridCard from '@/Components/Cards/Products/ProductGridCard.vue'
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'

const props = defineProps({ flashSale: Object })

const isFlashSaleActive = computed(() => {
  const endDate = new Date(props.flashSale?.end_date)
  const currentDate = new Date()

  return endDate > currentDate
})
</script>

<template>
  <section v-show="flashSale?.products?.length && isFlashSaleActive" id="flash-sales" class="my-16">
    <div
      class="container max-w-screen-xl mx-auto border border-gray-200 bg-white rounded-md shadow-md"
    >
      <!-- Title -->
      <div class="text-slate-600 flex items-center justify-between border-b px-6 py-3">
        <h2 class="text-2xl font-bold">
          <i class="fa-solid fa-bolt text-orange-600 animate-pulse"></i>
          {{ __('Flash Sale') }}
        </h2>

        <FlashSaleCountdownTimer :flashSale="flashSale" />

        <Link
          as="button"
          :href="route('flash-sale.products.show')"
          class="font-bold text-sm rounded-full px-4 py-2 text-orange-600 border border-orange-600 hover:bg-orange-600 hover:text-white transition-all"
        >
          {{ __('Shop More') }}
          <i class="fa-solid fa-angles-right ml-1"></i>
        </Link>
      </div>

      <div class="grid grid-cols-5 gap-4 p-5">
        <ProductGridCard
          v-for="product in flashSale?.products"
          :key="product?.id"
          :product="product"
        />
      </div>
    </div>
  </section>
</template>
