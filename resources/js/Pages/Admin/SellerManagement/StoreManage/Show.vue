<script setup>
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue'
import Breadcrumb from '@/Components/Breadcrumbs/Breadcrumb.vue'
import BreadcrumbItem from '@/Components/Breadcrumbs/BreadcrumbItem.vue'
import GreenBadge from '@/Components/Badges/GreenBadge.vue'
import OrangeBadge from '@/Components/Badges/OrangeBadge.vue'
import RedBadge from '@/Components/Badges/RedBadge.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import SelectBox from '@/Components/Forms/Fields/SelectBox.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import PreviewImage from '@/Components/Forms/PreviewImage.vue'
import GoBackButton from '@/Components/Buttons/GoBackButton.vue'
import { useResourceActions } from '@/Composables/useResourceActions'
import { Head } from '@inertiajs/vue3'
import { __ } from '@/Services/translations-inside-setup.js'

const props = defineProps({ store: Object })

const { form, processing, errors, editAction } = useResourceActions({
  status: props.store?.status
})
</script>

<template>
  <Head :title="__(store.store_name)" />

  <AdminDashboardLayout>
    <!-- Breadcrumb And Trash Button  -->
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb to="admin.store-manage.index" icon="fa-store" label="Store Manage">
          <BreadcrumbItem :label="store?.store_name" />
        </Breadcrumb>

        <GoBackButton />
      </div>

      <div class="border bg-white rounded-md space-y-5 shadow p-10">
        <PreviewImage :src="store?.avatar" />

        <div
          class="border border-gray-300 overflow-hidden font-semibold text-sm text-gray-800 rounded-md"
        >
          <div class="bg-gray-100 py-3.5 px-10 flex items-center justify-center">
            <div class="w-1/2">Store Name</div>
            <div class="w-1/2">
              {{ store?.store_name }}
            </div>
          </div>
          <div class="bg-white py-3.5 px-10 flex items-center justify-center">
            <div class="w-1/2">Store Type</div>
            <div class="w-1/2">
              <OrangeBadge v-show="store?.store_type === 'personal'">
                {{ store?.store_type }}
              </OrangeBadge>
              <GreenBadge v-show="store?.store_type === 'business'">
                {{ store?.store_type }}
              </GreenBadge>
            </div>
          </div>
          <div class="bg-gray-100 py-3.5 px-10 flex items-center justify-center">
            <div class="w-1/2">Store Contact Email</div>
            <div class="w-1/2">
              {{ store?.contact_email }}
            </div>
          </div>
          <div class="bg-white py-3.5 px-10 flex items-center justify-center">
            <div class="w-1/2">Store Contact Phone</div>
            <div class="w-1/2">
              {{ store?.contact_phone }}
            </div>
          </div>
          <div class="bg-gray-100 py-3.5 px-10 flex items-center justify-center">
            <div class="w-1/2">Store Address</div>
            <div class="w-1/2">
              {{ store?.address }}
            </div>
          </div>
          <div class="bg-white py-3.5 px-10 flex items-center justify-center">
            <div class="w-1/2">Store Description</div>
            <div class="w-1/2">
              {{ store?.description }}
            </div>
          </div>
          <div class="bg-gray-100 py-3.5 px-10 flex items-center justify-center">
            <div class="w-1/2">Store Status</div>
            <div class="w-1/2">
              <GreenBadge v-show="store?.status === 'active'">
                <i class="fa-solid fa-circle-check animate-pulse"></i>
                {{ store?.status }}
              </GreenBadge>
              <RedBadge v-show="store?.status === 'inactive'">
                <i class="fa-solid fa-circle-xmark animate-pulse"></i>
                {{ store?.status }}
              </RedBadge>
            </div>
          </div>
        </div>

        <form
          v-show="can('store-manage.edit')"
          @submit.prevent="
            editAction('Store', 'admin.store-manage.change-status', {
              store: store?.slug
            })
          "
          class="space-y-4 md:space-y-6"
        >
          <div>
            <InputLabel :label="__('Status')" required />

            <SelectBox
              name="status"
              :options="[
                {
                  label: 'Active',
                  value: 'active'
                },
                {
                  label: 'Inactive',
                  value: 'inactive'
                }
              ]"
              v-model="form.status"
              :placeholder="__('Select an option')"
              :selected="store.status"
              required
            />

            <InputError :message="errors?.status" />
          </div>

          <FormButton :processing="processing">
            {{ __('Save Changes') }}
          </FormButton>
        </form>
      </div>
    </div>
  </AdminDashboardLayout>
</template>
