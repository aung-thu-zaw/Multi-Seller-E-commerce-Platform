<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import CartItemByStoreCard from '@/Components/Cards/Cart/CartItemByStoreCard.vue'
import OrderSummaryCard from '@/Components/Cards/Cart/OrderSummaryCard.vue'
import { Head, usePage } from '@inertiajs/vue3'
import { computed, onMounted } from 'vue'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'
import { __ } from '@/Services/translations-inside-setup.js'

defineProps({ coupon: Object })

const cartItems = computed(() => usePage().props.auth.cart?.cart_items)

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
            <div class="py-5 border border-gray-200 bg-white rounded-md">
              <div v-if="cartItems?.length && groupByStore?.length">
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
            <OrderSummaryCard :cartItems="cartItems" :coupon="coupon" />
          </div>
        </div>
      </div>
    </section>
  </AppLayout>
</template>
