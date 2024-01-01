<script setup>
import { router } from '@inertiajs/vue3'

const handleConfirmOrder = () => {
  //   router.post(route('payment.cash'))
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
