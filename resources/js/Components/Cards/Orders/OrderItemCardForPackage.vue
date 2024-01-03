<script setup>
import { computed } from 'vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({ orderItem: Object })

const attributes = computed(() => {
  return JSON.parse(props.orderItem?.attributes)
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
    <div class="w-full flex items-center justify-between">
      <div class="flex items-center justify-center">
        <div class="min-w-[100px] overflow-hidden">
          <img
            :src="orderItem?.product?.image"
            alt="product image"
            class="w-20 h-20 object-cover rounded-md"
          />
        </div>
        <div class="space-y-1 max-w-[400px]">
          <h3 class="font-semibold text-sm text-gray-700 line-clamp-2">
            <Link :href="route('products.show', { product: orderItem?.product?.slug })">
              {{ orderItem?.product?.name }}
            </Link>
          </h3>

          <div class="space-x-1 flex items-center text-xs font-medium mb-5 capitalize">
            {{ formattedAttributes }}
          </div>
        </div>
      </div>

      <p class="text-sm font-semibold text-gray-700">Qty :{{ orderItem?.qty }}</p>

      <div v-if="orderItem.status === 'delivered'">
        <Link
          href="#"
          class="text-red-600 font-semibold text-xs hover:text-red-500 hover:underline duration-150"
        >
          <i class="fa-solid fa-money-bill-transfer mr-1"></i>
          Request Return / Refund
        </Link>
        <span class="font-bold text-gray-800 mx-3">|</span>
        <Link
          href=""
          class="text-orange-600 font-semibold text-xs hover:text-orange-500 hover:underline duration-150"
        >
          <i class="fa-solid fa-pencil mr-1"></i> Write Review
        </Link>
      </div>

      <div v-if="orderItem.status === 'pending' || orderItem.status === 'processing'">
        <Link
          href="#"
          class="text-orange-600 font-semibold text-xs hover:text-orange-500 hover:underline duration-150"
        >
          <i class="fa-solid fa-pencil mr-1"></i> Cancel Item
        </Link>
      </div>
    </div>
  </div>
</template>
