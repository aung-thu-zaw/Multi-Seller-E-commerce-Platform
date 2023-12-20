<script setup>
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue'
import Breadcrumb from '@/Components/Breadcrumbs/Breadcrumb.vue'
import BreadcrumbItem from '@/Components/Breadcrumbs/BreadcrumbItem.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import TextAreaField from '@/Components/Forms/Fields/TextAreaField.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import GoBackButton from '@/Components/Buttons/GoBackButton.vue'
import { useResourceActions } from '@/Composables/useResourceActions'
import { Head } from '@inertiajs/vue3'

const { form, processing, errors, createAction } = useResourceActions({
  name: null,
  description: null
})
</script>

<template>
  <Head :title="__('Create :label', { label: __('Collection') })" />

  <AdminDashboardLayout>
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb to="admin.collections.index" icon="fa-box" label="Collections">
          <BreadcrumbItem label="Create" />
        </Breadcrumb>

        <div class="w-auto flex items-center justify-end">
          <GoBackButton />
        </div>
      </div>

      <!-- Form Start -->
      <div class="border p-10 bg-white rounded-md">
        <form
          @submit.prevent="createAction('Collection', 'admin.collections.store')"
          class="space-y-4 md:space-y-6"
        >
          <div>
            <InputLabel :label="__('Collection Name')" required />

            <InputField
              type="text"
              name="collection-name"
              v-model="form.name"
              :placeholder="__('Enter :label', { label: __('Collection Name') })"
              autofocus
              required
            />

            <InputError :message="errors?.name" />
          </div>

          <div>
            <InputLabel :label="__('Description')" required />

            <TextAreaField
              name="collection-description"
              v-model="form.description"
              :placeholder="__('Enter :label', { label: __('Collection Description') })"
              required
            />

            <InputError :message="errors?.description" />
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
