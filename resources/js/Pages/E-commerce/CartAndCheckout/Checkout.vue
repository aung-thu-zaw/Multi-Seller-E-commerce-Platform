<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import PackageByStoreCard from '@/Components/Cards/Checkout/PackageByStoreCard.vue'
import ShippingAndBillingCard from '@/Components/Cards/Checkout/ShippingAndBillingCard.vue'
import { Head, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

defineProps({ coupon: Object, address: Object, shippingMethods: Object, shippingRate: Object })

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
  <Head :title="__('Checkout : E-commerce Online Shopping')" />

  <AppLayout>
    <section id="checkout" class="py-5">
      <div class="w-[1280px] mx-auto">
        <div class="flex items-start gap-5">
          <div class="w-8/12 space-y-5">
            <div class="py-5 border border-gray-200 bg-white rounded-md">
              <div v-if="cartItems && groupByStore">
                <div
                  v-for="(cartItemGroup, index) in groupByStore"
                  :key="index"
                  :class="{ 'border-b border-gray-200': index < groupByStore?.length - 1 }"
                  class="py-5"
                >
                  <PackageByStoreCard :cartItemGroup="cartItemGroup" :index="index" />
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
          <div class="w-4/12">
            <ShippingAndBillingCard
              :cartItems="cartItems"
              :coupon="coupon"
              :address="address"
              :shippingRate="shippingRate"
              :shippingMethods="shippingMethods"
            />
          </div>
        </div>
      </div>
    </section>
  </AppLayout>
</template>
