<script setup>
import InputField from '@/Components/Forms/Fields/InputField.vue'
import { router, usePage } from '@inertiajs/vue3'
import { ref } from 'vue'
import { __ } from '@/Services/translations-inside-setup'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'

const props = defineProps({ coupon: Object, totalAmount: Number })

const couponCode = ref(props.coupon ? props.coupon?.code : '')

const applyCoupon = () => {
  router.post(
    route('coupon.apply', {
      code: couponCode.value,
      total_amount: props.totalAmount
    }),
    {},
    {
      preserveScroll: true,
      onSuccess: () => {
        const successMessage = usePage().props.flash.success
        const errorMessage = usePage().props.flash.error
        if (successMessage) {
          toast.success(__(successMessage), {
            autoClose: 2000
          })
        }
        if (errorMessage) {
          toast.error(__(errorMessage), {
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
    <span v-show="coupon" class="font-bold text-orange-600 text-sm my-4">
      {{ __('Coupon code is applied') }}
    </span>

    <form @submit.prevent="applyCoupon" class="space-y-3">
      <div>
        <InputField
          type="text"
          name="coupon-code"
          :placeholder="__('Enter :label', { label: __(' coupon code or voucher code') })"
          v-model="couponCode"
          :disabled="coupon ? true : false"
        />
      </div>

      <button
        type="submit"
        class="px-4 py-3 inline-block text-sm w-full text-center font-semibold text-white bg-orange-600 shadow-sm border border-gray-200 rounded-md hover:bg-orange-700 duration-200"
        :disabled="coupon ? true : false"
      >
        {{ __('Apply') }}
      </button>
    </form>
  </div>
</template>
