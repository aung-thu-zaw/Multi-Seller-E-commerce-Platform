<script setup>
import CouponForm from '@/Components/Forms/CouponForm.vue'
import { Link, router, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'
import { __ } from '@/Services/translations-inside-setup'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'
import { useFormatFunctions } from '@/Composables/useFormatFunctions'

const props = defineProps({ coupon: Object, cartItems: Object })

const totalCartItems = computed(() => {
  if (props.cartItems?.length) {
    return props.cartItems?.reduce((acc, item) => acc + item.qty, 0)
  }
  return 0
})

const { formatAmount } = useFormatFunctions()

const calculateTotalItemAmount = () => {
  let totalPrice = 0
  if (props.cartItems) {
    for (const item of props.cartItems) {
      totalPrice += parseFloat(item.total_price)
    }
  }
  if (Number.isInteger(totalPrice)) {
    return Number(totalPrice.toFixed(0))
  } else {
    return Number(totalPrice.toFixed(2))
  }
}

const calculateTotalAmount = () => {
  let totalPrice = 0

  if (props.cartItems) {
    for (const item of props.cartItems) {
      totalPrice += parseFloat(item.total_price)
    }
  }

  if (Number.isInteger(totalPrice)) {
    if (props.coupon && props.coupon?.type === 'fixed') {
      const totalAmount = totalPrice - props.coupon.value
      return Number(totalAmount.toFixed(0))
    } else if (props.coupon && props.coupon?.type === 'percentage') {
      const discountAmount = (totalPrice * props.coupon.value) / 100
      const totalAmount = totalPrice - discountAmount
      return Number(totalAmount.toFixed(2))
    } else {
      return Number(totalPrice.toFixed(0))
    }
  } else {
    return Number(totalPrice.toFixed(2))
  }
}

const removeCoupon = () => {
  router.post(
    route('coupon.remove', { coupon_code: props.coupon?.code }),
    {},
    {
      preserveScroll: true,
      onSuccess: () => {
        const successMessage = usePage().props.flash.success
        if (successMessage) {
          toast.success(__(successMessage), {
            autoClose: 2000
          })
        }
      }
    }
  )
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
        <span> {{ __('Total Items Price') }}:</span>
        <span>$ {{ calculateTotalItemAmount() }}</span>
      </li>

      <!-- <li class="flex justify-between text-gray-700">
        <span> {{ __('Delivery') }}:</span>
        <span>$ 300</span>
      </li> -->

      <li v-show="coupon" class="flex justify-between text-gray-700">
        <span> {{ __('Coupon Code') }}:</span>
        <span class="text-yellow-600 text-sm font-bold">
          {{ coupon?.code }}
          <button @click="removeCoupon" class="text-gray-700 cursor-pointer hover:text-red-600">
            <i class="fas fa-xmark"></i>
          </button>
        </span>
      </li>

      <li v-show="coupon" class="flex justify-between text-gray-700">
        <span> {{ __('Coupon Discount') }}:</span>
        <span v-if="coupon?.type === 'fixed'" class="text-gray-700 text-sm font-bold">
          - $ {{ formatAmount(coupon.value) }}
        </span>
        <span v-else-if="coupon?.type === 'percentage'" class="text-gray-700 text-sm font-bold">
          - % {{ coupon.value }}
        </span>
      </li>

      <li class="text-lg font-bold border-t flex justify-between mt-3 pt-3">
        <span> {{ __('Total Price') }}:</span>
        <span> ${{ calculateTotalAmount() }} </span>
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

  <CouponForm :coupon="coupon" :totalAmount="calculateTotalItemAmount()" />
</template>
