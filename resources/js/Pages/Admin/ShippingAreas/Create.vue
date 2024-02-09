<script setup>
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue'
import Breadcrumb from '@/Components/Breadcrumbs/Breadcrumb.vue'
import BreadcrumbItem from '@/Components/Breadcrumbs/BreadcrumbItem.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import SelectBox from '@/Components/Forms/Fields/SelectBox.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import GoBackButton from '@/Components/Buttons/GoBackButton.vue'
import { useResourceActions } from '@/Composables/useResourceActions'
import { Head } from '@inertiajs/vue3'
import { computed } from 'vue'

const props = defineProps({ regions: Object, cities: Object, townships: Object })

const { form, processing, errors, createAction } = useResourceActions({
  region_id: null,
  city_id: null,
  township_id: null,
  name: null
})

const filteredCities = computed(() => {
  if (!form.region_id) {
    return []
  }

  return props.cities.filter((city) => Number(city.region_id) === Number(form.region_id))
})

const filteredTownships = computed(() => {
  if (!form.city_id) {
    return []
  }

  return props.townships.filter((township) => Number(township.city_id) === Number(form.city_id))
})
</script>

<template>
  <Head :title="__('Create :label', { label: __('Shipping Area') })" />

  <AdminDashboardLayout>
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb to="admin.shipping-areas.index" icon="fa-location-dot" label="Shipping Areas">
          <BreadcrumbItem label="Create" />
        </Breadcrumb>

        <div class="w-auto flex items-center justify-end">
          <GoBackButton />
        </div>
      </div>
      <!-- Form Start -->
      <div class="border p-10 bg-white rounded-md">
        <form
          @submit.prevent="createAction('Shipping Area', 'admin.shipping-areas.store')"
          class="space-y-4 md:space-y-6"
        >
          <div>
            <InputLabel :label="__('Region')" required />

            <SelectBox
              name="region"
              :options="regions"
              v-model="form.region_id"
              :placeholder="__('Select an option')"
              required
            />

            <InputError :message="errors?.region_id" />
          </div>

          <div>
            <InputLabel :label="__('City')" required />

            <SelectBox
              name="city"
              :options="filteredCities"
              v-model="form.city_id"
              :placeholder="__('Select an option')"
              required
              :disabled="!form.region_id"
            />

            <InputError :message="errors?.city_id" />
          </div>

          <div>
            <InputLabel :label="__('Township')" required />

            <SelectBox
              name="township"
              :options="filteredTownships"
              v-model="form.township_id"
              :placeholder="__('Select an option')"
              required
              :disabled="(!form.city_id && !form.region_id) || (form.region_id && !form.city_id)"
            />

            <InputError :message="errors?.township_id" />
          </div>

          <div>
            <InputLabel :label="__('Shipping Area Name')" required />

            <InputField
              type="text"
              name="shipping-area-name"
              v-model="form.name"
              :placeholder="__('Enter :label', { label: __('Shipping Area Name') })"
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
