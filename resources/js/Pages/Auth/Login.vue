<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import AuthFormContainer from '@/Components/Forms/AuthFormContainer.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import Checkbox from '@/Components/Forms/Fields/Checkbox.vue'
import SocialAuth from './SocialAuth.vue'
import { usePage, Head, Link, useForm } from '@inertiajs/vue3'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'
import { useReCaptcha } from 'vue-recaptcha-v3'

defineProps({
  canResetPassword: {
    type: Boolean
  },
  status: {
    type: String
  }
})

const form = useForm({
  name: '',
  email: '',
  password: '',
  remember: false,
  captcha_token: null
})

const { executeRecaptcha, recaptchaLoaded } = useReCaptcha()

const handleLogin = async () => {
  await recaptchaLoaded()
  form.captcha_token = await executeRecaptcha('login')

  form.post(route('login'), {
    replace: true,
    preserveState: true,
    onFinish: () => form.reset(),
    onSuccess: () => {
      toast.success(usePage().props.flash.success, {
        autoClose: 2000
      })
    }
  })
}
</script>

<template>
  <Head :title="__('Login')" />

  <AppLayout>
    <AuthFormContainer>
      <form @submit.prevent="handleLogin" class="w-full space-y-6">
        <h1 class="text-center text-2xl text-dark mb-5 font-bold">
          {{ __('Welcome to our platform! Please login.') }}
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

        <p class="text-center text-sm">
          {{ __("You don't have an account?") }}
          <Link
            :href="route('register')"
            class="text-orange-600 font-bold hover:cursor-pointer hover:underline"
          >
            {{ __('Sign Up') }}
          </Link>
        </p>
      </form>

      <span class="my-4">
        {{ __('Or') }}
      </span>

      <!-- Social Signup -->
      <SocialAuth />
    </AuthFormContainer>
  </AppLayout>
</template>
