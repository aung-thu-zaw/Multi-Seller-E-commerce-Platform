<script setup>
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import SelectBox from '@/Components/Forms/Fields/SelectBox.vue'
import Checkbox from '@/Components/Forms/Fields/Checkbox.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import { useResourceActions } from '@/Composables/useResourceActions'

const props = defineProps({ address: Object, regions: Object, cities: Object, townships: Object })

const { form, processing, errors, editAction } = useResourceActions({
  name: props.address?.name,
  phone: props.address?.phone,
  email: props.address?.email,
  region: props.address?.region,
  city: props.address?.city,
  township: props.address?.township,
  postal_code: props.address?.postal_code,
  address: props.address?.address,
  landmark: props.address?.landmark,
  is_default_billing: props.address?.is_default_billing,
  is_default_delivery: props.address?.is_default_delivery,
  address_type: props.address?.address_type
})
</script>

<template>
  <button
    data-hs-overlay="#hs-edit-modal"
    class="font-bold text-xs text-blue-600 hover:text-blue-500 duration-200"
  >
    <i class="fa-solid fa-edit"></i>
  </button>

  <div
    id="hs-edit-modal"
    class="hs-overlay hidden w-full h-full fixed top-0 start-0 z-[60] overflow-x-hidden overflow-y-auto"
  >
    <div
      class="hs-overlay-open:opacity-100 hs-overlay-open:duration-500 opacity-0 transition-all m-3 max-w-4xl mx-auto"
    >
      <div class="flex flex-col bg-white border shadow-sm rounded-xl">
        <div class="flex justify-between items-center py-3 px-4 border-b">
          <h3 class="font-bold text-gray-800">{{ __('Add New Delivery Address') }}</h3>

          <button
            type="button"
            class="flex justify-center items-center w-7 h-7 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none"
            data-hs-overlay="#hs-edit-modal"
          >
            <span class="sr-only">Close</span>
            <svg
              class="flex-shrink-0 w-4 h-4"
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <path d="M18 6 6 18" />
              <path d="m6 6 12 12" />
            </svg>
          </button>
        </div>

        <div class="p-6">
          <form @submit.prevent="" class="space-y-6">
            <div class="grid grid-cols-2 gap-5">
              <div class="space-y-4">
                <div>
                  <InputLabel :label="__('Name')" required />

                  <InputField
                    type="text"
                    name="name"
                    placeholder="Enter your full name"
                    icon="fa-user"
                    v-model="form.name"
                  />

                  <InputError :message="errors?.name" />
                </div>

                <div>
                  <InputLabel :label="__('Email Address')" required />

                  <InputField
                    type="email"
                    name="email-address"
                    placeholder="Enter your email address"
                    icon="fa-envelope"
                    v-model="form.email"
                  />

                  <InputError :message="errors?.email" />
                </div>

                <div>
                  <InputLabel :label="__('Phone')" required />

                  <InputField
                    type="text"
                    name="phone"
                    placeholder="Enter your phone number"
                    icon="fa-phone"
                    v-model="form.phone"
                  />

                  <InputError :message="errors?.phone" />
                </div>

                <div>
                  <InputLabel :label="__('Region')" required />

                  <SelectBox
                    name="region"
                    :options="regions"
                    v-model="form.region"
                    :placeholder="__('Select an option')"
                    icon="fa-map-location-dot"
                    required
                  />

                  <InputError :message="errors?.region" />
                </div>

                <div>
                  <InputLabel :label="__('City')" required />

                  <SelectBox
                    name="city"
                    :options="cities"
                    v-model="form.city"
                    :placeholder="__('Select an option')"
                    icon="fa-city"
                    required
                  />

                  <InputError :message="errors?.city" />
                </div>

                <div>
                  <InputLabel :label="__('Township')" />

                  <SelectBox
                    name="township"
                    :options="townships"
                    v-model="form.township"
                    icon="fa-building"
                    :placeholder="__('Select an option')"
                  />

                  <InputError :message="errors?.township" />
                </div>
              </div>

              <div class="space-y-4">
                <div>
                  <InputLabel :label="__('Address')" required />

                  <InputField
                    type="text"
                    name="address"
                    placeholder="Enter your address"
                    icon="fa-address-card"
                    v-model="form.address"
                  />

                  <InputError :message="errors?.address" />
                </div>

                <div>
                  <InputLabel :label="__('Landmark')" />

                  <InputField
                    type="text"
                    name="landmark"
                    placeholder="Enter Landmark (eg. Beside the clothes store)"
                    icon="fa-location-dot"
                    v-model="form.landmark"
                  />

                  <InputError :message="errors?.landmark" />
                </div>

                <div>
                  <InputLabel :label="__('Postal Code')" />

                  <InputField
                    type="text"
                    name="postal-code"
                    placeholder="Enter Postal Code"
                    icon="fa-envelope-open"
                    v-model="form.postal_code"
                  />

                  <InputError :message="errors?.postal_code" />
                </div>

                <div>
                  <p class="text-xs text-main-gray mb-3">Select a label for effective delivery:</p>
                  <div class="flex items-center space-x-5">
                    <div>
                      <input
                        type="radio"
                        id="home-delivery"
                        value="home"
                        class="hidden peer"
                        v-model="form.address_type"
                        required
                      />
                      <label
                        for="home-delivery"
                        class="inline-flex items-center justify-between w-full px-6 py-4 text-gray-600 bg-white border border-accent-light shadow-sm cursor-pointer peer-checked:border-orange-600 peer-checked:text-orange-600 hover:text-gray-600 hover:bg-gray-50 rounded-md"
                      >
                        <div class="block w-full text-xs font-semibold">
                          <i class="fa-solid fa-home"></i>
                          Home
                        </div>
                      </label>
                    </div>
                    <div>
                      <input
                        type="radio"
                        id="office-delivery"
                        value="office"
                        v-model="form.address_type"
                        class="hidden peer"
                      />
                      <label
                        for="office-delivery"
                        class="inline-flex items-center justify-between w-full px-6 py-4 text-gray-600 bg-white border border-accent-light shadow-sm cursor-pointer peer-checked:border-orange-600 peer-checked:text-orange-600 hover:text-gray-600 hover:bg-gray-50 rounded-md"
                      >
                        <div class="block w-full text-xs font-semibold">
                          <i class="fa-solid fa-building"></i>
                          Office
                        </div>
                      </label>
                    </div>
                  </div>
                  <InputError :message="errors?.address_type" />
                </div>

                <div>
                  <p class="text-xs text-main-gray mb-3">Default Address ( Optional )</p>

                  <div class="flex flex-col items-start space-y-4 border p-3 rounded-md shadow-sm">
                    <div class="flex items-center space-x-2">
                      <Checkbox v-model="form.is_default_billing" />
                      <label for="inline-checkbox" class="text-xs font-semibold text-main-gray"
                        >Default Billing Address</label
                      >
                    </div>
                    <div class="flex items-center space-x-2">
                      <Checkbox v-model="form.is_default_delivery" />
                      <label for="inline-2-checkbox" class="text-xs font-semibold text-main-gray"
                        >Default Delivery Address</label
                      >
                    </div>
                    <p class="text-xs text-main-gray mb-3">
                      Your existing default address setting will be replaced if you make some
                      changes here.
                    </p>
                  </div>
                </div>
              </div>
            </div>

            <FormButton type="submit"> Save </FormButton>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
