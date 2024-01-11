<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import { Head, useForm } from '@inertiajs/vue3'

const form = useForm({
  password: ''
})

const submit = () => {
  form.post(route('password.confirm'), {
    onFinish: () => form.reset()
  })
}
</script>

<template>
  <GuestLayout>
    <Head title="Confirm Password" />

    <div class="mb-4 text-sm text-gray-600">
      This is a secure area of the application. Please confirm your password before continuing.
    </div>

    <form @submit.prevent="submit">
      <div>
        <InputLabel for="password" value="Password" />
        <InputField
          id="password"
          type="password"
          class="mt-1 block w-full"
          v-model="form.password"
          required
          autocomplete="current-password"
          autofocus
        />
        <InputError class="mt-2" :message="form.errors.password" />
      </div>

      <div class="flex justify-end mt-4">
        <FormButton
          class="ms-4"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Confirm
        </FormButton>
      </div>
    </form>
  </GuestLayout>
</template>
