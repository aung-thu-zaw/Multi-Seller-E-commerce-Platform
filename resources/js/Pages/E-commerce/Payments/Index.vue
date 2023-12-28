<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import ShippingAndBillingCard from '@/Components/Cards/Checkout/ShippingAndBillingCard.vue'
import { Head, usePage, Link } from '@inertiajs/vue3'
import { computed } from 'vue'

const cartItems = computed(() => usePage().props.auth.cart?.cart_items)
</script>

<template>
  <Head :title="__('Payments : E-commerce Online Shopping')" />

  <AppLayout>
    <section id="checkout" class="py-5">
      <div class="w-[1280px] mx-auto">
        <div class="flex items-start gap-5">
          <div class="w-8/12 space-y-5">
            <div class="py-5 border border-gray-200 bg-white rounded-md p-5">
              <h2 class="mb-5 font-bold text-xl text-gray-800">
                {{ __('Select Payment Method') }}
              </h2>

              <div class="flex items-center space-x-3">
                <Link
                  as="button"
                  :href="route('payments.paypal.pay')"
                  class="px-5 py-3.5 text-white rounded-md bg-[#ecc238] hover:bg-[#eeca51] duration-200 font-semibold text-sm"
                >
                  <i class="fa-brands fa-paypal"></i>
                  Paypal
                </Link>

                <Link
                  as="button"
                  href="#"
                  class="px-5 py-3.5 text-white rounded-md bg-slate-600 hover:bg-slate-700 duration-200 font-semibold text-sm"
                >
                  <i class="fa-solid fa-credit-card"></i>
                  Credit / Debit Card
                </Link>

                <Link
                  as="button"
                  href="#"
                  class="px-5 py-3.5 text-white rounded-md bg-emerald-600 hover:bg-emerald-700 duration-200 font-semibold text-sm"
                >
                  <i class="fa-solid fa-boxes-packing"></i>
                  Cash on Delivery
                </Link>
              </div>
            </div>
          </div>
          <div class="w-4/12">
            <ShippingAndBillingCard :cartItems="cartItems" />
          </div>
        </div>
      </div>
    </section>
  </AppLayout>
</template>
