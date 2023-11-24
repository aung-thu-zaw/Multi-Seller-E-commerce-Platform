<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import TextAreaField from '@/Components/Forms/Fields/TextAreaField.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import { Head } from '@inertiajs/vue3'
</script>

<template>
  <Head :title="__('Contact us')" />

  <AppLayout>
    <!-- Contact Us -->
    <div class="max-w-[85rem] px-14 py-14 mx-auto">
      <div class="text-center">
        <h1 class="text-2xl font-bold mb-3">{{ __('Contact us') }}</h1>
        <p class="mt-1 text-gray-600">{{ __("We'd love to talk about how we can help you.") }}</p>
      </div>

      <div class="mt-12 grid items-center lg:grid-cols-2 gap-6 lg:gap-16">
        <!-- Card -->
        <div class="flex flex-col border rounded-xl p-4 sm:p-6 lg:p-8">
          <h2 class="mb-8 text-xl font-semibold text-gray-800">{{ __('Fill in the form') }}</h2>

          <form class="space-y-4 md:space-y-6">
            <div>
              <InputLabel :label="__('Name')" required />

              <InputField
                type="text"
                name="contact-name"
                :placeholder="__('Enter :label', { label: __('Your Full Name') })"
                autofocus
                required
              />

              <!-- <InputError message="" /> -->
            </div>

            <div class="grid grid-cols-2 gap-3">
              <div>
                <InputLabel :label="__('Email Address')" required />

                <InputField
                  type="email"
                  name="contact-email"
                  :placeholder="__('Enter :label', { label: __('Your Email Address') })"
                  required
                />

                <!-- <InputError message="" /> -->
              </div>

              <div>
                <InputLabel :label="__('Phone Number')" required />

                <InputField
                  type="number"
                  name="contact-phone"
                  :placeholder="__('Enter :label', { label: __('Your Phone Number') })"
                  required
                />

                <!-- <InputError message="" /> -->
              </div>
            </div>

            <div>
              <InputLabel :label="__('Messages')" required />

              <TextAreaField
                name="contact-detail"
                :placeholder="__('Enter :label', { label: __('Messages') })"
                required
              />

              <!-- <InputError message="" /> -->
            </div>

            <!-- <InputError :message="errors?.captcha_token" /> -->

            <FormButton type="submit" :processing="processing">
              <i class="fa-solid fa-paper-plane"></i>
              {{ __('Send') }}
            </FormButton>

            <div class="mt-3 text-center">
              <p class="text-sm text-gray-500">We'll get back to you in 1-2 business days.</p>
            </div>
          </form>
        </div>
        <!-- End Card -->

        <div class="divide-y divide-gray-200">
          <!-- Icon Block -->
          <div class="flex gap-x-7 py-6">
            <svg
              class="flex-shrink-0 w-6 h-6 mt-1.5 text-gray-800"
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
              <circle cx="12" cy="12" r="10" />
              <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
              <path d="M12 17h.01" />
            </svg>
            <div class="grow">
              <h3 class="font-semibold text-gray-800">{{ __('Help Center') }}</h3>
              <p class="mt-1 text-sm text-gray-500">
                "{{
                  __(
                    "Got a question about your purchase or need some guidance? We're here to help!"
                  )
                }}"
              </p>
              <a
                class="mt-2 inline-flex items-center gap-x-2 text-sm font-medium text-gray-600 hover:text-orange-600"
                href="#"
              >
                {{ __('Go To Help Center') }}
                <svg
                  class="flex-shrink-0 w-2.5 h-2.5 transition ease-in-out group-hover:translate-x-1"
                  width="16"
                  height="16"
                  viewBox="0 0 16 16"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M0.975821 6.92249C0.43689 6.92249 -3.50468e-07 7.34222 -3.27835e-07 7.85999C-3.05203e-07 8.37775 0.43689 8.79749 0.975821 8.79749L12.7694 8.79748L7.60447 13.7596C7.22339 14.1257 7.22339 14.7193 7.60447 15.0854C7.98555 15.4515 8.60341 15.4515 8.98449 15.0854L15.6427 8.68862C16.1191 8.23098 16.1191 7.48899 15.6427 7.03134L8.98449 0.634573C8.60341 0.268455 7.98555 0.268456 7.60447 0.634573C7.22339 1.00069 7.22339 1.59428 7.60447 1.9604L12.7694 6.92248L0.975821 6.92249Z"
                    fill="currentColor"
                  />
                </svg>
              </a>
            </div>
          </div>
          <!-- End Icon Block -->

          <!-- Icon Block -->
          <div class="flex gap-x-7 py-6">
            <svg
              class="flex-shrink-0 w-6 h-6 mt-1.5 text-gray-800"
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
              <path d="M14 9a2 2 0 0 1-2 2H6l-4 4V4c0-1.1.9-2 2-2h8a2 2 0 0 1 2 2v5Z" />
              <path d="M18 9h2a2 2 0 0 1 2 2v11l-4-4h-6a2 2 0 0 1-2-2v-1" />
            </svg>
            <div class="grow">
              <h3 class="font-semibold text-gray-800">{{ __('FAQs') }}</h3>
              <p class="mt-1 text-sm text-gray-500">
                "{{
                  __(
                    'Find answers to common questions about shopping, orders, and more in our FAQ.'
                  )
                }}"
              </p>
              <a
                class="mt-2 inline-flex items-center gap-x-2 text-sm font-medium text-gray-600 hover:text-orange-600"
                href="#"
              >
                {{ __('Visit FAQ') }}
                <svg
                  class="flex-shrink-0 w-2.5 h-2.5 transition ease-in-out group-hover:translate-x-1"
                  width="16"
                  height="16"
                  viewBox="0 0 16 16"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M0.975821 6.92249C0.43689 6.92249 -3.50468e-07 7.34222 -3.27835e-07 7.85999C-3.05203e-07 8.37775 0.43689 8.79749 0.975821 8.79749L12.7694 8.79748L7.60447 13.7596C7.22339 14.1257 7.22339 14.7193 7.60447 15.0854C7.98555 15.4515 8.60341 15.4515 8.98449 15.0854L15.6427 8.68862C16.1191 8.23098 16.1191 7.48899 15.6427 7.03134L8.98449 0.634573C8.60341 0.268455 7.98555 0.268456 7.60447 0.634573C7.22339 1.00069 7.22339 1.59428 7.60447 1.9604L12.7694 6.92248L0.975821 6.92249Z"
                    fill="currentColor"
                  />
                </svg>
              </a>
            </div>
          </div>
          <!-- End Icon Block -->

          <!-- Icon Block -->
          <div class="flex gap-x-7 py-6">
            <svg
              class="flex-shrink-0 w-6 h-6 mt-1.5 text-gray-800"
              xmlns="http://www.w3.org/2000/svg"
              x="0px"
              y="0px"
              width="100"
              height="100"
              stroke-width="2"
              viewBox="0 0 50 50"
            >
              <path
                d="M 14 3.9902344 C 8.4886661 3.9902344 4 8.4789008 4 13.990234 L 4 35.990234 C 4 41.501568 8.4886661 45.990234 14 45.990234 L 36 45.990234 C 41.511334 45.990234 46 41.501568 46 35.990234 L 46 13.990234 C 46 8.4789008 41.511334 3.9902344 36 3.9902344 L 14 3.9902344 z M 14 5.9902344 L 36 5.9902344 C 40.430666 5.9902344 44 9.5595687 44 13.990234 L 44 35.990234 C 44 40.4209 40.430666 43.990234 36 43.990234 L 14 43.990234 C 9.5693339 43.990234 6 40.4209 6 35.990234 L 6 13.990234 C 6 9.5595687 9.5693339 5.9902344 14 5.9902344 z M 18.048828 11.035156 C 16.003504 10.946776 14.45113 11.723922 13.474609 12.658203 C 12.986349 13.125343 12.633832 13.625179 12.392578 14.091797 C 12.151324 14.558415 11.998047 14.943108 11.998047 15.443359 C 11.998047 15.398799 11.987059 15.632684 11.980469 15.904297 C 11.973869 16.17591 11.97507 16.542045 12 16.984375 C 12.04996 17.869036 12.199897 19.065677 12.597656 20.484375 C 13.393174 23.321771 15.184446 27.043821 19.070312 30.929688 C 22.95618 34.815554 26.678014 36.606575 29.515625 37.402344 C 30.93443 37.800228 32.130881 37.949937 33.015625 38 C 33.457997 38.02503 33.822105 38.026091 34.09375 38.019531 C 34.365395 38.012931 34.601049 38.001953 34.556641 38.001953 C 35.056892 38.001953 35.441585 37.848676 35.908203 37.607422 C 36.374821 37.366168 36.874657 37.013651 37.341797 36.525391 C 38.276078 35.54887 39.053222 33.996496 38.964844 31.951172 C 38.922907 30.975693 38.381316 30.111858 37.582031 29.599609 C 36.96435 29.203814 36.005458 28.589415 34.753906 27.789062 C 33.301811 26.861299 31.44451 26.795029 29.929688 27.625 L 30.015625 27.582031 L 28.837891 28.087891 L 28.751953 28.148438 C 28.465693 28.349428 28.111154 28.386664 27.789062 28.251953 C 26.886813 27.874649 25.480985 27.133329 24.173828 25.826172 C 22.866671 24.519015 22.125351 23.113186 21.748047 22.210938 C 21.613336 21.888845 21.650568 21.534307 21.851562 21.248047 L 21.912109 21.162109 L 22.417969 19.984375 L 22.375 20.070312 C 23.204764 18.555868 23.140248 16.698619 22.210938 15.246094 C 21.410584 13.994542 20.796186 13.03565 20.400391 12.417969 C 19.888142 11.618684 19.02431 11.077096 18.048828 11.035156 z M 17.962891 13.033203 C 18.243409 13.045263 18.533045 13.209378 18.716797 13.496094 C 19.113001 14.114413 19.727696 15.07377 20.527344 16.324219 C 21.058033 17.153694 21.09533 18.243821 20.621094 19.109375 L 20.597656 19.152344 L 20.115234 20.279297 L 20.214844 20.097656 C 19.623835 20.939396 19.505055 22.032514 19.902344 22.982422 C 20.35304 24.060173 21.214923 25.695392 22.759766 27.240234 C 24.304608 28.785077 25.939827 29.64696 27.017578 30.097656 C 27.967486 30.494945 29.060604 30.376165 29.902344 29.785156 L 29.720703 29.884766 L 30.847656 29.402344 L 30.890625 29.378906 C 31.755801 28.904877 32.845877 28.944375 33.675781 29.474609 L 33.675781 29.472656 C 34.92623 30.272304 35.885587 30.886999 36.503906 31.283203 C 36.790622 31.466955 36.954736 31.756591 36.966797 32.037109 C 37.032417 33.555785 36.504954 34.506599 35.896484 35.142578 C 35.59225 35.460568 35.262335 35.691348 34.990234 35.832031 C 34.718133 35.972715 34.457889 36.001953 34.556641 36.001953 C 34.373232 36.001953 34.276633 36.013981 34.046875 36.019531 C 33.817117 36.025131 33.509144 36.025436 33.128906 36.003906 C 32.368431 35.960876 31.318757 35.831053 30.054688 35.476562 C 27.526547 34.767581 24.137509 33.168759 20.484375 29.515625 C 16.831241 25.862491 15.232169 22.473167 14.523438 19.945312 C 14.169071 18.681386 14.039037 17.631464 13.996094 16.871094 C 13.974624 16.490908 13.974899 16.18286 13.980469 15.953125 C 13.986069 15.72339 13.998047 15.626918 13.998047 15.443359 C 13.998047 15.542109 14.027287 15.281867 14.167969 15.009766 C 14.308652 14.737665 14.539432 14.40775 14.857422 14.103516 C 15.493401 13.495046 16.444215 12.967581 17.962891 13.033203 z"
              ></path>
            </svg>
            <div class="grow">
              <h3 class="font-semibold text-gray-800">{{ __('Contact us by phone') }}</h3>
              <p class="mt-1 text-sm text-gray-500">
                "{{ __('Need assistance? Our team is just a call away.') }}"
              </p>
              <a
                class="mt-2 inline-flex items-center gap-x-2 text-sm font-medium text-gray-600 hover:text-gray-800"
                href="#"
              >
                +959 3765475930
              </a>
            </div>
          </div>
          <!-- End Icon Block -->

          <!-- Icon Block -->
          <div class="flex gap-x-7 py-6">
            <svg
              class="flex-shrink-0 w-6 h-6 mt-1.5 text-gray-800"
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
              <path
                d="M21.2 8.4c.5.38.8.97.8 1.6v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V10a2 2 0 0 1 .8-1.6l8-6a2 2 0 0 1 2.4 0l8 6Z"
              />
              <path d="m22 10-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 10" />
            </svg>
            <div class="grow">
              <h3 class="font-semibold text-gray-800">{{ __('Contact us by email') }}</h3>
              <p class="mt-1 text-sm text-gray-500">
                "{{
                  __(
                    "Have something to share? Send us an email, and we'll get back to you in a jiffy!"
                  )
                }}"
              </p>
              <a
                class="mt-2 inline-flex items-center gap-x-2 text-sm font-medium text-gray-600 hover:text-gray-800"
                href="#"
              >
                example@site.com
              </a>
            </div>
          </div>
          <!-- End Icon Block -->
        </div>
      </div>
    </div>
    <!-- End Contact Us -->
  </AppLayout>
</template>
