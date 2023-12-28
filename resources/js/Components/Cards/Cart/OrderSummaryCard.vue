<script setup>
import InputField from '@/Components/Forms/Fields/InputField.vue'
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
  <div class="border border-gray-200 bg-white shadow-sm rounded-md mb-5 p-5">
    <h2 class="text-center mb-5 font-bold text-xl text-gray-800">
      {{ __('Order Summary') }}
    </h2>
    <ul class="space-y-3 text-sm font-semibold mb-5">
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

    <div class="space-y-3">
      <Link
        as="button"
        :href="route('checkout.index')"
        class="px-4 py-3 inline-block text-sm w-full text-center font-semibold text-white bg-orange-600 shadow-sm border border-gray-200 rounded-md hover:bg-orange-700 duration-200"
      >
        <i class="fa-solid fa-right-from-bracket"></i>
        {{ __('Proceed To Checkout') }}
      </Link>

      <Link
        as="button"
        href="#"
        class="px-4 py-3 inline-block text-sm w-full text-center font-semibold text-orange-600 bg-white shadow-sm border border-gray-200 rounded-md hover:bg-gray-100 duration-200"
      >
        <i class="fa-solid fa-basket-shopping"></i>
        {{ __('Go Back To Home') }}
      </Link>
    </div>
  </div>

  <div class="border border-gray-200 bg-white shadow-sm rounded-md mb-5 p-5">
    <!-- <span class="font-bold text-orange-600 text-sm my-4">
      {{ __('Coupon code applied') }}
    </span> -->

    <form action="" class="space-y-3">
      <div>
        <InputField
          type="text"
          name="coupon-code"
          :placeholder="__('Enter :label', { label: __(' coupon code or voucher code') })"
        />
      </div>

      <Link
        as="button"
        href="#"
        class="px-4 py-3 inline-block text-sm w-full text-center font-semibold text-white bg-orange-600 shadow-sm border border-gray-200 rounded-md hover:bg-orange-700 duration-200"
      >
        {{ __('Apply') }}
      </Link>
    </form>
  </div>
</template>
