<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import AuthFormContainer from '@/Components/Forms/AuthFormContainer.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import SocialAuth from './SocialAuth.vue'
import { __ } from '@/Services/translations-inside-setup.js'
import { usePage, Head, Link, useForm } from '@inertiajs/vue3'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'
import { useReCaptcha } from 'vue-recaptcha-v3'

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
  terms: false,
  captcha_token: null
})

const { executeRecaptcha, recaptchaLoaded } = useReCaptcha()

const handleRegister = async () => {
  await recaptchaLoaded()
  form.captcha_token = await executeRecaptcha('register')

  form.post(route('register'), {
    replace: true,
    preserveState: true,
    onFinish: () => form.reset(),
    onSuccess: () => {
      const successMessage = usePage().props.flash.success
      toast.success(__(successMessage), {
        autoClose: 2000
      })
    }
  })
}
</script>

<template>
  <Head :title="__('Sign Up')" />

  <AppLayout>
    <AuthFormContainer>
      <form @submit.prevent="handleRegister" class="w-full space-y-6">
        <h1 class="text-center text-2xl text-dark mb-5 font-bold">
          {{ __('Create A New E-commerce Account') }}
        </h1>

        <!-- Name Input -->
        <div>
          <InputLabel :label="__('Name')" required />

          <InputField
            type="text"
            name="your-name"
            icon="fa-user"
            v-model="form.name"
            :placeholder="__('Enter :label', { label: __('Name') })"
            required
          />

          <InputError :message="form.errors?.name" />
        </div>

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

        <!-- Password Input -->
        <div>
          <InputLabel :label="__('Confirm Password')" required />

          <InputField
            type="password"
            name="confirm-password"
            icon="fa-lock"
            v-model="form.password_confirmation"
            :placeholder="__('Enter :label', { label: __('Retype Password') })"
            required
          />

          <InputError :message="form.errors?.password_confirmation" />
        </div>

        <div>
          <label class="flex items-center">
            <Checkbox name="terms" v-model:checked="form.terms" />
            <span class="ml-2 text-sm font-medium text-gray-600">
              By clicking "Sign Up”, I agree to e-commerce
              <Link href="#" class="text-orange-600 hover:underline"> Terms of use </Link> and
              <Link href="#" class="text-orange-600 hover:underline">Privacy Policy</Link>
            </span>
          </label>
        </div>

        <InputError class="mt-2 text-center font-bold" :message="form.errors?.captcha_token" />

        <FormButton :processing="form.processing">
          {{ __('Sign Up') }}
        </FormButton>

        <p class="text-center text-sm">
          {{ __('Already have an account?') }}
          <Link
            :href="route('login')"
            class="text-orange-600 font-bold hover:cursor-pointer hover:underline"
          >
            {{ __('Login') }}
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
