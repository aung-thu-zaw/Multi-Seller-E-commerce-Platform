<script setup>
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue'
import Breadcrumb from '@/Components/Breadcrumbs/Breadcrumb.vue'
import BreadcrumbItem from '@/Components/Breadcrumbs/BreadcrumbItem.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import SelectBox from '@/Components/Forms/Fields/SelectBox.vue'
import Datepicker from 'vue3-datepicker'
import FormButton from '@/Components/Buttons/FormButton.vue'
import GoBackButton from '@/Components/Buttons/GoBackButton.vue'
import { useResourceActions } from '@/Composables/useResourceActions'
import { Head } from '@inertiajs/vue3'
import { ref, watch } from 'vue'
import { useFormatFunctions } from '@/Composables/useFormatFunctions'

const props = defineProps({ coupon: Object })

const { formatDate } = useFormatFunctions()

const expiryDate = ref(props.coupon?.expiry_date ? new Date(props.coupon?.expiry_date) : null)

const { form, processing, errors, editAction } = useResourceActions({
  code: props.coupon?.code,
  type: props.coupon?.type,
  value: props.coupon?.value,
  min_spend: props.coupon?.min_spend,
  usage_limit: props.coupon?.usage_limit,
  used: props.coupon?.used,
  expiry_date: props.coupon?.expiry_date,
  status: props.coupon?.status
})

watch(expiryDate, (newExpiryDate) => {
  form.expiry_date = newExpiryDate ? formatDate(newExpiryDate) : null
})
</script>

<template>
  <Head :title="__('Edit :label', { label: __('Coupon') })" />

  <AdminDashboardLayout>
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb to="admin.coupons.index" icon="fa-ticket" label="Coupons">
          <BreadcrumbItem :label="coupon.code" />
          <BreadcrumbItem label="Edit" />
        </Breadcrumb>

        <div class="w-auto flex items-center justify-end">
          <GoBackButton />
        </div>
      </div>

      <!-- Form Start -->
      <div class="border p-10 bg-white rounded-md">
        <form
          @submit.prevent="editAction('Coupon', 'admin.coupons.update', { coupon: coupon?.id })"
          class="space-y-4 md:space-y-6"
        >
          <div>
            <InputLabel :label="__('Coupon Code')" required />

            <InputField
              type="text"
              name="coupon-code"
              v-model="form.code"
              :placeholder="__('Enter :label', { label: __('Coupon Code') })"
              autofocus
              required
            />

            <InputError :message="errors?.code" />
          </div>

          <div>
            <InputLabel :label="__('Coupon Type')" required />

            <SelectBox
              name="coupon-type"
              :options="[
                {
                  label: 'Fixed',
                  value: 'fixed'
                },
                {
                  label: 'Percentage',
                  value: 'percentage'
                },
                {
                  label: 'Free Shipping',
                  value: 'free_shipping'
                }
              ]"
              v-model="form.type"
              :selected="form.type"
              :placeholder="__('Select an option')"
              required
            />

            <InputError :message="errors?.type" />
          </div>

          <div>
            <InputLabel :label="__('Coupon Value')" required />

            <InputField
              type="text"
              name="coupon-value"
              v-model="form.value"
              :placeholder="__('Enter :label', { label: __('Coupon Value') })"
              required
            />

            <InputError :message="errors?.value" />
          </div>

          <div>
            <InputLabel :label="__('Minimum Spend Amount')" />

            <InputField
              type="text"
              name="minimum-spend"
              v-model="form.min_spend"
              :placeholder="__('Enter :label', { label: __('Minimum Spend Amount') })"
            />

            <InputError :message="errors?.min_spend" />
          </div>

          <div>
            <InputLabel :label="__('Usage Limit')" />

            <InputField
              type="number"
              name="usage-limit"
              v-model="form.usage_limit"
              :placeholder="__('Enter :label', { label: __('Usage Limit') })"
            />

            <InputError :message="errors?.usage_limit" />
          </div>

          <div>
            <InputLabel :label="__('Coupon Status')" required />

            <SelectBox
              name="coupon-status"
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
              :selected="form.status"
              required
            />

            <InputError :message="errors?.status" />
          </div>

          <div>
            <InputLabel :label="__('Expiry Date')" />

            <Datepicker
              id="expiry-date"
              class="block w-full p-4 font-semibold text-sm text-gray-800 border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-orange-300 focus:border-orange-400 transition-all rounded-md"
              :placeholder="__('Select Date')"
              v-model="expiryDate"
            />

            <InputError :message="errors?.expiry_date" />
          </div>

          <InputError :message="errors?.captcha_token" />

          <FormButton :processing="processing">
            {{ __('Save Changes') }}
          </FormButton>
        </form>
      </div>
      <!-- Form End -->
    </div>
  </AdminDashboardLayout>
</template>
