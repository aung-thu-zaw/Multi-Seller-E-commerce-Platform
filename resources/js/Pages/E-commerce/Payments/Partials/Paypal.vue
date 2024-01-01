<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <div class="flex items-center justify-center p-16">
    <Link
      as="button"
      :href="route('payments.paypal.pay')"
      class="px-5 py-3.5 text-white rounded-md bg-[#e6ba2a] hover:bg-[#eeca51] duration-200 font-semibold text-sm"
    >
      <i class="fa-brands fa-paypal"></i>
      Pay with Paypal
    </Link>
  </div>
</template>
