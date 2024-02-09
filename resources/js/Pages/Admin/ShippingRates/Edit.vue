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

const props = defineProps({ shippingRate: Object, shippingMethods: Object, shippingAreas: Object })

const { form, processing, errors, editAction } = useResourceActions({
  shipping_area_id: props.shippingRate?.shipping_area_id,
  shipping_method_id: props.shippingRate?.shipping_method_id,
  min_order_total: props.shippingRate?.min_order_total,
  max_order_total: props.shippingRate?.max_order_total,
  rate: props.shippingRate?.rate
})
</script>

<template>
  <Head :title="__('Edit :label', { label: __('Shipping Rate') })" />

  <AdminDashboardLayout>
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb
          to="admin.shipping-rates.index"
          icon="fa-circle-dollar-to-slot"
          label="Shipping Rates"
        >
          <BreadcrumbItem :label="shippingRate.id" />
          <BreadcrumbItem label="Edit" />
        </Breadcrumb>

        <div class="w-auto flex items-center justify-end">
          <GoBackButton />
        </div>
      </div>

      <!-- Form Start -->
      <div class="border p-10 bg-white rounded-md">
        <form
          @submit.prevent="
            editAction('Shipping Rate', 'admin.shipping-rates.update', {
              shipping_rate: shippingRate?.id
            })
          "
          class="space-y-4 md:space-y-6"
        >
          <div>
            <InputLabel :label="__('Shipping Area')" required />

            <SelectBox
              name="shipping-area"
              :options="shippingAreas"
              v-model="form.shipping_area_id"
              :placeholder="__('Select an option')"
              required
              :selected="form.shipping_area_id"
            />

            <InputError :message="errors?.shipping_area_id" />
          </div>

          <div>
            <InputLabel :label="__('Shipping Method')" required />

            <SelectBox
              name="shipping-method"
              :options="shippingMethods"
              v-model="form.shipping_method_id"
              :placeholder="__('Select an option')"
              required
              :selected="form.shipping_method_id"
            />

            <InputError :message="errors?.shipping_method_id" />
          </div>

          <div>
            <InputLabel :label="__('Minimum Order Amount')" required />

            <InputField
              type="text"
              name="min-order-total"
              v-model="form.min_order_total"
              :placeholder="__('Enter :label', { label: __('Minimum Order Amount') })"
              required
            />

            <InputError :message="errors?.min_order_total" />
          </div>

          <div>
            <InputLabel :label="__('Maximum Order Amount')" required />

            <InputField
              type="text"
              name="max-order-total"
              v-model="form.max_order_total"
              :placeholder="__('Enter :label', { label: __('Maximum Order Amount') })"
              required
            />

            <InputError :message="errors?.max_order_total" />
          </div>

          <div>
            <InputLabel :label="__('Shipping Rate')" required />

            <InputField
              type="text"
              name="shipping-rate"
              v-model="form.rate"
              :placeholder="__('Enter :label', { label: __('Shipping Rate') })"
              required
            />

            <InputError :message="errors?.rate" />
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
