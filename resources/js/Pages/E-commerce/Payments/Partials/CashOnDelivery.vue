<script setup>
import { router, usePage } from '@inertiajs/vue3'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'
import { __ } from '@/Services/translations-inside-setup'
import { inject } from 'vue'

const props = defineProps({ totalAmount: Number, shippingRate: Number })

const swal = inject('$swal')

const handleConfirmOrder = async () => {
  const result = await swal({
    icon: 'question',
    title: __('Confirm Cash on Delivery'),
    text: __('Are you sure you would like to confirm this order ?'),
    showCancelButton: true,
    confirmButtonText: __('Confirm'),
    cancelButtonText: __('Cancel'),
    confirmButtonColor: '#2562c4',
    cancelButtonColor: '#626262',
    timer: 20000,
    timerProgressBar: true,
    reverseButtons: true
  })

  if (result.isConfirmed) {
    router.post(
      route('payments.cash.pay'),
      {
        total_amount: props.totalAmount,
        shipping_fee: props.shippingRate['rate']
      },
      {
        preserveScroll: true,
        onSuccess: () => {
          const successMessage = usePage().props.flash.success
          toast.success(__(successMessage), {
            autoClose: 2000
          })
        }
      }
    )
  }
}
</script>

<template>
  <div class="flex flex-col items-center justify-center p-16">
    <h2 class="text-md font-bold text-slate-600">
      You can pay in cash to our courier when you receive the goods at your doorstep.
    </h2>
    <button
      type="button"
      @click="handleConfirmOrder"
      class="px-5 py-3 text-sm font-bold rounded-md border border-orange-600 text-orange-600 mt-10 mb-5 hover:bg-orange-600 hover:text-white transition-all"
    >
      <i class="fa-solid fa-handshake"></i>
      Confirm Order
    </button>
  </div>
</template>
