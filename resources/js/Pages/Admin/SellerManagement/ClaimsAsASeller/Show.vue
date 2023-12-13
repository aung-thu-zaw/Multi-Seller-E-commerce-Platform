<script setup>
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue'
import Breadcrumb from '@/Components/Breadcrumbs/Breadcrumb.vue'
import BreadcrumbItem from '@/Components/Breadcrumbs/BreadcrumbItem.vue'
import GreenBadge from '@/Components/Badges/GreenBadge.vue'
import OrangeBadge from '@/Components/Badges/OrangeBadge.vue'
import RedBadge from '@/Components/Badges/RedBadge.vue'
import BlueBadge from '@/Components/Badges/BlueBadge.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import TextAreaField from '@/Components/Forms/Fields/TextAreaField.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import SelectBox from '@/Components/Forms/Fields/SelectBox.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import GoBackButton from '@/Components/Buttons/GoBackButton.vue'
import { useResourceActions } from '@/Composables/useResourceActions'
import { Head } from '@inertiajs/vue3'
import { __ } from '@/Services/translations-inside-setup.js'

const props = defineProps({ sellerRequest: Object })

const { form, processing, errors, editAction } = useResourceActions({
  status: props.sellerRequest?.status,
  reason_for_rejection: null
})
</script>

<template>
  <Head :title="__('Claims As A Seller')" />

  <AdminDashboardLayout>
    <!-- Breadcrumb And Trash Button  -->
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb
          to="admin.claims-as-a-seller.index"
          icon="fa-user-tie"
          label="Claims as a seller"
        >
          <BreadcrumbItem :label="sellerRequest?.store_name" />
        </Breadcrumb>

        <GoBackButton />
      </div>

      <div class="border bg-white rounded-md shadow space-y-5 p-10">
        <div
          class="border border-gray-300 overflow-hidden font-semibold text-sm text-gray-800 rounded-md"
        >
          <div class="bg-gray-100 py-3.5 px-10 flex items-center justify-center">
            <div class="w-1/2">Store Name</div>
            <div class="w-1/2">
              {{ sellerRequest?.store_name }}
            </div>
          </div>
          <div class="bg-white py-3.5 px-10 flex items-center justify-center">
            <div class="w-1/2">Store Type</div>
            <div class="w-1/2">
              <OrangeBadge v-show="sellerRequest?.store_type === 'personal'">
                {{ sellerRequest?.store_type }}
              </OrangeBadge>
              <GreenBadge v-show="sellerRequest?.store_type === 'business'">
                {{ sellerRequest?.store_type }}
              </GreenBadge>
            </div>
          </div>
          <div class="bg-gray-100 py-3.5 px-10 flex items-center justify-center">
            <div class="w-1/2">Contact Email</div>
            <div class="w-1/2">
              {{ sellerRequest?.contact_email }}
            </div>
          </div>
          <div class="bg-white py-3.5 px-10 flex items-center justify-center">
            <div class="w-1/2">Contact Phone</div>
            <div class="w-1/2">
              {{ sellerRequest?.contact_phone }}
            </div>
          </div>
          <div class="bg-gray-100 py-3.5 px-10 flex items-center justify-center">
            <div class="w-1/2">Address</div>
            <div class="w-1/2">
              {{ sellerRequest?.address }}
            </div>
          </div>
          <div class="bg-white py-3.5 px-10 flex items-center justify-center">
            <div class="w-1/2">Additional Information</div>
            <div class="w-1/2">
              {{ sellerRequest?.additional_information }}
            </div>
          </div>
          <div class="bg-gray-100 py-3.5 px-10 flex items-center justify-center">
            <div class="w-1/2">Status</div>
            <div class="w-1/2">
              <BlueBadge v-show="sellerRequest?.status === 'pending'">
                <i class="fa-solid fa-spinner animate-spin"></i>
                {{ sellerRequest?.status }}
              </BlueBadge>
              <GreenBadge v-show="sellerRequest?.status === 'approved'">
                <i class="fa-solid fa-circle-check animate-pulse"></i>
                {{ sellerRequest?.status }}
              </GreenBadge>
              <RedBadge v-show="sellerRequest?.status === 'rejected'">
                <i class="fa-solid fa-circle-xmark animate-pulse"></i>
                {{ sellerRequest?.status }}
              </RedBadge>
            </div>
          </div>
        </div>

        <form
          v-show="can('claims-as-a-seller.edit')"
          @submit.prevent="
            editAction('Claim as a seller', 'admin.claims-as-a-seller.change-status', {
              seller_request: sellerRequest?.id
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
                  label: 'Approved',
                  value: 'approved'
                },
                {
                  label: 'Rejected',
                  value: 'rejected'
                }
              ]"
              v-model="form.status"
              :placeholder="__('Select an option')"
              :selected="sellerRequest.status"
              required
            />

            <InputError :message="errors?.status" />
          </div>

          <div v-show="form.status === 'rejected'">
            <InputLabel :label="__('Reason For Rejection')" />

            <TextAreaField
              name="reason-for-rejection"
              v-model="form.reason_for_rejection"
              :placeholder="__('Enter :label', { label: __('Reason For Rejection') })"
            />
            <InputError :message="errors?.reason_for_rejection" />
          </div>

          <FormButton :processing="processing">
            {{ __('Save Changes') }}
          </FormButton>
        </form>
      </div>
    </div>
  </AdminDashboardLayout>
</template>
