<script setup>
import { Link } from '@inertiajs/vue3'
import CartItemCard from './CartItemCard.vue'
import Checkbox from '@/Components/Forms/Fields/Checkbox.vue'

defineProps({ cartItemGroup: Object })
</script>

<template>
  <div class="px-5">
    <div class="mb-5 flex items-center justify-between">
      <div class="flex items-center space-x-2">
        <Checkbox />
        <h3 class="font-bold text-md text-gray-800">
          Item(s) from
          <span class="text-orange-600">
            {{ cartItemGroup[0]?.product?.store.store_name }}
          </span>
        </h3>
      </div>
      <Link
        as="button"
        :href="route('stores.show', { store: cartItemGroup[0]?.product?.store.slug })"
        :data="{ tab: 'home' }"
        class="font-bold text-sm text-orange-600 hover:text-orange-700"
      >
        <i class="fa-solid fa-store"></i>
        Go To Store
        <i class="fa-solid fa-arrow-right ml-2"></i>
      </Link>
    </div>

    <div class="">
      <CartItemCard v-for="cartItem in cartItemGroup" :key="cartItem.id" :cartItem="cartItem" />
    </div>
  </div>
</template>
