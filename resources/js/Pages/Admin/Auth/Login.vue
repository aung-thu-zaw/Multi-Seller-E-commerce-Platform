<script setup>
import { useReCaptcha } from 'vue-recaptcha-v3'
import FormButton from '@/Components/Buttons/FormButton.vue'
import Checkbox from '@/Components/Forms/Fields/Checkbox.vue'
import GuestLayout from '@/Layouts/GuestLayout.vue'
import AuthFormContainer from '@/Components/Forms/AuthFormContainer.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'
import { usePage } from '@inertiajs/vue3'

defineProps({ canResetPassword: Boolean, status: String })

const form = useForm({
  email: '',
  password: '',
  remember: false,
  captcha_token: null
})

const { executeRecaptcha, recaptchaLoaded } = useReCaptcha()

const submit = async () => {
  await recaptchaLoaded()
  form.captcha_token = await executeRecaptcha('login')

  form.post(route('login'), {
    replace: true,
    preserveState: true,
    onFinish: () => form.reset('password'),
    onSuccess: () => {
      toast.success(usePage().props.flash.success, {
        autoClose: 2000
      })
    }
  })
}
</script>

<template>
  <Head :title="__(':label Dashboard Login', { label: __('Admin') })" />

  <GuestLayout>
    <AuthFormContainer>
      <div
        v-if="status"
        class="mb-4 font-medium text-sm text-green-600 bg-green-100 p-3 w-full rounded-md text-center"
      >
        {{ status }}
      </div>
      <form @submit.prevent="submit" class="w-full space-y-4 md:space-y-6">
        <h1 class="text-center text-2xl text-dark mb-5 font-bold">
          {{ __(':label Dashboard Login', { label: __('Admin') }) }}
        </h1>

        <!-- Email Input -->
        <div>
          <InputLabel :label="__('Email Address')" required />

          <InputField
            type="email"
            name="your-email"
            icon="fa-envelope"
            v-model="form.email"
            :placeholder="__('Enter :label', { label: __('Email Address') })"
            autofocus
            required
          />

          <InputError :message="form.errors?.email" />
        </div>

        <!-- Password Input -->
        <div>
          <InputLabel :label="__('Password')" required />

          <InputField
            type="password"
            name="your-password"
            icon="fa-lock"
            v-model="form.password"
            :placeholder="__('Enter :label', { label: __('Password') })"
            required
          />

          <InputError :message="form.errors?.password" />
        </div>

        <InputError class="mt-2 text-center font-bold" :message="form.errors?.captcha_token" />

        <!-- Remember me and Forgot Password -->
        <div class="flex items-center justify-between mb-5">
          <div>
            <label class="flex items-center">
              <Checkbox name="remember" v-model:checked="form.remember" />
              <span class="ml-2 text-sm text-gray-600"> {{ __('Remember Me') }}</span>
            </label>
          </div>

          <div>
            <Link
              v-if="canResetPassword"
              :href="route('password.request')"
              class="underline text-sm text-gray-600 rounded-md hover:text-orange-500"
            >
              {{ __('Forgot Password ?') }}
            </Link>
          </div>
        </div>

        <FormButton :processing="form.processing">
          {{ __('Login') }}
        </FormButton>
      </form>
    </AuthFormContainer>
  </GuestLayout>
</template>
