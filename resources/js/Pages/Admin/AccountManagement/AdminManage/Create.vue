<script setup>
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue'
import Breadcrumb from '@/Components/Breadcrumbs/Breadcrumb.vue'
import BreadcrumbItem from '@/Components/Breadcrumbs/BreadcrumbItem.vue'
import PreviewImage from '@/Components/Forms/PreviewImage.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import SelectBox from '@/Components/Forms/Fields/SelectBox.vue'
import FileInput from '@/Components/Forms/Fields/FileInput.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import GoBackButton from '@/Components/Buttons/GoBackButton.vue'
import { useImagePreview } from '@/Composables/useImagePreview'
import { useResourceActions } from '@/Composables/useResourceActions'
import { Head } from '@inertiajs/vue3'

defineProps({ roles: Object })

const { previewImage, setImagePreview } = useImagePreview()

const { form, processing, errors, createAction } = useResourceActions({
  role_id: null,
  name: null,
  email: null,
  phone: null,
  password: null,
  password_confirmation: null,
  avatar: null
})
</script>

<template>
  <Head :title="__('Create :label', { label: __('Admin') })" />

  <AdminDashboardLayout>
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb to="admin.admin-manage.index" icon="fa-user-tie" label="Admin Manage">
          <BreadcrumbItem label="Create" />
        </Breadcrumb>

        <div class="w-auto flex items-center justify-end">
          <GoBackButton />
        </div>
      </div>

      <!-- Form Start -->
      <div class="border p-10 bg-white rounded-md">
        <form
          @submit.prevent="createAction('Admin', 'admin.admin-manage.store')"
          class="space-y-4 md:space-y-6"
        >
          <PreviewImage :src="previewImage" />

          <div>
            <InputLabel :label="__('Name')" required />

            <InputField
              type="text"
              name="admin-name"
              v-model="form.name"
              :placeholder="__('Enter :label', { label: __('Name') })"
              autofocus
              required
            />

            <InputError :message="errors?.name" />
          </div>

          <div>
            <InputLabel :label="__('Email Address')" required />

            <InputField
              type="email"
              name="admin-email"
              v-model="form.email"
              :placeholder="__('Enter :label', { label: __('Email Address') })"
              required
            />

            <InputError :message="errors?.email" />
          </div>

          <div>
            <InputLabel :label="__('Phone Number')" required />

            <InputField
              type="text"
              name="admin-phone"
              v-model="form.phone"
              :placeholder="__('Enter :label', { label: __('Phone Number') })"
              required
            />

            <InputError :message="errors?.phone" />
          </div>

          <div class="grid grid-cols-2 gap-5">
            <div>
              <InputLabel :label="__('Password')" required />

              <InputField
                type="password"
                name="admin-password"
                v-model="form.password"
                :placeholder="__('Enter :label', { label: __('Password') })"
                required
              />

              <InputError :message="errors?.password" />
            </div>

            <div>
              <InputLabel :label="__('Confirm Password')" required />

              <InputField
                type="password"
                name="admin-confirm-password"
                v-model="form.password_confirmation"
                :placeholder="__('Retype Password')"
                required
              />

              <InputError :message="errors?.password_confirmation" />
            </div>
          </div>

          <div>
            <InputLabel :label="__('Role')" required />

            <SelectBox
              name="role"
              :options="roles"
              v-model="form.role_id"
              :placeholder="__('Select an option')"
              required
            />

            <InputError :message="errors?.role_id" />
          </div>

          <div>
            <InputLabel :label="__('Avatar')" required />

            <FileInput
              name="admin-avatar"
              text="PNG, JPG or JPEG ( Max File Size : 1.5 MB )"
              v-model="form.avatar"
              @update:modelValue="setImagePreview"
              required
            />

            <InputError :message="errors?.avatar" />
          </div>

          <InputError :message="errors?.captcha_token" />

          <FormButton :processing="processing">
            {{ __('Create') }}
          </FormButton>
        </form>
      </div>
      <!-- Form End -->
    </div>
  </AdminDashboardLayout>
</template>
