<script setup>
import PreviewImage from '@/Components/Forms/PreviewImage.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import TextAreaField from '@/Components/Forms/Fields/TextAreaField.vue'
import FileInput from '@/Components/Forms/Fields/FileInput.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'
import { useImagePreview } from '@/Composables/useImagePreview'
import { useResourceActions } from '@/Composables/useResourceActions'

const store = computed(() => usePage().props.auth?.store)

const { previewImage, setImagePreview } = useImagePreview(store.value?.avatar)

const { form, processing, errors, editAction } = useResourceActions({
  store_name: store.value?.store_name,
  contact_email: store.value?.contact_email,
  contact_phone: store.value?.contact_phone,
  address: store.value?.address,
  description: store.value?.description,
  avatar: store.value?.avatar,
  cover: store.value?.cover
})
</script>

<template>
  <!-- Form Start -->
  <div class="border p-10 bg-white rounded-md">
    <form @submit.prevent="editAction" class="space-y-4 md:space-y-6">
      <PreviewImage :src="previewImage" />

      <div>
        <InputLabel :label="__('Store Name')" required />

        <InputField
          type="text"
          name="store-name"
          icon="fa-store"
          v-model="form.store_name"
          :placeholder="__('Enter :label', { label: __('Store Name') })"
          required
        />

        <InputError :message="errors?.store_name" />
      </div>
      <div class="grid grid-cols-2 gap-5">
        <div>
          <InputLabel :label="__('Email Address')" required />

          <InputField
            type="email"
            name="store-email"
            icon="fa-envelope"
            v-model="form.contact_email"
            :placeholder="__('Enter :label', { label: __('Email Address') })"
            required
          />

          <InputError :message="errors?.contact_email" />
        </div>

        <div>
          <InputLabel :label="__('Phone Number')" required />

          <InputField
            type="text"
            name="store-phone"
            icon="fa-phone"
            v-model="form.contact_phone"
            :placeholder="__('Enter :label', { label: __('Phone Number') })"
            required
          />

          <InputError :message="errors?.contact_phone" />
        </div>
      </div>

      <div>
        <InputLabel :label="__('Address')" />

        <InputField
          type="text"
          name="store-address"
          icon="fa-location-dot"
          v-model="form.address"
          :placeholder="__('Enter :label', { label: __('Store Address') })"
        />

        <InputError :message="errors?.address" />
      </div>

      <div>
        <InputLabel :label="__('Store Description')" />

        <TextAreaField
          name="store-description"
          v-model="form.description"
          :placeholder="__('Enter :label', { label: __('Store Description') })"
        />

        <InputError :message="errors?.description" />
      </div>

      <div class="grid grid-cols-2 gap-5">
        <div>
          <InputLabel :label="__('Store Profile')" required />

          <FileInput
            name="store-profile"
            text="PNG, JPG or JPEG ( Max File Size : 1.5 MB )"
            v-model="form.avatar"
            @update:modelValue="setImagePreview"
            required
          />

          <InputError :message="errors?.avatar" />
        </div>
        <div>
          <InputLabel :label="__('Store Cover')" />

          <FileInput
            name="store-cover"
            text="PNG, JPG or JPEG ( Max File Size : 1.5 MB )"
            v-model="form.cover"
            @update:modelValue="setImagePreview"
          />

          <InputError :message="errors?.cover" />
        </div>
      </div>

      <InputError :message="errors?.captcha_token" />

      <FormButton :processing="processing">
        {{ __('Submit') }}
      </FormButton>
    </form>
  </div>
  <!-- Form End -->
</template>
