<script setup>
import InertiaLinkButton from '@/Components/Buttons/InertiaLinkButton.vue'
import NormalButton from '@/Components/Buttons/NormalButton.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import BrandCarousel from '@/Components/Carousels/BrandCarousel.vue'
import English from '@/assets/images/united-state.png'
import Myanmar from '@/assets/images/myanmar.png'
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <section id="newsletter" class="bg-gray-200 px-5 py-2">
    <div class="container max-w-screen-xl mx-auto rounded-md p-2 flex items-center justify-between">
      <!-- Newsletter -->
      <div class="flex items-center">
        <div class="flex items-center mr-10">
          <div
            class="flex mr-5 items-center justify-center rounded w-11 h-11 bg-white shadow-md border"
          >
            <i class="fa fa-envelope fa-lg text-orange-600"></i>
          </div>
          <div>
            <p class="font-semibold text-lg">{{ __('Subscribe') }}</p>
            <p class="text-xs font-medium text-gray-600">
              {{ __('Get notified on offers') }}
            </p>
          </div>
        </div>

        <form class="">
          <div
            class="flex items-center flex-row gap-3 bg-white border border-gray-300 rounded-lg p-2 w-[350px] shadow-sm"
          >
            <div class="w-full">
              <input
                type="text"
                id="hero-input"
                name="hero-input"
                class="py-3 px-4 block w-full border-none rounded-lg text-sm disabled:opacity-50 disabled:pointer-events-none focus:ring-0 focus:outline-none font-semibold text-gray-700"
                placeholder="Enter your email"
              />
            </div>
            <a
              class="w-full sm:w-auto whitespace-nowrap p-3 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-orange-600 text-white hover:bg-orange-700 disabled:opacity-50 disabled:pointer-events-none"
              href="#"
            >
              Subscribe
            </a>
          </div>
        </form>
      </div>

      <!-- Payments -->
      <div class="">
        <img
          src="../../assets/images/payments.png"
          alt=""
          class="h-8 object-contain object-center"
        />
      </div>
    </div>
  </section>
</template>
