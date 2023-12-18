<script setup>
import AvgRating from '@/Components/Ratings/AvgRating.vue'
import { useFormatFunctions } from '@/Composables/useFormatFunctions'
import { computed } from 'vue'

const props = defineProps({ product: Object })

const { formatAmount } = useFormatFunctions()

const avgRating = computed(() => {
  const rawAvgRating = props.product?.product_reviews_avg_rating

  const avgRatingValue = parseFloat(rawAvgRating)

  if (!Number.isNaN(avgRatingValue)) {
    return avgRatingValue.toFixed(1)
  }

  return null
})

const discountPercentage = computed(() => {
  const discountPercentage =
    ((props.product?.price - props.product?.offer_price) / props.product?.price) * 100

  return Math.round(discountPercentage)
})
</script>

<template>
  <div>
    <article
      class="shadow-sm rounded bg-white border border-gray-200 p-2 overflow-hidden h-[460px] hover:shadow-md hover:scale-105 transition-all"
    >
      <div class="block h-[250px] cursor-pointer relative">
        <img
          :src="product?.image"
          :alt="product?.name"
          class="mx-auto h-full w-full object-cover rounded"
        />
        <span
          class="absolute top-2 right-2 bg-gray-50 rounded-full flex items-center justify-center p-2 text-xs text-gray-600 hover:bg-gray-200 border"
        >
          <i class="fa-solid fa-heart"></i>
        </span>
      </div>
      <div class="py-4 px-2 space-y-2.5">
        <span
          v-show="product?.store?.store_type === 'business'"
          class="px-3 rounded-sm py-1 font-bold uppercase text-[0.6rem] text-white bg-orange-600"
        >
          <i class="fas fa-crown"></i>
          Official
        </span>

        <h3 class="text-sm text-gray-700 font-semibold line-clamp-2 cursor-pointer mt-1">
          {{ product?.name }}
        </h3>

        <div class="my-2">
          <div v-if="product?.offer_price">
            <span class="text-lg font-semibold text-orange-600 block">
              $ {{ formatAmount(product?.offer_price) }}
            </span>
            <span class="text-[.8rem] text-gray-500 font-medium line-through mr-5">
              $ {{ formatAmount(product?.price) }}
            </span>
            <span
              class="text-[.6rem] px-2 py-1 bg-orange-200 rounded-full text-orange-600 font-bold"
            >
              {{ discountPercentage }} % OFF
            </span>
          </div>
          <div v-else>
            <span class="text-lg font-semibold text-orange-600 block">
              $ {{ formatAmount(product?.price) }}
            </span>
          </div>
        </div>

        <div v-show="avgRating > 0" class="flex items-center space-x-2">
          <AvgRating :avgRating="avgRating" />

          <span class="text-xs font-bold text-gray-400">
            ({{ product?.product_reviews_count }})
          </span>
        </div>
      </div>
    </article>
  </div>
</template>
