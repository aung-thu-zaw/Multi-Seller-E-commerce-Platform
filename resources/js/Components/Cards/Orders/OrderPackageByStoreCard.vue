<script setup>
import OrderItemCardForPackage from './OrderItemCardForPackage.vue'
import OrderStatusStepper from '@/Components/Steppers/OrderStatusStepper.vue'

defineProps({ orderItemGroup: Object, index: Number })
</script>

<template>
  <div class="bg-white border rounded-md space-y-5">
    <div class="flex items-center justify-between px-5 py-3.5 border-b">
      <div>
        <p class="font-bold text-sm text-gray-700 mb-2">
          <i class="fa-solid fa-box"></i>
          Package {{ index + 1 }}
        </p>
        <div class="flex items-center space-x-2">
          <p class="font-semibold text-xs text-gray-600">
            Sold by
            <span class="text-orange-600">
              {{ orderItemGroup[0]?.store?.store_name }}
            </span>
          </p>
        </div>
      </div>
      <div>
        <button class="font-bold text-sm text-orange-600">
          <i class="fa-solid fa-message"></i>
          Chat with Store
        </button>
      </div>
    </div>

    <div class="flex items-center justify-between text-xs font-semibold px-5">
      <p>Delivered on 21 Oct 2023</p>
      <p>Standard Delivery</p>
    </div>

    <div>
      <OrderStatusStepper :orderItems="orderItemGroup" />
    </div>

    <div class="space-y-5 w-full px-5 pb-5">
      <OrderItemCardForPackage
        v-for="orderItem in orderItemGroup"
        :key="orderItem.id"
        :orderItem="orderItem"
      />
    </div>
  </div>
</template>
