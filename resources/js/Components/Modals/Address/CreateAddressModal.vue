<script setup>
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import SelectBox from '@/Components/Forms/Fields/SelectBox.vue'
import Checkbox from '@/Components/Forms/Fields/Checkbox.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import { computed, onMounted, onUnmounted, ref, watch } from 'vue'
import { useForm, usePage } from '@inertiajs/vue3'
import { useReCaptcha } from 'vue-recaptcha-v3'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'
import { __ } from '@/Services/translations-inside-setup.js'

const props = defineProps({
  show: {
    type: Boolean,
    default: false
  },
  closeable: {
    type: Boolean,
    default: true
  },
  regions: Object,
  cities: Object,
  townships: Object
})

const emit = defineEmits(['close'])

watch(
  () => props.show,
  () => {
    if (props.show) {
      document.body.style.overflow = 'hidden'
    } else {
      document.body.style.overflow = null
    }
  }
)

const close = () => {
  if (props.closeable) {
    emit('close')
  }
}

const closeOnEscape = (e) => {
  if (e.key === 'Escape' && props.show) {
    close()
  }
}

onMounted(() => document.addEventListener('keydown', closeOnEscape))

onUnmounted(() => {
  document.removeEventListener('keydown', closeOnEscape)
  document.body.style.overflow = null
})

const regionId = ref(null)
const cityId = ref(null)
const townshipId = ref(null)

// const { form, processing, errors, createAction } = useResourceActions({
//   name: null,
//   phone: null,
//   email: null,
//   region: null,
//   city: null,
//   township: null,
//   postal_code: null,
//   address: null,
//   landmark: null,
//   is_default_billing: null,
//   is_default_delivery: null,
//   address_type: 'home'
// })

const form = useForm({
  name: null,
  phone: null,
  email: null,
  region: null,
  city: null,
  township: null,
  postal_code: null,
  address: null,
  landmark: null,
  is_default_billing: null,
  is_default_delivery: null,
  address_type: 'home',
  captcha_token: null
})

const { executeRecaptcha, recaptchaLoaded } = useReCaptcha()

const handleCreateAddress = async () => {
  await recaptchaLoaded()
  form.captcha_token = await executeRecaptcha('create_address')

  form.post(route('user.address-book.store'), {
    preserveState: true,
    preserveScroll: true,
    onSuccess: () => {
      close()
      const successMessage = usePage().props.flash.success
      if (successMessage) {
        toast.success(__(successMessage, { label: __('Address') }), {
          autoClose: 2000
        })
      }
    },
    onFinish: () => form.reset()
  })
}

const filteredCities = computed(() => {
  if (!regionId.value) {
    return []
  }

  return props.cities.filter((city) => Number(city.region_id) === Number(regionId.value))
})

const filteredTownships = computed(() => {
  if (!cityId.value) {
    return []
  }

  return props.townships.filter((township) => Number(township.city_id) === Number(cityId.value))
})

watch(regionId, (newRegionId) => {
  const region = props.regions.find((region) => region.id === Number(newRegionId))
  if (region) {
    form.region = region.name
  }
})

watch(cityId, (newCityId) => {
  const city = props.cities.find((city) => city.id === Number(newCityId))

  if (city) {
    form.city = city.name
  }
})

watch(townshipId, (newTownshipId) => {
  const township = props.townships.find((township) => township.id === Number(newTownshipId))

  if (township) {
    form.township = township.name
  }
})
</script>

