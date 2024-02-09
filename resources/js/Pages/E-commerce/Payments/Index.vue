<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import Paypal from './Partials/Paypal.vue'
import Stripe from './Partials/Stripe.vue'
import CashOnDelivery from './Partials/CashOnDelivery.vue'
import ShippingAndBillingCard from '@/Components/Cards/Checkout/ShippingAndBillingCard.vue'
import { Head, usePage, Link } from '@inertiajs/vue3'
import { computed, ref } from 'vue'

defineProps({
  coupon: Object,
  address: Object,
  shippingMethods: Object,
  shippingRate: Object,
  stripeKey: String
})

const cartItems = computed(() => usePage().props.auth.cart?.cart_items)

const totalAmount = ref(0)

const emitTotalAmount = (newTotalAmount) => {
  totalAmount.value = newTotalAmount
}
</script>

<template>
  <Head :title="__('Payments : E-commerce Online Shopping')" />

  <AppLayout>
    <section id="checkout" class="py-5">
      <div class="w-[1280px] mx-auto">
        <div class="flex items-start gap-5">
          <div class="w-8/12 space-y-5">
            <div class="py-3">
              <h2 class="font-bold text-xl text-gray-800">
                {{ __('Select Payment Method') }}
              </h2>
            </div>
            <div class="py-5 border border-gray-200 bg-white rounded-md p-5">
              <nav class="flex space-x-2" aria-label="Tabs" role="tablist">
                <Link
                  as="button"
                  :href="route('payments')"
                  :data="{
                    tab: 'paypal'
                  }"
                  class="py-3 px-4 text-center flex-auto inline-flex justify-center items-center gap-x-2 bg-transparent text-sm text-gray-700 font-semibold hover:text-orange-600 rounded-lg active"
                  :class="{ 'text-orange-600': $page.props.ziggy.query?.tab === 'paypal' }"
                >
                  Paypal
                </Link>
                <Link
                  as="button"
                  :href="route('payments')"
                  :data="{
                    tab: 'credit-or-debit-card'
                  }"
                  class="py-3 px-4 text-center flex-auto inline-flex justify-center items-center gap-x-2 bg-transparent text-sm text-gray-700 font-semibold hover:text-orange-600 rounded-lg"
                  :class="{
                    'text-orange-600': $page.props.ziggy.query?.tab === 'credit-or-debit-card'
                  }"
                >
                  Credit / Debit Card
                </Link>
                <Link
                  as="button"
                  :href="route('payments')"
                  :data="{
                    tab: 'cash-on-delivery'
                  }"
                  class="py-3 px-4 text-center flex-auto inline-flex justify-center items-center gap-x-2 bg-transparent text-sm text-gray-700 font-semibold hover:text-orange-600 rounded-lg"
                  :class="{
                    'text-orange-600': $page.props.ziggy.query?.tab === 'cash-on-delivery'
                  }"
                >
                  Cash on Delivery
                </Link>
              </nav>

              <div class="mt-3">
                <div v-if="$page.props.ziggy.query?.tab === 'paypal'">
                  <Paypal />
                </div>
                <div v-if="$page.props.ziggy.query?.tab === 'credit-or-debit-card'">
                  <Stripe
                    :stripeKey="stripeKey"
                    :totalAmount="totalAmount"
                    :shippingRate="shippingRate"
                  />
                </div>
                <div v-if="$page.props.ziggy.query?.tab === 'cash-on-delivery'">
                  <CashOnDelivery :shippingRate="shippingRate" :totalAmount="totalAmount" />
                </div>
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
              @updateTotalAmount="emitTotalAmount"
            />
          </div>
        </div>
      </div>
    </section>
  </AppLayout>
</template>
