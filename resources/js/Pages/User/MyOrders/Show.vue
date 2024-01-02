<script setup>
import UserDashboardLayout from '@/Layouts/UserDashboardLayout.vue'
import OrderPackageByStoreCard from '@/Components/Cards/Orders/OrderPackageByStoreCard.vue'
import { Head } from '@inertiajs/vue3'
import { computed } from 'vue'
import { useFormatFunctions } from '@/Composables/useFormatFunctions'

const props = defineProps({ order: Object })

const { formatAmount } = useFormatFunctions()

const orderItems = computed(() => props.order?.order_items)

const groupByStore = computed(() => {
  const grouped = {}
  for (const orderItem of orderItems.value) {
    const storeId = orderItem.product?.store_id
    if (storeId) {
      if (!grouped[storeId]) {
        grouped[storeId] = []
      }
      grouped[storeId].push(orderItem)
    }
  }
  return Object.values(grouped)
})
</script>

<template>
  <Head :title="__('My Orders') + ':' + order.tracking_no" />
  <UserDashboardLayout>
    <h1 class="font-bold text-md text-gray-700 mb-5 pb-5 border-b">
      <i class="fa-solid fa-boxes-packing"></i>
      {{ __('My Orders') }}

      <i class="fa-solid fa-angle-right mx-2"></i>
      {{ order.tracking_no }}
    </h1>

    <div class="border border-gray-200 bg-white p-5 rounded-md flex items-center justify-between">
      <div>
        <h3 class="font-bold text-sm text-gray-800">
          Order Tracking No - <span class="text-orange-600">{{ order.tracking_no }}</span>
        </h3>
        <p class="text-xs text-gray-500 font-medium">Placed on {{ order.created_at }}</p>
      </div>

      <div>
        <p class="font-bold text-md text-orange-600">
          Total : $ {{ formatAmount(order?.total_amount) }}
        </p>
      </div>
    </div>

    <div v-if="orderItems && groupByStore" class="mt-3">
      <div v-for="(orderItemGroup, index) in groupByStore" :key="index" class="py-3">
        <OrderPackageByStoreCard :orderItemGroup="orderItemGroup" :index="index" />
      </div>
    </div>
  </UserDashboardLayout>
</template>
