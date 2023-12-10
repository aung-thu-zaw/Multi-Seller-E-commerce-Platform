<script setup>
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import UserDashboardLayout from '@/Layouts/UserDashboardLayout.vue'
import { Head, useForm, usePage } from '@inertiajs/vue3'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'
import { useReCaptcha } from 'vue-recaptcha-v3'
import { __ } from '@/Services/translations-inside-setup.js'

const form = useForm({
  current_password: '',
  password: '',
  password_confirmation: '',
  captcha_token: null
})

const { executeRecaptcha, recaptchaLoaded } = useReCaptcha()

const updatePassword = async () => {
  await recaptchaLoaded()
  form.captcha_token = await executeRecaptcha('change_password')

  form.put(route('password.update'), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset()

      const successMessage = usePage().props.flash.success
      toast.success(__(successMessage), {
        autoClose: 2000
      })
    },
    onError: () => {
      if (form.errors.password) {
        form.reset('password', 'password_confirmation')
        passwordInput.value.focus()
      }
      if (form.errors.current_password) {
        form.reset('current_password')
        currentPasswordInput.value.focus()
      }
    }
  })
}
</script>

<template>
  <Head :title="__('Change Password')" />

  <UserDashboardLayout>
    <h1 class="font-bold text-md text-gray-700 mb-5 pb-5 border-b">
      <i class="fa-solid fa-lock"></i>
      {{ __('Change Password') }}
    </h1>

    <div class="p-10 border border-gray-200 bg-white rounded-md">
      <form @submit.prevent="updatePassword" class="space-y-4 md:space-y-6">
        <div>
          <InputLabel :label="__('Current Password')" required />

          <InputField
            type="password"
            name="current-password"
            icon="fa-lock"
            v-model="form.current_password"
            :placeholder="__('Enter :label', { label: __('Your Current Password') })"
          />

          <InputError :message="form.errors?.current_password" />
        </div>
        <div>
          <InputLabel :label="__('New Password')" required />

          <InputField
            type="password"
            name="new-password"
            icon="fa-lock"
            v-model="form.password"
            :placeholder="__('Enter :label', { label: __('New Password') })"
          />

          <InputError :message="form.errors?.password" />
        </div>

        <div>
          <InputLabel :label="__('Confirm Password')" required />

          <InputField
            type="password"
            name="password-confirmation"
            icon="fa-lock"
            v-model="form.password_confirmation"
            :placeholder="__('Retype Password')"
          />

          <InputError :message="form.errors?.password_confirmation" />
        </div>

        <InputError :message="form.errors?.captcha_token" />

        <FormButton :processing="form.processing">
          {{ __('Save Changes') }}
        </FormButton>
      </form>
    </div>
  </UserDashboardLayout>
</template>
