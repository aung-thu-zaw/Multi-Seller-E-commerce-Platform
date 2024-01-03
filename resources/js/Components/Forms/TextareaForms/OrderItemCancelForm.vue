<script setup>
import TextAreaField from '@/Components/Forms/Fields/TextAreaField.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import { useForm } from '@inertiajs/vue3'
import { useReCaptcha } from 'vue-recaptcha-v3'

const emit = defineEmits('updateCancelBox')

const form = useForm({
  reason: null,
  captcha_token: null
})

const { executeRecaptcha, recaptchaLoaded } = useReCaptcha()

const submitCancelItem = async () => {
  await recaptchaLoaded()
  form.captcha_token = await executeRecaptcha('request_order_item_cancel')
  form.post(route('comment.replies.store'), {
    replace: true,
    preserveState: true,
    preserveScroll: true,
    onSuccess: () => (form.reason = ''),
    onFinish: () => emit('updateCancelBox', false)
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
