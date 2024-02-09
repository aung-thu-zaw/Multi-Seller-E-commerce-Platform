<script setup>
import { useFormatFunctions } from '@/Composables/useFormatFunctions'
import { Link, router } from '@inertiajs/vue3'
import { computed, ref, watch, watchEffect } from 'vue'

const props = defineProps({
  coupon: Object,
  address: Object,
  cartItems: Object,
  shippingMethods: Object,
  shippingRate: Object
})

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

  totalPrice += parseFloat(props.shippingRate?.rate ?? 0)

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

const selectedShippingMethod = ref(props.cartItems[0].shipping_method_id)

watch(selectedShippingMethod, (newShippingMethod) => {
  router.post(
    route('checkout.shipping-method', {
      shipping_method_id: newShippingMethod
    })
  )
})

const filteredShippingMethod = computed(() => {
  const shipping = props.shippingMethods.find(
    (shippingMethod) => shippingMethod.id == props.cartItems[0].shipping_method_id
  )

  return shipping.name
})

const emit = defineEmits('updateTotalAmount')

const emitTotalAmount = () => {
  emit('updateTotalAmount', calculateTotalAmount())
}

watchEffect(() => {
  emitTotalAmount()
})
</script>

<template>
  <div class="border border-gray-200 bg-white shadow-sm rounded-md">
    <div class="p-5">
      <div class="flex items-center justify-between mb-5">
        <h2 class="font-bold text-xl text-gray-800">
          {{ __('Shipping & Billing') }}
        </h2>
      </div>
      <ul class="space-y-3 text-sm font-medium">
        <li class="space-x-2">
          <span class="text-orange-600">
            <i class="fa-solid fa-user"></i>
          </span>
          <span class="text-gray-700">{{ address?.name }}</span>
        </li>
        <li class="space-x-2">
          <span class="text-orange-600">
            <i class="fa-solid fa-phone"></i>
          </span>
          <span class="text-gray-700">{{ address?.phone }}</span>
        </li>
        <li class="space-x-2">
          <span class="text-orange-600">
            <i class="fa-solid fa-envelope"></i>
          </span>
          <span class="text-gray-700">{{ address?.email }}</span>
        </li>
        <li class="space-x-2">
          <span class="text-orange-600">
            <i class="fa-solid fa-location-dot"></i>
          </span>
          <span class="text-gray-700">
            {{ address?.address }}
          </span>
        </li>
      </ul>
    </div>

    <hr />

    <div class="p-5">
      <h2 class="mb-5 font-bold text-xl text-gray-800">
        {{ __('Shipping Method') }}
      </h2>

      <div v-show="$page.url.startsWith('/payments')" class="text-sm font-semibold text-gray-700">
        {{ filteredShippingMethod }}
      </div>

      <ul v-show="!$page.url.startsWith('/payments')" class="space-y-3">
        <li
          v-for="shippingMethod in shippingMethods"
          :key="shippingMethod.id"
          class="flex justify-between text-gray-700"
        >
          <div class="flex items-center mr-4 mb-3">
            <input
              :id="'shipping-' + shippingMethod.id"
              type="radio"
              name="colored-radio"
              class="w-4 h-4 text-orange-600 bg-gray-100 border-gray-300 focus:ring-orange-500"
              :value="shippingMethod.id"
              v-model="selectedShippingMethod"
            />
            <label
              :for="'shipping-' + shippingMethod.id"
              class="ml-2 text-sm font-semibold text-gray-700"
            >
              {{ shippingMethod?.name }}
            </label>
          </div>
        </li>
      </ul>
    </div>

    <hr />

    <div class="p-5">
      <h2 class="mb-5 font-bold text-xl text-gray-800">
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

        <li class="flex justify-between text-gray-700">
          <span> {{ __('Shipping Fee') }}:</span>
          <span>$ {{ formatAmount(shippingRate?.rate) ?? 0 }}</span>
        </li>

        <li v-show="coupon" class="flex justify-between text-gray-700">
          <span> {{ __('Coupon Code') }}:</span>
          <span class="text-yellow-600 text-sm font-bold">
            {{ coupon?.code }}
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
    </div>

    <div class="space-y-3 p-5">
      <Link
        v-show="!$page.url.startsWith('/payments')"
        as="button"
        :href="route('payments')"
        :data="{
          shipping_method_id: $page.props.ziggy.query?.shipping_method_id,
          tab: 'paypal'
        }"
        class="px-4 py-3 inline-block text-sm w-full text-center font-semibold text-white bg-orange-600 shadow-sm border border-gray-200 rounded-md hover:bg-orange-700 duration-200"
      >
        <i class="fa-solid fa-box"></i>
        {{ __('Place Order') }}
      </Link>
    </div>
  </div>
</template>
