<script setup>
import TextAreaField from '@/Components/Forms/Fields/TextAreaField.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import { useForm } from '@inertiajs/vue3'
import { useReCaptcha } from 'vue-recaptcha-v3'

const props = defineProps({ product: Object })

const form = useForm({
  product_id: props.product?.id,
  question: null,
  captcha_token: null
})

const { executeRecaptcha, recaptchaLoaded } = useReCaptcha()

const submitProductQuestion = async () => {
  await recaptchaLoaded()
  form.captcha_token = await executeRecaptcha('create_product_question')
  form.post(route('product.questions.store', { product: props.product?.slug }), {
    replace: true,
    preserveState: true,
    preserveScroll: true,
    onSuccess: () => (form.question = '')
  })
}
</script>

<template>
  <div class="p-5">
    <form @submit.prevent="submitProductQuestion">
      <div class="mb-3">
        <TextAreaField
          name="question"
          :placeholder="__('Ask seller a question')"
          required
          v-model="form.question"
        />

        <InputError :message="form.errors?.question" />
      </div>

      <div class="border w-[150px] ml-auto">
        <FormButton>
          <i class="fa-solid fa-paper-plane"></i>
          {{ __('Submit') }}
        </FormButton>
      </div>
    </form>
  </div>
</template>
