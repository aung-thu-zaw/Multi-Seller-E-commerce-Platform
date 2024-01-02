<script setup>
import GreenBadge from '@/Components/Badges/GreenBadge.vue'
import SlateBadge from '@/Components/Badges/SlateBadge.vue'
import BlueBadge from '@/Components/Badges/BlueBadge.vue'
import OrangeBadge from '@/Components/Badges/OrangeBadge.vue'
import RedBadge from '@/Components/Badges/RedBadge.vue'
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

      <div>
        <BlueBadge v-show="orderItem?.status === 'pending'">
          <i class="fa-solid fa-spinner animate-spin"></i>
          {{ orderItem?.status }}
        </BlueBadge>

        <OrangeBadge v-show="orderItem?.status === 'processing'">
          <i class="fa-solid fa-rotate animate-spin"></i>
          {{ orderItem?.status }}
        </OrangeBadge>

        <SlateBadge v-show="orderItem?.status === 'ready to ship'">
          <i class="fa-solid fa-people-carry-box animate-pulse"></i>
          {{ orderItem?.status }}
        </SlateBadge>

        <RedBadge v-show="orderItem?.status === 'shipped'">
          <i class="fa-solid fa-truck-fast animate-pulse"></i>
          {{ orderItem?.status }}
        </RedBadge>

        <GreenBadge v-show="orderItem?.status === 'delivered'">
          <i class="fa-solid fa-truck-ramp-box animate-pulse"></i>
          {{ orderItem?.status }}
        </GreenBadge>
      </div>

      <p class="text-sm font-semibold text-gray-700">Delivered on 21 Oct 2023</p>
    </div>
  </div>
</template>
