<script setup>
import { computed } from 'vue'
import ProductToReviewCard from '@/Components/Cards/Reviews/NeedToWriteReviewCard.vue'

const props = defineProps({ productsToReview: Object })

const groupByStore = computed(() => {
  const grouped = {}
  for (const productToReview of props.productsToReview.data) {
    const storeId = productToReview?.store_id
    if (storeId) {
      if (!grouped[storeId]) {
        grouped[storeId] = []
      }
      grouped[storeId].push(productToReview)
    }
  }
  return Object.values(grouped)
})
</script>

<template>
  <div v-if="productsToReview && groupByStore" class="w-full">
    <div
      class="px-5 py-10"
      v-for="(products, index) in groupByStore"
      :key="index"
      :class="{ 'border-b': index !== groupByStore.length - 1 }"
    >
      <div class="mb-5">
        <h3 class="font-bold text-md text-gray-800">
          {{ products[0]?.store.store_name }}
        </h3>
        <!-- <p class="text-xs text-gray-500 font-medium">Purchased on {{ order.delivered_date }}</p> -->
      </div>

      <div class="grid grid-cols-2 gap-5">
        <ProductToReviewCard v-for="product in products" :key="product.id" :product="product" />
      </div>
    </div>
  </div>
</template>
