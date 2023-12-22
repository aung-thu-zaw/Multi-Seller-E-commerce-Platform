<script setup>
import InputError from '@/Components/Forms/Fields/InputError.vue'
import { useForm } from '@inertiajs/vue3'
import { useReCaptcha } from 'vue-recaptcha-v3'

const form = useForm({
  email: '',
  captcha_token: null
})

const { executeRecaptcha, recaptchaLoaded } = useReCaptcha()
const handleSubscribe = async () => {
  await recaptchaLoaded()
  form.captcha_token = await executeRecaptcha('create_subscriber')

  form.post(route('newsletters.subscribe'), {
    preserveScroll: true,
    onFinish: () => (form.email = '')
  })
}
</script>

<template>
  <section id="newsletter" class="bg-gray-200 px-5 py-2">
    <div class="container max-w-screen-xl mx-auto rounded-md p-2 flex items-center justify-between">
      <!-- Newsletter -->
      <div class="flex items-center">
        <div class="flex items-center mr-10">
          <div
            class="flex mr-5 items-center justify-center rounded w-11 h-11 bg-white shadow-md border"
          >
            <i class="fa fa-envelope fa-lg text-orange-600"></i>
          </div>
          <div>
            <p class="font-semibold text-lg">{{ __('Subscribe') }}</p>
            <p class="text-xs font-medium text-gray-600">
              {{ __('Get notified on offers') }}
            </p>
          </div>
        </div>
        <div>
          <form @submit.prevent="handleSubscribe">
            <div
              class="flex items-center flex-row gap-3 bg-white border border-gray-300 rounded-lg p-2 w-[350px] shadow-sm"
            >
              <div class="w-full">
                <input
                  type="email"
                  id="subscribe-email"
                  name="subscribe-email"
                  class="py-3 px-4 block w-full border-none rounded-lg text-sm disabled:opacity-50 disabled:pointer-events-none focus:ring-0 focus:outline-none font-semibold text-gray-700"
                  placeholder="Enter your email"
                  v-model="form.email"
                />
              </div>
              <button
                type="submit"
                class="w-full sm:w-auto whitespace-nowrap p-3 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-orange-600 text-white hover:bg-orange-700 disabled:opacity-50 disabled:pointer-events-none"
              >
                Subscribe
              </button>
            </div>
          </form>
          <div class="w-full text-center">
            <InputError :message="form.errors?.email" />

            <p
              v-if="$page.props.flash.success"
              class="text-green-700 text-center text-sm font-bold my-1"
            >
              {{ __($page.props.flash.success) }}
            </p>
          </div>
        </div>
      </div>

      <!-- Payments -->
      <div class="">
        <img
          src="../../assets/images/payments.png"
          alt=""
          class="h-8 object-contain object-center"
        />
      </div>
    </div>
  </section>
</template>
