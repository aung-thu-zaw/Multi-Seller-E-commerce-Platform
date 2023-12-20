<script setup>
import TextAreaField from '@/Components/Forms/Fields/TextAreaField.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import { useForm } from '@inertiajs/vue3'
import { useReCaptcha } from 'vue-recaptcha-v3'

const props = defineProps({ product: Object, productQuestion: Object })

const emit = defineEmits('updateAnswerBox')

const form = useForm({
  product_question_id: props.productQuestion?.id,
  answer: null,
  captcha_token: null
})

const { executeRecaptcha, recaptchaLoaded } = useReCaptcha()

const submitProductQuestionAnswer = async () => {
  await recaptchaLoaded()
  form.captcha_token = await executeRecaptcha('create_question_answer')
  form.post(
    route('', {
      //   blog_content: props.blogContent?.slug,
      //   blog_comment: props.blogComment?.id
    }),
    {
      replace: true,
      preserveState: true,
      preserveScroll: true,
      onSuccess: () => (form.answer = ''),
      onFinish: () => emit('updateAnswerBox', false)
    }
  )
}
</script>

<template>
  <div class="pl-12 mt-5">
    <form @submit.prevent="submitProductQuestionAnswer">
      <div class="mb-3">
        <TextAreaField
          name="answer"
          :placeholder="__('Enter answer for this product')"
          required
          v-model="form.answer"
        />

        <InputError :message="form.errors?.answer" />
      </div>

      <div class="border w-[100px] ml-auto">
        <FormButton type="submit">
          {{ __('Submit') }}
        </FormButton>
      </div>
    </form>
  </div>
</template>
