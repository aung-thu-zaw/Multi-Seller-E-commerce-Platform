<script setup>
import InputField from '@/Components/Forms/Fields/InputField.vue'
import NormalButton from '@/Components/Buttons/NormalButton.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import { router, usePage } from '@inertiajs/vue3'
import { ref } from 'vue'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'

const orderTrackingNo = ref(null)

const handleTrackOrder = () => {
  const encodedTrackingNo = encodeURIComponent(orderTrackingNo.value)

  router.post(
    route('orders.track', { tracking_no: encodedTrackingNo }),
    {},
    {
      onFinish: () => {
        orderTrackingNo.value = ''

        if (usePage().props.flash.error) {
          toast.error(usePage().props.flash.error, {
            autoClose: 2000
          })
        }
      }
    }
  )
}
</script>

<template>
  <div class="hs-dropdown relative inline-flex [--auto-close:inside]">
    <button
      id="hs-dropdown-hover-event"
      type="button"
      class="hs-dropdown-toggle flex items-center whitespace-nowrap text-sm font-bold leading-normal text-white"
    >
      <i class="fa-solid fa-location-crosshairs mr-1"></i>
      {{ __('Track My Order') }}
    </button>
    <div
      class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden bg-white shadow-md rounded-lg p-5 mt-2 z-30 w-[350px]"
      aria-labelledby="hs-dropdown-custom-icon-trigger"
    >
      <form @submit.prevent="handleTrackOrder">
        <div class="mb-3">
          <InputLabel :label="__('Enter your order tracking number')" required />

          <InputField
            type="text"
            name="order-no"
            placeholder="( Eg: # 3g83ab45e232 )"
            autofocus
            required
            v-model="orderTrackingNo"
          />
        </div>

        <div class="flex items-center justify-end">
          <NormalButton type="submit" class="bg-orange-600">
            <i class="fa-solid fa-location-crosshairs mr-1"></i>
            {{ __('Track') }}
          </NormalButton>
        </div>
      </form>
    </div>
  </div>
</template>
