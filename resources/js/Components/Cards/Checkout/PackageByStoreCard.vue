<script setup>
import CheckoutCartItem from './CheckoutCartItem.vue'

defineProps({ cartItemGroup: Object, index: Number })
</script>

<template>
  <div class="px-5">
    <div class="mb-5 flex items-center justify-between">
      <p class="font-bold text-sm text-gray-600">
        <i class="fa-solid fa-box"></i>
        Package {{ index + 1 }} of {{ cartItemGroup.length }}
      </p>
      <div class="flex items-center space-x-2">
        <p class="font-bold text-sm text-gray-800">
          Shipped by
          <span class="text-orange-600">
            {{ cartItemGroup[0]?.product?.store.store_name }}
          </span>
        </p>
      </div>
    </div>

    <div class="flex items-start space-x-2" v-for="cartItem in cartItemGroup" :key="cartItem.id">
      <CheckoutCartItem :cartItem="cartItem" />
    </div>
  </div>
</template>
