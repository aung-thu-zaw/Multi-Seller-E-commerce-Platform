<script setup>
import SellerDashboardLayout from '@/Layouts/SellerDashboardLayout.vue'
import Breadcrumb from '@/Components/Breadcrumbs/Breadcrumb.vue'
import BreadcrumbItem from '@/Components/Breadcrumbs/BreadcrumbItem.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import GoBackButton from '@/Components/Buttons/GoBackButton.vue'
import { useResourceActions } from '@/Composables/useResourceActions'
import { Head } from '@inertiajs/vue3'
import { useFormatFunctions } from '@/Composables/useFormatFunctions'

defineProps({ sellerBalance: Object })

const { formatAmount } = useFormatFunctions()

const { form, processing, errors, createAction } = useResourceActions({
  amount: null
})
</script>

<template>
  <Head :title="__('Create :label', { label: __('Payout Request') })" />

  <SellerDashboardLayout>
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb
          to="seller.payout-requests.index"
          icon="fa-money-bill-transfer"
          label="Payout Requests"
        >
          <BreadcrumbItem label="Create" />
        </Breadcrumb>

        <div class="w-auto flex items-center justify-end">
          <GoBackButton />
        </div>
      </div>

      <!-- Form Start -->
      <div class="border p-10 bg-white rounded-md">
        <form
          @submit.prevent="createAction('Payout Request', 'seller.payout-requests.store')"
          class="space-y-4 md:space-y-6"
        >
          <div>
            <InputLabel :label="__('Amount')" required />

            <InputField
              type="text"
              name="payout-amount"
              v-model="form.amount"
              :placeholder="__('Enter :label', { label: __('Amount') })"
              autofocus
              required
              :disabled="sellerBalance?.balance <= 0"
            />

            <InputError :message="errors?.amount" />
            <span class="text-xs text-gray-700 font-bold">
              {{
                __('Your current balance is :label', {
                  label: sellerBalance?.balance ? formatAmount(sellerBalance?.balance) : 0
                })
              }}
            </span>
          </div>

          <InputError :message="errors?.captcha_token" />

          <FormButton :processing="processing">
            {{ __('Create') }}
          </FormButton>
        </form>
      </div>
      <!-- Form End -->
    </div>
  </SellerDashboardLayout>
</template>
