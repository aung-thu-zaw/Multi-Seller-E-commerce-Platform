<script setup>
import OrderItemCard from '@/Components/Cards/Orders/OrderItemCard.vue'
import { Link } from '@inertiajs/vue3'

defineProps({ order: Object })
</script>

<template>
  <div class="space-y-5">
    <div class="py-5 border border-gray-200 bg-white rounded-md space-y-5">
      <div class="px-5">
        <div class="mb-6 flex items-center justify-between">
          <div>
            <h3 class="font-bold text-md text-gray-800">
              Order Tracking No - <span class="text-orange-600">{{ order.tracking_no }}</span>
            </h3>
            <p class="text-xs text-gray-500 font-medium">Placed on {{ order.created_at }}</p>
          </div>
          <div>
            <Link
              as="button"
              :href="route('user.my-orders.show', { order: order.id })"
              class="text-sm font-bold text-orange-600 hover:text-orange-700"
            >
              Manage Order Details
              <i class="fa-solid fa-arrow-right"></i>
            </Link>
          </div>
        </div>

        <div class="grid gap-5">
          <OrderItemCard
            v-for="orderItem in order.order_items"
            :key="orderItem.id"
            :orderItem="orderItem"
          />
        </div>
      </div>
    </div>
  </div>
</template>
