<script setup>
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import Modal from '@/Components/Modals/DeleteAccountModal.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import NormalButton from '@/Components/Buttons/NormalButton.vue'
import UserDashboardLayout from '@/Layouts/UserDashboardLayout.vue'
import { Head, useForm, usePage } from '@inertiajs/vue3'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'
import { useReCaptcha } from 'vue-recaptcha-v3'
import { __ } from '@/Services/translations-inside-setup.js'
import { ref } from 'vue'

const confirmingUserDeletion = ref(false)

const form = useForm({
  password: '',
  captcha_token: null
})

const { executeRecaptcha, recaptchaLoaded } = useReCaptcha()

const confirmUserDeletion = () => {
  confirmingUserDeletion.value = true
}

const deleteUser = async () => {
  await recaptchaLoaded()
  form.captcha_token = await executeRecaptcha('delete_account')

  form.delete(route('profile.destroy'), {
    preserveScroll: true,
    onSuccess: () => {
      closeModal()
      const successMessage = usePage().props.flash.success
      toast.success(__(successMessage), {
        autoClose: 2000
      })
    },
    onFinish: () => form.reset()
  })
}

const closeModal = () => {
  confirmingUserDeletion.value = false

  form.reset()
}
</script>

<template>
  <Head :title="__('Delete Account')" />

  <UserDashboardLayout>
    <h1 class="font-bold text-md text-gray-700 mb-5 pb-5 border-b">
      <i class="fa-solid fa-ban"></i>
      {{ __('Delete Account') }}
    </h1>

    <div class="p-10 border border-gray-200 bg-white rounded-md">
      <p class="mt-1 text-sm text-gray-700 font-medium mb-8">
        {{
          __(
            'Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'
          )
        }}
      </p>

      <NormalButton @click="confirmUserDeletion" class="bg-red-600 text-white ring-2 ring-red-300">
        {{ __('Delete Account') }}
      </NormalButton>

      <Modal :show="confirmingUserDeletion" @close="closeModal">
        <div class="p-6">
          <h2 class="text-lg font-medium text-gray-900">
            {{ __('Are you sure you want to delete your account?') }}
          </h2>

          <p class="mt-1 text-sm text-gray-700 font-medium mb-8">
            {{
              __(
                'Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.'
              )
            }}
          </p>

          <div class="mt-6">
            <InputLabel :label="__('Password')" required />

            <InputField
              type="password"
              name="current-password"
              icon="fa-lock"
              v-model="form.password"
              :placeholder="__('Enter :label', { label: __('Password') })"
              @keyup.enter="deleteUser"
            />

            <InputError :message="form.errors?.password" />
          </div>

          <div class="mt-6 flex justify-end space-x-5">
            <NormalButton @click="closeModal"> {{ __('Cancel') }} </NormalButton>

            <NormalButton
              class="bg-red-600 text-white ring-2 ring-red-300"
              :disabled="form.processing"
              @click="deleteUser"
            >
              {{ __('Delete Account') }}
            </NormalButton>
          </div>
        </div>
      </Modal>
    </div>
  </UserDashboardLayout>
</template>
