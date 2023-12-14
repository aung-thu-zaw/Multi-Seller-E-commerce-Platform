<script setup>
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import SelectBox from '@/Components/Forms/Fields/SelectBox.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import { useResourceActions } from '@/Composables/useResourceActions'

const { form, processing, errors, editAction } = useResourceActions({
  account_title: null,
  account_number: null,
  bank_name: null,
  branch_code: null
})
</script>

<template>
  <!-- Form Start -->
  <div class="border p-10 bg-white rounded-md">
    <form @submit.prevent="editAction" class="space-y-4 md:space-y-6">
      <div>
        <InputLabel :label="__('Account Title')" required />

        <InputField
          type="text"
          name="account-title"
          icon="fa-file-lines"
          v-model="form.account_title"
          :placeholder="__('Enter :label', { label: __('Account Title') })"
          required
        />

        <InputError :message="errors?.account_title" />
      </div>

      <div>
        <InputLabel :label="__('Account Number')" required />

        <InputField
          type="text"
          name="account-number"
          icon="fa-hashtag"
          v-model="form.account_number"
          :placeholder="__('Enter :label', { label: __('Account Number') })"
          required
        />

        <InputError :message="errors?.account_number" />
      </div>

      <div>
        <InputLabel :label="__('Bank Name')" required />

        <SelectBox
          name="bank-name"
          icon="fa-bank"
          :options="[
            {
              label: 'KBZ Bank',
              value: 'kbz'
            },
            {
              label: 'AYA Bank',
              value: 'aya'
            },
            {
              label: 'CB Bank',
              value: 'cb'
            },
            {
              label: 'AGD Bank',
              value: 'agd'
            }
          ]"
          v-model="form.bank_name"
          :placeholder="__('Select an option')"
          :selected="form.bank_name"
          required
        />

        <InputError :message="errors?.bank_name" />
      </div>
      <div>
        <InputLabel :label="__('Branch Code')" />

        <InputField
          type="text"
          name="branch-code"
          icon="fa-bank"
          v-model="form.branch_code"
          :placeholder="__('Enter :label', { label: __('Branch Code') })"
        />

        <InputError :message="errors?.branch_code" />
      </div>

      <InputError :message="errors?.captcha_token" />

      <FormButton :processing="processing">
        {{ __('Submit') }}
      </FormButton>
    </form>
  </div>
  <!-- Form End -->
</template>