<template>
  <Teleport to="body">
    <Transition leave-active-class="duration-200">
      <div v-show="show" class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50" scroll-region>
        <Transition
          enter-active-class="ease-out duration-300"
          enter-from-class="opacity-0"
          enter-to-class="opacity-100"
          leave-active-class="ease-in duration-200"
          leave-from-class="opacity-100"
          leave-to-class="opacity-0"
        >
          <div v-show="show" class="fixed inset-0 transform transition-all" @click="close">
            <div class="absolute inset-0 bg-gray-500 opacity-75" />
          </div>
        </Transition>

        <Transition
          enter-active-class="ease-out duration-300"
          enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          enter-to-class="opacity-100 translate-y-0 sm:scale-100"
          leave-active-class="ease-in duration-200"
          leave-from-class="opacity-100 translate-y-0 sm:scale-100"
          leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        >
          <div
            v-show="show"
            class="mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-4xl mx-auto"
          >
            <div class="flex flex-col bg-white border shadow-sm rounded-xl">
              <div class="flex justify-between items-center py-3 px-4 border-b">
                <h3 class="font-bold text-gray-800">{{ __('Add New Delivery Address') }}</h3>

                <button
                  @click="close"
                  type="button"
                  class="flex justify-center items-center w-7 h-7 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none"
                >
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
                <form @submit.prevent="handleCreateAddress" class="space-y-6">
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

                        <InputError :message="form.errors?.name" />
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

                        <InputError :message="form.errors?.email" />
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

                        <InputError :message="form.errors?.phone" />
                      </div>

                      <div>
                        <InputLabel :label="__('Region')" required />

                        <SelectBox
                          name="region"
                          :options="regions"
                          v-model="regionId"
                          :placeholder="__('Select an option')"
                          icon="fa-map-location-dot"
                          required
                        />

                        <InputError :message="form.errors?.region" />
                      </div>

                      <div>
                        <InputLabel :label="__('City')" required />

                        <SelectBox
                          name="city"
                          :options="filteredCities"
                          v-model="cityId"
                          :placeholder="__('Select an option')"
                          icon="fa-city"
                          required
                          :disabled="!regionId"
                        />

                        <InputError :message="form.errors?.city" />
                      </div>

                      <div>
                        <InputLabel :label="__('Township')" required />

                        <SelectBox
                          name="township"
                          :options="filteredTownships"
                          v-model="townshipId"
                          icon="fa-building"
                          :placeholder="__('Select an option')"
                          required
                          :disabled="(!cityId && !regionId) || (regionId && !cityId)"
                        />

                        <InputError :message="form.errors?.township" />
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

                        <InputError :message="form.errors?.address" />
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

                        <InputError :message="form.errors?.landmark" />
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

                        <InputError :message="form.errors?.postal_code" />
                      </div>

                      <div>
                        <p class="text-xs text-main-gray mb-3">
                          Select a label for effective delivery:
                        </p>
                        <ul class="flex items-center space-x-3">
                          <li
                            class="inline-flex items-center gap-x-2.5 py-3 px-4 font-medium bg-white border text-gray-800 rounded-md"
                          >
                            <div class="relative flex items-start w-full">
                              <div class="flex items-center h-5">
                                <input
                                  id="hs-horizontal-list-group-item-radio-1"
                                  name="hs-horizontal-list-group-item-radio"
                                  type="radio"
                                  value="home"
                                  class="border-gray-200 rounded-full focus:ring-orange-600 text-orange-600"
                                  :checked="form.address_type === 'home'"
                                  v-model="form.address_type"
                                />
                              </div>
                              <label
                                for="hs-horizontal-list-group-item-radio-1"
                                class="ms-3 block w-full text-sm font-semibold text-gray-700"
                              >
                                Home
                              </label>
                            </div>
                          </li>

                          <li
                            class="inline-flex items-center gap-x-2.5 py-3 px-4 text-sm font-medium bg-white border text-gray-800 rounded-md"
                          >
                            <div class="relative flex items-start w-full">
                              <div class="flex items-center h-5">
                                <input
                                  id="hs-horizontal-list-group-item-radio-3"
                                  name="hs-horizontal-list-group-item-radio"
                                  type="radio"
                                  value="office"
                                  class="border-gray-200 rounded-full focus:ring-orange-600 text-orange-600"
                                  v-model="form.address_type"
                                  :checked="form.address_type === 'office'"
                                />
                              </div>
                              <label
                                for="hs-horizontal-list-group-item-radio-3"
                                class="ms-3 block w-full text-sm font-semibold text-gray-700"
                              >
                                Office
                              </label>
                            </div>
                          </li>
                        </ul>
                        <InputError :message="form.errors?.address_type" />
                      </div>

                      <div>
                        <p class="text-xs text-main-gray mb-3">Default Address ( Optional )</p>

                        <div
                          class="flex flex-col items-start space-y-4 border p-3 rounded-md shadow-sm"
                        >
                          <div class="flex items-center space-x-2">
                            <Checkbox v-model="form.is_default_billing" />
                            <label
                              for="inline-checkbox"
                              class="text-xs font-semibold text-main-gray"
                              >Default Billing Address</label
                            >
                          </div>
                          <div class="flex items-center space-x-2">
                            <Checkbox v-model="form.is_default_delivery" />
                            <label
                              for="inline-2-checkbox"
                              class="text-xs font-semibold text-main-gray"
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

                  <FormButton :processing="form.processing"> Save </FormButton>
                </form>
              </div>
            </div>
          </div>
        </Transition>
      </div>
    </Transition>
  </Teleport>
</template>
