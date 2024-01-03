<script setup>
import OrderItemCancelForm from '@/Components/Forms/TextareaForms/OrderItemCancelForm.vue'
import OrderItemReturnForm from '@/Components/Forms/TextareaForms/OrderItemReturnForm.vue'
import { computed, ref } from 'vue'
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

const isCancelBoxOpened = ref(false)
const isReturnBoxOpened = ref(false)
</script>

<template>
  <div
    class="border border-gray-200 rounded-md flex flex-col items-center justify-center w-full p-5"
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
        <button
          v-if="!isReturnBoxOpened"
          @click="isReturnBoxOpened = !isReturnBoxOpened"
          class="text-red-600 font-semibold text-xs hover:text-red-500 duration-150"
        >
          <i class="fa-solid fa-money-bill-transfer mr-1"></i>
          Request Return / Refund
        </button>
        <button
          v-else
          @click="isReturnBoxOpened = false"
          class="font-medium text-xs text-red-600 hover:text-red-500"
        >
          <i class="fa-solid fa-circle-xmark"></i>

          {{ __('Cancel') }}
        </button>
        <span class="font-bold text-gray-800 mx-3">|</span>
        <Link
          href=""
          class="text-orange-600 font-semibold text-xs hover:text-orange-500 hover:underline duration-150"
        >
          <i class="fa-solid fa-pencil mr-1"></i> Write Review
        </Link>
      </div>

      <div v-if="orderItem.status === 'pending' || orderItem.status === 'processing'">
        <button
          v-if="!isCancelBoxOpened"
          @click="isCancelBoxOpened = !isCancelBoxOpened"
          class="text-orange-600 font-semibold text-xs hover:text-orange-500 duration-150"
        >
          <i class="fa-solid fa-pencil mr-1"></i> Cancel Item
        </button>
        <button
          v-else
          @click="isCancelBoxOpened = false"
          class="font-medium text-xs text-red-600 hover:text-red-500"
        >
          <i class="fa-solid fa-circle-xmark"></i>

          {{ __('Cancel') }}
        </button>
      </div>
    </div>

    <!-- Cancel Form -->
    <div v-show="isCancelBoxOpened" class="w-full">
      <OrderItemCancelForm @updateCancelBox="isCancelBoxOpened = false" />
    </div>

    <!-- Return Form -->
    <div v-show="isReturnBoxOpened" class="w-full">
      <OrderItemReturnForm @updateReturnBox="isReturnBoxOpened = false" />
    </div>
  </div>
</template>
