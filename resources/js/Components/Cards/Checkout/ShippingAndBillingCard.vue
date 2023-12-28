<script setup>
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'

const props = defineProps({ cartItems: Object })

const totalCartItems = computed(() => {
  if (props.cartItems?.length) {
    return props.cartItems?.reduce((acc, item) => acc + item.qty, 0)
  }
  return 0
})

const calculateTotalPrice = () => {
  let totalPrice = 0
  if (props.cartItems) {
    for (const item of props.cartItems) {
      totalPrice += parseFloat(item.total_price)
    }
  }
  if (Number.isInteger(totalPrice)) {
    return totalPrice.toFixed(0)
  } else {
    return totalPrice.toFixed(2)
  }
}
</script>

<template>
  <div class="border border-gray-200 bg-white shadow-sm rounded-md">
    <div class="p-5">
      <h2 class="mb-5 font-bold text-xl text-gray-800">
        {{ __('Shipping & Billing') }}
      </h2>
      <ul class="space-y-3 text-sm font-medium">
        <li class="space-x-2">
          <span class="text-orange-600">
            <i class="fa-solid fa-user"></i>
          </span>
          <span class="text-gray-700">Aung Thu Zaw</span>
        </li>
        <li class="space-x-2">
          <span class="text-orange-600">
            <i class="fa-solid fa-phone"></i>
          </span>
          <span class="text-gray-700">09-45949394</span>
        </li>
        <li class="space-x-2">
          <span class="text-orange-600">
            <i class="fa-solid fa-envelope"></i>
          </span>
          <span class="text-gray-700">aungthuzaw@gmail.com</span>
        </li>
        <li class="space-x-2">
          <span class="text-orange-600">
            <i class="fa-solid fa-location-dot"></i>
          </span>
          <span class="text-gray-700">
            House No-2044, Parami( 2 ) Ward , Khatta Road, Myeik, Myeik, Tanintharyi
          </span>
        </li>
      </ul>
    </div>

    <hr />

    <!-- <div class="p-5">
      <h2 class="mb-5 font-bold text-xl text-gray-800">
        {{ __('Payment Methods') }}
      </h2>
      <ul class="space-y-3 text-sm font-semibold">
        <li class="flex justify-between text-gray-700">
          <div class="flex space-x-2">
            <input
              type="radio"
              name="hs-stripe-radio"
              class="shrink-0 mt-0.5 border-gray-200 rounded-full text-orange-600 focus:ring-orange-500"
              id="hs-stripe-radio"
            />
            <label for="hs-stripe-radio" class="">
              {{ __('Credit/Debit Card') }}
            </label>
          </div>
        </li>

        <li class="flex justify-between text-gray-700">
          <div class="flex space-x-2">
            <input
              type="radio"
              name="hs-paypal-radio"
              class="shrink-0 mt-0.5 border-gray-200 rounded-full text-orange-600 focus:ring-orange-500"
              id="hs-paypal-radio"
            />
            <label for="hs-paypal-radio" class="">
              {{ __('Paypal') }}
            </label>
          </div>
        </li>

        <li class="flex justify-between text-gray-700">
          <div class="flex space-x-2">
            <input
              type="radio"
              name="hs-cash-radio"
              class="shrink-0 mt-0.5 border-gray-200 rounded-full text-orange-600 focus:ring-orange-500"
              id="hs-cash-radio"
            />
            <label for="hs-cash-radio" class="">
              {{ __('Cash On Delivery') }}
            </label>
          </div>
        </li>
      </ul>
    </div>

    <hr /> -->

    <div class="p-5">
      <h2 class="mb-5 font-bold text-xl text-gray-800">
        {{ __('Order Summary') }}
      </h2>
      <ul class="space-y-3 text-sm font-semibold">
        <li class="flex justify-between text-gray-700">
          <span> {{ __('Total Items') }}:</span>
          <span>{{ totalCartItems }} {{ __('Items') }}</span>
        </li>

        <li class="flex justify-between text-gray-700">
          <span> {{ __('Total Price') }}:</span>
          <span>$ {{ calculateTotalPrice() }}</span>
        </li>

        <!-- <li class="flex justify-between text-gray-700">
          <span> {{ __('Delivery') }}:</span>
          <span>$ 300</span>
        </li> -->

        <!-- <li class="flex justify-between text-gray-700">
          <span> {{ __('Coupon Code') }}:</span>
          <span class="text-yellow-600 text-sm font-bold">
            E-commerce1245
            <i class="fas fa-xmark text-gray-700 cursor-pointer hover:text-red-600"></i>
          </span>
        </li>

        <li class="flex justify-between text-gray-700">
          <span> {{ __('Coupon Discount') }}:</span>
          <span class="text-gray-700 text-sm font-bold"> - $ 100 </span>
        </li> -->

        <li class="text-lg font-bold border-t flex justify-between mt-3 pt-3">
          <span> {{ __('Total Price') }}:</span>
          <span> $ 800</span>
        </li>
      </ul>
    </div>

    <div class="space-y-3 p-5">
      <Link
        as="button"
        href="#"
        class="px-4 py-3 inline-block text-sm w-full text-center font-semibold text-white bg-orange-600 shadow-sm border border-gray-200 rounded-md hover:bg-orange-700 duration-200"
      >
        <i class="fa-solid fa-box"></i>
        {{ __('Place Order') }}
      </Link>
    </div>
  </div>
</template>
