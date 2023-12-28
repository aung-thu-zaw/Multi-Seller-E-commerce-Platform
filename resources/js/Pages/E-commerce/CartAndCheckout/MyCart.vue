<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import CartItemByStoreCard from '@/Components/Cards/Cart/CartItemByStoreCard.vue'
import OrderSummaryCard from '@/Components/Cards/Cart/OrderSummaryCard.vue'
import { Head, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

const cartItems = computed(() => usePage().props.auth.cart?.cart_items)

// const totalItems = computed(() => {
//   if (usePage().props.auth.cart.cart_items) {
//     return usePage().props.auth.cart?.cart_items.reduce((acc, item) => acc + item.qty, 0)
//   }
//   return ''
// })

const groupByStore = computed(() => {
  const grouped = {}
  for (const cartItem of cartItems.value) {
    const storeId = cartItem.product?.store_id
    if (storeId) {
      if (!grouped[storeId]) {
        grouped[storeId] = []
      }
      grouped[storeId].push(cartItem)
    }
  }
  return Object.values(grouped)
})
</script>

<template>
  <Head :title="__('My Cart')" />

  <AppLayout>
    <section id="shopping-cart" class="py-5">
      <div class="w-[1280px] mx-auto">
        <div class="flex items-center justify-between mb-5">
          <h1 class="font-bold text-2xl">{{ __('Shopping Cart') }}</h1>
        </div>

        <div class="flex items-start gap-5">
          <div class="w-9/12 space-y-5">
            <!-- <div
              class="py-5 px-5 border border-gray-200 bg-white rounded-md flex items-center justify-between"
            >
              <div class="space-x-2">
                <span class="font-semibold text-sm text-gray-700">
                  Select All ({{ totalItems }} Item(s))
                </span>
              </div>

              <div>
                <button class="font-semibold text-sm text-red-600">
                  <i class="fa-solid fa-trash-can"></i>
                  Remove From My Cart
                </button>
              </div>
            </div> -->

            <div class="py-5 border border-gray-200 bg-white rounded-md">
              <div v-if="cartItems && groupByStore">
                <div
                  v-for="(cartItemGroup, index) in groupByStore"
                  :key="index"
                  :class="{ 'border-b border-gray-200': index < groupByStore?.length - 1 }"
                  class="py-5"
                >
                  <CartItemByStoreCard :cartItemGroup="cartItemGroup" />
                </div>
              </div>
              <div v-else class="py-20">
                <h2 class="font-semibold text-md text-center text-gray-600">
                  <i class="fas fa-basket-shopping"></i>
                  <br />

                  There are no item(s) yet.
                </h2>
              </div>
            </div>
          </div>
          <div class="w-3/12">
            <OrderSummaryCard :cartItems="cartItems" />
          </div>
        </div>
      </div>
    </section>
  </AppLayout>
</template>
