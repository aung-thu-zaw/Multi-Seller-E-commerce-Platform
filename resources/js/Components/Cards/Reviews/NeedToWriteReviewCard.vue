<script setup>
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'

const props = defineProps({ product: Object })

const attributes = computed(() => {
  return JSON.parse(props.product?.order_items[0]?.attributes)
})
const formattedAttributes = computed(() => {
  if (!attributes.value) return ''

  return Object.entries(attributes.value)
    .map(([key, value]) => `${key}: ${value}`)
    .join(' | ')
})
</script>

<template>
  <div
    class="border border-gray-200 rounded-md flex items-start justify-between space-x-5 p-5 w-full"
  >
    <div class="w-full flex items-start">
      <div class="min-w-[100px] overflow-hidden">
        <img :src="product?.image" alt="product image" class="w-20 h-20 object-cover" />
      </div>
      <div class="space-y-1 w-full">
        <p class="text-[.7rem] text-orange-500 font-medium">
          Order {{ product?.order_items[0]?.order?.tracking_no }}
        </p>
        <h3 class="font-semibold text-sm text-gray-700 line-clamp-2">
          {{ product?.name }}
        </h3>

        <div class="space-x-1 flex items-center text-xs font-medium mb-5 text-gray-600">
          {{ formattedAttributes }}
        </div>

        <p class="text-[.7rem] text-orange-500 font-medium">
          Purchased at - {{ product?.order_items[0]?.order?.purchased_at }}
        </p>

        <div class="flex items-center justify-end pt-5 w-full">
          <Link
            :href="route('user.my-reviews.add', { product: product?.slug })"
            as="button"
            class="text-orange-600 text-xs font-bold hover:text-orange-500"
          >
            <i class="fa-solid fa-pen"></i>
            Write Review
          </Link>
        </div>
      </div>
    </div>
  </div>
</template>
