<script setup>
import StarRating from '@/Components/Ratings/StarRating.vue'
import { useFormatFunctions } from '@/Composables/useFormatFunctions'
import { router, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'
import { __ } from '@/Services/translations-inside-setup.js'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'

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

const saveToWishlist = () => {
  router.post(
    route('wishlists.store', {
      product_id: props.product.id,
      store_id: props.product.store_id
    }),
    {},
    {
      preserveScroll: true,
      onSuccess: () => {
        const successMessage = usePage().props.flash.success
        toast.success(__(successMessage), {
          autoClose: 2000
        })
      }
    }
  )
}

const saved = computed(() => {
  return usePage().props.auth?.wishlists.some(
    (wishlists) => wishlists.product_id === props.product?.id
  )
})
</script>

<template>
  <div>
    <article
      class="shadow-sm rounded bg-white border border-gray-200 p-2 overflow-hidden hover:shadow-md hover:scale-105 transition-all flex items-start"
    >
      <div :class="{ 'space-y-2': product?.product_images.length }">
        <div class="block cursor-pointer relative">
          <img
            :src="product?.image"
            :alt="product?.name"
            class="mx-auto object-cover rounded"
            :class="{
              'h-48': product?.product_images.length,
              'h-64': !product?.product_images.length
            }"
          />
          <button
            @click="saveToWishlist"
            class="absolute top-2 right-2 bg-gray-50 rounded-full flex items-center justify-center p-2 text-xs hover:bg-gray-200 border text-gray-600"
            :class="{ 'text-orange-600': saved }"
          >
            <i class="fa-solid fa-heart"></i>
          </button>
        </div>

        <div class="flex items-center space-x-1 w-[250px] overflow-auto scrollbar">
          <img
            v-for="image in product.product_images"
            :key="image.id"
            :src="image.image"
            alt="product-images"
            class="h-[50px] object-contain rounded"
          />
        </div>
      </div>
      <div class="py-4 px-2 space-y-3 w-full">
        <span
          v-show="product?.store?.store_type === 'business'"
          class="px-3 rounded-sm py-1 font-bold uppercase text-[0.6rem] text-white bg-orange-600"
        >
          <i class="fas fa-crown"></i>
          Official
        </span>

        <h3 class="text-md text-gray-700 font-semibold line-clamp-2 cursor-pointer mt-1">
          {{ product?.name }}
        </h3>

        <div class="flex items-center justify-between w-full">
          <div class="">
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
            <StarRating :rating="avgRating" />

            <span class="text-xs font-bold text-gray-400">
              ({{ product?.product_reviews_count }})
            </span>
          </div>
        </div>

        <p class="text-xs font-medium text-gray-600 line-clamp-8">
          {{ product?.description }}
        </p>
      </div>
    </article>
  </div>
</template>
