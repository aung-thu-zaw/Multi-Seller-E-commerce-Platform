<script setup>
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue'
import Breadcrumb from '@/Components/Breadcrumbs/Breadcrumb.vue'
import BreadcrumbItem from '@/Components/Breadcrumbs/BreadcrumbItem.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import GoBackButton from '@/Components/Buttons/GoBackButton.vue'
import { useResourceActions } from '@/Composables/useResourceActions'
import { Head } from '@inertiajs/vue3'

const { form, processing, errors, createAction } = useResourceActions({
  name: null
})
</script>

<template>
  <Head :title="__('Create :label', { label: __('Shipping Method') })" />

  <AdminDashboardLayout>
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb to="admin.shipping-methods.index" icon="fa-truck" label="Shipping Methods">
          <BreadcrumbItem label="Create" />
        </Breadcrumb>

        <div class="w-auto flex items-center justify-end">
          <GoBackButton />
        </div>
      </div>

      <!-- Form Start -->
      <div class="border p-10 bg-white rounded-md">
        <form
          @submit.prevent="createAction('Shipping Method', 'admin.shipping-methods.store')"
          class="space-y-4 md:space-y-6"
        >
          <div>
            <InputLabel :label="__('Shipping Method Name')" required />

            <InputField
              type="text"
              name="shipping-method-name"
              v-model="form.name"
              :placeholder="__('Enter :label', { label: __('Shipping Method Name') })"
              autofocus
              required
            />

            <InputError :message="errors?.name" />
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
