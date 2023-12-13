<script setup>
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import TextAreaField from '@/Components/Forms/Fields/TextAreaField.vue'
import SelectBox from '@/Components/Forms/Fields/SelectBox.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import { usePage, Head, useForm } from '@inertiajs/vue3'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'
import { useReCaptcha } from 'vue-recaptcha-v3'
import { __ } from '@/Services/translations-inside-setup.js'

const form = useForm({
  store_name: null,
  store_type: null,
  contact_email: null,
  contact_phone: null,
  address: null,
  additional_information: null,
  captcha_token: null
})

const { executeRecaptcha, recaptchaLoaded } = useReCaptcha()

const handleRequestSellerStore = async () => {
  await recaptchaLoaded()
  form.captcha_token = await executeRecaptcha('request_become_a_seller')

  form.post(route('become-a-seller.store'), {
    preserveState: true,
    preserveScroll: true,
    onSuccess: () => {
      form.reset()

      const successMessage = usePage().props.flash.success
      toast.success(__(successMessage), {
        autoClose: 2000
      })
    }
  })
}
</script>

<template>
  <Head :title="__('Become a Seller')" />

  <AppLayout>
    <section id="become-a-seller" class="">
      <div class="bg-orange-600">
        <div class="w-[1280px] mx-auto flex items-start justify-between py-14 space-x-5">
          <div class="w-1/2 flex flex-col items-start justify-center space-y-5">
            <h1 class="font-bold text-5xl text-white">Sell On Our E-commerce Platform</h1>

            <p class="font-semibold text-lg text-white">
              {{
                __(
                  'Create a Shop seller account in 5 minutes and reach millions of customers today!'
                )
              }}
            </p>

            <img src="../../../assets/images/store-register.png" class="h-[500px] object-contain" />
          </div>
          <div class="w-1/2">
            <div class="bg-white p-10 rounded-md border border-gray-200">
              <form @submit.prevent="handleRequestSellerStore" class="space-y-4 md:space-y-6">
                <div class="grid grid-cols-2 gap-5">
                  <div>
                    <InputLabel :label="__('Store Name')" required />

                    <InputField
                      type="text"
                      name="store-name"
                      icon="fa-user"
                      v-model="form.store_name"
                      :placeholder="__('Enter :label', { label: __('Store Name') })"
                      required
                    />

                    <InputError :message="form.errors?.store_name" />
                  </div>

                  <div>
                    <InputLabel :label="__('Store Type')" required />

                    <SelectBox
                      name="store-type"
                      icon="fa-store"
                      :options="[
                        {
                          label: 'Personal',
                          value: 'personal'
                        },
                        {
                          label: 'Business',
                          value: 'business'
                        }
                      ]"
                      v-model="form.store_type"
                      :placeholder="__('Select an option')"
                      :selected="form.store_type"
                      required
                    />

                    <InputError :message="form.errors?.store_type" />
                  </div>

                  <div>
                    <InputLabel :label="__('Email Address')" required />

                    <InputField
                      type="email"
                      name="store-email"
                      icon="fa-envelope"
                      v-model="form.contact_email"
                      :placeholder="__('Enter :label', { label: __('Email Address') })"
                      required
                    />

                    <InputError :message="form.errors?.contact_email" />
                  </div>

                  <div>
                    <InputLabel :label="__('Phone Number')" required />

                    <InputField
                      type="text"
                      name="store-phone"
                      icon="fa-phone"
                      v-model="form.contact_phone"
                      :placeholder="__('Enter :label', { label: __('Phone Number') })"
                      required
                    />

                    <InputError :message="form.errors?.contact_phone" />
                  </div>
                </div>

                <div>
                  <InputLabel :label="__('Address')" />

                  <InputField
                    type="text"
                    name="store-address"
                    icon="fa-location-dot"
                    v-model="form.address"
                    :placeholder="__('Enter :label', { label: __('Store Address') })"
                  />

                  <InputError :message="form.errors?.address" />
                </div>

                <div>
                  <InputLabel :label="__('Additional Information')" />

                  <TextAreaField
                    name="additional-information"
                    v-model="form.additional_information"
                    :placeholder="__('Enter :label', { label: __('Additional Information') })"
                  />

                  <InputError :message="form.errors?.additional_information" />
                </div>

                <InputError :message="form.errors?.captcha_token" />

                <FormButton :processing="form.processing">
                  {{ __('Submit') }}
                </FormButton>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-white py-12">
        <div class="container max-w-screen-xl mx-auto px-4">
          <h2 class="text-3xl font-bold mb-8">{{ __('Why You Should Sell On Our Platform?') }}</h2>

          <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <div>
              <figure class="flex mb-4">
                <div class="flex-shrink-0 mr-3">
                  <span
                    class="w-16 h-16 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center"
                  >
                    <i class="fa fa-basket-shopping text-2xl"></i>
                  </span>
                </div>
                <figcaption>
                  <h5 class="font-semibold">Reach</h5>
                  <p class="text-gray-500">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                  </p>
                </figcaption>
              </figure>
            </div>
            <div>
              <figure class="flex mb-4">
                <div class="flex-shrink-0 mr-3">
                  <span
                    class="w-16 h-16 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center"
                  >
                    <i class="fa fa-address-card text-2xl"></i>
                  </span>
                </div>
                <figcaption>
                  <h5 class="font-semibold">Free Registration</h5>
                  <p class="text-gray-500">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                  </p>
                </figcaption>
              </figure>
            </div>
            <div>
              <figure class="flex mb-4">
                <div class="flex-shrink-0 mr-3">
                  <span
                    class="w-16 h-16 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center"
                  >
                    <i class="fa fa-truck text-2xl"></i>
                  </span>
                </div>
                <figcaption>
                  <h5 class="font-semibold">Reliable Shipping</h5>
                  <p class="text-gray-500">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                  </p>
                </figcaption>
              </figure>
            </div>
            <div>
              <figure class="flex mb-4">
                <div class="flex-shrink-0 mr-3">
                  <span
                    class="w-16 h-16 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center"
                  >
                    <i class="fa fa-headset text-2xl"></i>
                  </span>
                </div>
                <figcaption>
                  <h5 class="font-semibold">Support & Training</h5>
                  <p class="text-gray-500">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                  </p>
                </figcaption>
              </figure>
            </div>
            <div>
              <figure class="flex mb-4">
                <div class="flex-shrink-0 mr-3">
                  <span
                    class="w-16 h-16 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center"
                  >
                    <i class="fa fa-wrench text-2xl"></i>
                  </span>
                </div>
                <figcaption>
                  <h5 class="font-semibold">Marketing Tools</h5>
                  <p class="text-gray-500">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                  </p>
                </figcaption>
              </figure>
            </div>
            <div>
              <figure class="flex mb-4">
                <div class="flex-shrink-0 mr-3">
                  <span
                    class="w-16 h-16 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center"
                  >
                    <i class="fa fa-credit-card text-2xl"></i>
                  </span>
                </div>
                <figcaption>
                  <h5 class="font-semibold">Timely Payments</h5>
                  <p class="text-gray-500">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                  </p>
                </figcaption>
              </figure>
            </div>
          </div>
        </div>
      </div>
    </section>
  </AppLayout>
</template>
