<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import AuthFormContainer from '@/Components/Forms/AuthFormContainer.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
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
      toast.success(usePage().props.flash.success, {
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
      <div class="flex items-center justify-between space-x-5 w-full">
        <button
          type="button"
          class="w-full p-4 inline-flex justify-center items-center gap-x-2 text-md font-semibold rounded-lg border shadow-sm disabled:opacity-50 disabled:pointer-events-none bg-white border-gray-300 text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-orange-300 focus:border-orange-400"
        >
          <svg class="w-4 h-auto" width="46" height="47" viewBox="0 0 46 47" fill="none">
            <path
              d="M46 24.0287C46 22.09 45.8533 20.68 45.5013 19.2112H23.4694V27.9356H36.4069C36.1429 30.1094 34.7347 33.37 31.5957 35.5731L31.5663 35.8669L38.5191 41.2719L38.9885 41.3306C43.4477 37.2181 46 31.1669 46 24.0287Z"
              fill="#4285F4"
            />
            <path
              d="M23.4694 47C29.8061 47 35.1161 44.9144 39.0179 41.3012L31.625 35.5437C29.6301 36.9244 26.9898 37.8937 23.4987 37.8937C17.2793 37.8937 12.0281 33.7812 10.1505 28.1412L9.88649 28.1706L2.61097 33.7812L2.52296 34.0456C6.36608 41.7125 14.287 47 23.4694 47Z"
              fill="#34A853"
            />
            <path
              d="M10.1212 28.1413C9.62245 26.6725 9.32908 25.1156 9.32908 23.5C9.32908 21.8844 9.62245 20.3275 10.0918 18.8588V18.5356L2.75765 12.8369L2.52296 12.9544C0.909439 16.1269 0 19.7106 0 23.5C0 27.2894 0.909439 30.8731 2.49362 34.0456L10.1212 28.1413Z"
              fill="#FBBC05"
            />
            <path
              d="M23.4694 9.07688C27.8699 9.07688 30.8622 10.9863 32.5344 12.5725L39.1645 6.11C35.0867 2.32063 29.8061 0 23.4694 0C14.287 0 6.36607 5.2875 2.49362 12.9544L10.0918 18.8588C11.9987 13.1894 17.25 9.07688 23.4694 9.07688Z"
              fill="#EB4335"
            />
          </svg>
          Google
        </button>

        <button
          type="button"
          class="w-full p-4 inline-flex justify-center items-center gap-x-2 text-md font-semibold rounded-lg border shadow-sm disabled:opacity-50 disabled:pointer-events-none bg-white border-gray-300 text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-orange-300 focus:border-orange-400"
        >
          <svg
            class="w-6 h-auto"
            width="100"
            height="100"
            xmlns="http://www.w3.org/2000/svg"
            x="0px"
            y="0px"
            viewBox="0 0 48 48"
          >
            <path fill="#039be5" d="M24 5A19 19 0 1 0 24 43A19 19 0 1 0 24 5Z"></path>
            <path
              fill="#fff"
              d="M26.572,29.036h4.917l0.772-4.995h-5.69v-2.73c0-2.075,0.678-3.915,2.619-3.915h3.119v-4.359c-0.548-0.074-1.707-0.236-3.897-0.236c-4.573,0-7.254,2.415-7.254,7.917v3.323h-4.701v4.995h4.701v13.729C22.089,42.905,23.032,43,24,43c0.875,0,1.729-0.08,2.572-0.194V29.036z"
            ></path>
          </svg>

          Facebook
        </button>
      </div>
    </AuthFormContainer>
  </AppLayout>
</template>
