<script setup>
import TextAreaField from '@/Components/Forms/Fields/TextAreaField.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import { useForm, usePage } from '@inertiajs/vue3'
import { useReCaptcha } from 'vue-recaptcha-v3'
import { __ } from '@/Services/translations-inside-setup.js'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'

const props = defineProps({ orderItem: Object })

const emit = defineEmits('updateCancelBox')

const form = useForm({
  reason: null,
  captcha_token: null
})

const { executeRecaptcha, recaptchaLoaded } = useReCaptcha()

const submitCancelItem = async () => {
  await recaptchaLoaded()
  form.captcha_token = await executeRecaptcha('request_order_item_cancel')
  form.post(route('order-items.request-cancel', { order_item: props.orderItem?.id }), {
    replace: true,
    preserveState: true,
    preserveScroll: true,

    onSuccess: () => {
      form.reason = ''
      emit('updateCancelBox', false)
      const successMessage = usePage().props.flash.success
      if (successMessage) {
        toast.success(__(successMessage, { label: __('Order status') }), {
          autoClose: 2000
        })
      }
      const errorMessage = usePage().props.flash.error
      if (errorMessage) {
        toast.error(__(errorMessage), {
          autoClose: 2000
        })
      }
    }
  })
}
</script>

<template>
  <div class="pl-12 mt-5">
    <form @submit.prevent="submitCancelItem">
      <div class="mb-3">
        <TextAreaField
          name="reason-cancel"
          :placeholder="__('Enter :label', { label: __('Reason for item cancellation') })"
          required
          v-model="form.reason"
        />

        <InputError :message="form.errors?.reason" />
      </div>

      <div class="border w-[100px] ml-auto">
        <FormButton type="submit">
          {{ __('Submit') }}
        </FormButton>
      </div>
    </form>
  </div>
</template>
