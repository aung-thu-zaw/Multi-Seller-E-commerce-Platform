<script setup>
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import TextAreaField from '@/Components/Forms/Fields/TextAreaField.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import { useResourceActions } from '@/Composables/useResourceActions'

const props = defineProps({ store: Object, businessInformation: Object })

const { form, processing, errors, editAction } = useResourceActions({
  contact_email: props.businessInformation?.contact_email,
  contact_phone: props.businessInformation?.contact_phone,
  business_name: props.businessInformation?.business_name,
  business_registration_number: props.businessInformation?.business_registration_number,
  tax_number: props.businessInformation?.tax_number,
  industry: props.businessInformation?.industry,
  website: props.businessInformation?.website,
  address: props.businessInformation?.address,
  business_description: props.businessInformation?.business_description,
  products_or_services: props.businessInformation?.products_or_services,
  additional_information: props.businessInformation?.additional_information
})
</script>

<template>
  <!-- Form Start -->
  <div class="border p-10 bg-white rounded-md">
    <form
      @submit.prevent="
        editAction(
          'Business Information',
          'seller.store-settings.update-business-information',
          {
            business_information_id: businessInformation?.id
          },
          'patch'
        )
      "
      class="space-y-4 md:space-y-6"
    >
      <div>
        <InputLabel :label="__('Business Name')" required />

        <InputField
          type="text"
          name="business-name"
          icon="fa-store"
          v-model="form.business_name"
          :placeholder="__('Enter :label', { label: __('Business Name') })"
          required
        />

        <InputError :message="errors?.business_name" />
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
          <InputLabel :label="__('Business Registration Number')" required />

          <InputField
            type="text"
            name="business-registration-number"
            icon="fa-store"
            v-model="form.business_registration_number"
            :placeholder="__('Enter :label', { label: __('Business Registration Number') })"
            required
          />

          <InputError :message="errors?.business_registration_number" />
        </div>

        <div>
          <InputLabel :label="__('Tax Number')" required />

          <InputField
            type="text"
            name="tax-number"
            icon="fa-store"
            v-model="form.tax_number"
            :placeholder="__('Enter :label', { label: __('Tax Number') })"
            required
          />

          <InputError :message="errors?.tax_number" />
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <div>
          <InputLabel :label="__('Product Or Services')" required />

          <InputField
            type="text"
            name="product-or-services"
            icon="fa-store"
            v-model="form.products_or_services"
            :placeholder="__('Enter :label', { label: __('Product Or Services') })"
            required
          />

          <InputError :message="errors?.products_or_services" />
        </div>

        <div>
          <InputLabel :label="__('Industry')" required />

          <InputField
            type="text"
            name="industry"
            icon="fa-store"
            v-model="form.industry"
            :placeholder="__('Enter :label', { label: __('Industry') })"
            required
          />

          <InputError :message="errors?.industry" />
        </div>

        <div>
          <InputLabel :label="__('Website')" required />

          <InputField
            type="text"
            name="website"
            icon="fa-store"
            v-model="form.website"
            :placeholder="__('Enter :label', { label: __('Website') })"
            required
          />

          <InputError :message="errors?.website" />
        </div>
      </div>

      <div>
        <InputLabel :label="__('Business Description')" />

        <TextAreaField
          name="business-description"
          v-model="form.business_description"
          :placeholder="__('Enter :label', { label: __('Business Description') })"
        />

        <InputError :message="errors?.business_description" />
      </div>

      <div class="grid grid-cols-2 gap-5">
        <div>
          <InputLabel :label="__('Email Address')" required />

          <InputField
            type="email"
            name="business-email"
            icon="fa-envelope"
            v-model="form.contact_email"
            :placeholder="__('Enter :label', { label: __('Email Address') })"
            required
          />

          <InputError :message="errors?.contact_email" />
        </div>

        <div>
          <InputLabel :label="__('Phone Number')" required />

          <InputField
            type="text"
            name="business-phone"
            icon="fa-phone"
            v-model="form.contact_phone"
            :placeholder="__('Enter :label', { label: __('Phone Number') })"
            required
          />

          <InputError :message="errors?.contact_phone" />
        </div>
      </div>

      <div>
        <InputLabel :label="__('Address')" required />

        <InputField
          type="text"
          name="business-address"
          icon="fa-location-dot"
          v-model="form.address"
          :placeholder="__('Enter :label', { label: __('Business Address') })"
          required
        />

        <InputError :message="errors?.address" />
      </div>

      <div>
        <InputLabel :label="__('Additional Information')" />

        <TextAreaField
          name="additional-information"
          v-model="form.additional_information"
          :placeholder="__('Enter :label', { label: __('Additional Information') })"
        />

        <InputError :message="errors?.additional_information" />
      </div>

      <InputError :message="errors?.captcha_token" />

      <FormButton :processing="processing">
        {{ __('Submit') }}
      </FormButton>
    </form>
  </div>
  <!-- Form End -->
</template>
