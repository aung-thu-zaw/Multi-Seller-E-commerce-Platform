<script setup>
import GreenBadge from '@/Components/Badges/GreenBadge.vue'
import OrangeBadge from '@/Components/Badges/OrangeBadge.vue'
import RedBadge from '@/Components/Badges/RedBadge.vue'
import BlueBadge from '@/Components/Badges/BlueBadge.vue'
import SlateBadge from '@/Components/Badges/SlateBadge.vue'
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

      <div v-show="orderItem?.return_item">
        <OrangeBadge v-if="orderItem?.return_item?.status === 'pending'">
          <i class="fa-solid fa-rotate-right animate-spin"></i>
          Requested return
        </OrangeBadge>
        <GreenBadge v-if="orderItem?.return_item?.status === 'approved'">
          <i class="fa-solid fa-circle-check animate-pulse"></i>
          Approved your return
        </GreenBadge>
        <RedBadge v-if="orderItem?.return_item?.status === 'rejected'">
          <i class="fa-solid fa-circle-xmark animate-pulse"></i>
          Rejected your return
        </RedBadge>
        <BlueBadge v-if="orderItem?.return_item?.status === 'received'">
          <i class="fa-solid fa-box animate-pulse"></i>
          Received Item
        </BlueBadge>
        <SlateBadge v-if="orderItem?.return_item?.status === 'refunded'">
          <i class="fa-solid fa-money-bill-transfer animate-pulse"></i>
          Refunded
        </SlateBadge>
      </div>

      <div v-show="orderItem?.cancellation_item">
        <OrangeBadge v-if="orderItem?.cancellation_item?.status === 'pending'">
          <i class="fa-solid fa-rotate-right animate-spin"></i>
          Requested cancel
        </OrangeBadge>
        <GreenBadge v-if="orderItem?.cancellation_item?.status === 'approved'">
          <i class="fa-solid fa-circle-check animate-pulse"></i>
          Approved your cancel
        </GreenBadge>
        <RedBadge v-if="orderItem?.cancellation_item?.status === 'rejected'">
          <i class="fa-solid fa-circle-xmark animate-pulse"></i>
          Rejected your cancel
        </RedBadge>
      </div>

      <div v-if="orderItem.status === 'delivered'" class="flex items-center">
        <div>
          <button
            v-if="!isReturnBoxOpened"
            @click="isReturnBoxOpened = !isReturnBoxOpened"
            class="text-red-600 font-semibold text-xs hover:text-red-500 duration-150"
            :disabled="orderItem?.return_item"
          >
            <i class="fa-solid fa-money-bill-transfer mr-1"></i>
            Request Return / Refund
          </button>
          <button
            v-else
            @click="isReturnBoxOpened = false"
            class="font-medium text-xs text-red-600 hover:text-red-500"
            :disabled="orderItem?.return_item"
          >
            <i class="fa-solid fa-circle-xmark"></i>

            {{ __('Cancel') }}
          </button>
        </div>
        <span v-show="!orderItem?.return_item" class="font-bold text-gray-800 mx-3">|</span>
        <Link
          v-show="!orderItem?.return_item"
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
          :disabled="orderItem?.cancellation_item"
        >
          <i class="fa-solid fa-pencil mr-1"></i> Cancel Item
        </button>
        <button
          v-else
          @click="isCancelBoxOpened = false"
          class="font-medium text-xs text-red-600 hover:text-red-500"
          :disabled="orderItem?.cancellation_item"
        >
          <i class="fa-solid fa-circle-xmark"></i>

          {{ __('Cancel') }}
        </button>
      </div>
    </div>

    <!-- Cancel Form -->
    <div v-show="isCancelBoxOpened" class="w-full">
      <OrderItemCancelForm @updateCancelBox="isCancelBoxOpened = false" :orderItem="orderItem" />
    </div>

    <!-- Return Form -->
    <div v-show="isReturnBoxOpened" class="w-full">
      <OrderItemReturnForm @updateReturnBox="isReturnBoxOpened = false" :orderItem="orderItem" />
    </div>
  </div>
</template>
