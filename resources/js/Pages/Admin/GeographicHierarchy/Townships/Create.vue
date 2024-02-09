<script setup>
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue'
import Breadcrumb from '@/Components/Breadcrumbs/Breadcrumb.vue'
import BreadcrumbItem from '@/Components/Breadcrumbs/BreadcrumbItem.vue'
import SelectBox from '@/Components/Forms/Fields/SelectBox.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import GoBackButton from '@/Components/Buttons/GoBackButton.vue'
import { useResourceActions } from '@/Composables/useResourceActions'
import { Head } from '@inertiajs/vue3'

defineProps({ regions: Object, cities: Object, township: Object })

const { form, processing, errors, createAction } = useResourceActions({
  city_id: null,
  name: null
})
</script>

<template>
  <Head :title="__('Create :label', { label: __('Township') })" />

  <AdminDashboardLayout>
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb to="admin.townships.index" icon="fa-map-location-dot" label="Townships">
          <BreadcrumbItem label="Create" />
        </Breadcrumb>

        <div class="w-auto flex items-center justify-end">
          <GoBackButton />
        </div>
      </div>

      <!-- Form Start -->
      <div class="border p-10 bg-white rounded-md">
        <form
          @submit.prevent="createAction('Township', 'admin.townships.store')"
          class="space-y-4 md:space-y-6"
        >
          <div>
            <InputLabel :label="__('City')" required />
            <SelectBox
              name="city"
              :options="cities"
              v-model="form.city_id"
              :placeholder="__('Select an option')"
              required
            />

            <InputError :message="errors?.city_id" />
          </div>

          <div>
            <InputLabel :label="__('Township Name')" required />

            <InputField
              type="text"
              name="township-name"
              v-model="form.name"
              :placeholder="__('Enter :label', { label: __('Township Name') })"
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
