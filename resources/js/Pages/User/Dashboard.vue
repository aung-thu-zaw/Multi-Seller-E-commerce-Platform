<script setup>
import PreviewImage from '@/Components/Forms/PreviewImage.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import SelectBox from '@/Components/Forms/Fields/SelectBox.vue'
import FileInput from '@/Components/Forms/Fields/FileInput.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import Datepicker from 'vue3-datepicker'
import { useImagePreview } from '@/Composables/useImagePreview'
import { useResourceActions } from '@/Composables/useResourceActions'
import AppLayout from '@/Layouts/AppLayout.vue'
import { Head, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

defineProps({ mustVerifyEmail: Boolean, status: String })
</script>

<template>
  <Head :title="'Aung Thu Zaw' + '\'s ' + __('Dashboard')" />

  <AppLayout>
    <section id="user-dashboard" class="py-10">
      <div class="w-[1280px] min-h-screen mx-auto flex items-start">
        <div class="w-[300px]">
          <h1 class="font-bold text-md text-orange-600 mb-5 px-5">Welcome, Aung Thu Zaw</h1>
          <nav
            class="flex flex-col space-y-2"
            aria-label="Tabs"
            role="tablist"
            data-hs-tabs-vertical="true"
          >
            <button
              type="button"
              class="hs-tab-active:border-orange-500 hs-tab-active:text-orange-600 py-1 pe-4 inline-flex items-center gap-x-2 border-s-2 px-5 border-transparent text-sm whitespace-nowrap font-semibold text-gray-600 hover:text-orange-600 focus:outline-none focus:text-orange-600 disabled:opacity-50 disabled:pointer-events-none"
              id="vertical-tab-with-border-item-2"
              data-hs-tab="#vertical-tab-with-border-2"
              aria-controls="vertical-tab-with-border-2"
              role="tab"
            >
              <i class="fa-solid fa-tv"></i>
              Dashboard
            </button>

            <button
              type="button"
              class="hs-tab-active:border-orange-500 hs-tab-active:text-orange-600 py-1 pe-4 inline-flex items-center gap-x-2 border-s-2 px-5 border-transparent text-sm whitespace-nowrap font-semibold text-gray-600 hover:text-orange-600 focus:outline-none focus:text-orange-600 disabled:opacity-50 disabled:pointer-events-none active"
              role="tab"
            >
              <i class="fa-regular fa-id-card"></i>
              My Account
            </button>

            <button
              type="button"
              class="hs-tab-active:border-orange-500 hs-tab-active:text-orange-600 py-1 pe-4 inline-flex items-center gap-x-2 border-s-2 px-5 border-transparent text-sm whitespace-nowrap font-semibold text-gray-600 hover:text-orange-600 focus:outline-none focus:text-orange-600 disabled:opacity-50 disabled:pointer-events-none active"
              role="tab"
            >
              <i class="fa-solid fa-lock"></i>
              Change Password
            </button>

            <button
              type="button"
              class="hs-tab-active:border-orange-500 hs-tab-active:text-orange-600 py-1 pe-4 inline-flex items-center gap-x-2 border-s-2 px-5 border-transparent text-sm whitespace-nowrap font-semibold text-gray-600 hover:text-orange-600 focus:outline-none focus:text-orange-600 disabled:opacity-50 disabled:pointer-events-none active"
              role="tab"
            >
              <i class="fa-solid fa-ban"></i>
              Delete Account
            </button>

            <button
              type="button"
              class="hs-tab-active:border-orange-500 hs-tab-active:text-orange-600 py-1 pe-4 inline-flex items-center gap-x-2 border-s-2 px-5 border-transparent text-sm whitespace-nowrap font-semibold text-gray-600 hover:text-orange-600 focus:outline-none focus:text-orange-600 disabled:opacity-50 disabled:pointer-events-none active"
              role="tab"
            >
              <i class="fa-solid fa-gear"></i>
              Notification Settings
            </button>

            <button
              type="button"
              class="hs-tab-active:border-orange-500 hs-tab-active:text-orange-600 py-1 pe-4 inline-flex items-center gap-x-2 border-s-2 px-5 border-transparent text-sm whitespace-nowrap font-semibold text-gray-600 hover:text-orange-600 focus:outline-none focus:text-orange-600 disabled:opacity-50 disabled:pointer-events-none"
              role="tab"
            >
              <i class="fa-solid fa-boxes-packing"></i>
              My Orders
            </button>

            <button
              type="button"
              class="hs-tab-active:border-orange-500 hs-tab-active:text-orange-600 py-1 pe-4 inline-flex items-center gap-x-2 border-s-2 px-5 border-transparent text-sm whitespace-nowrap font-semibold text-gray-600 hover:text-orange-600 focus:outline-none focus:text-orange-600 disabled:opacity-50 disabled:pointer-events-none"
              role="tab"
            >
              <i class="fa-solid fa-heart"></i>
              My Wishlist
            </button>

            <button
              type="button"
              class="hs-tab-active:border-orange-500 hs-tab-active:text-orange-600 py-1 pe-4 inline-flex items-center gap-x-2 border-s-2 px-5 border-transparent text-sm whitespace-nowrap font-semibold text-gray-600 hover:text-orange-600 focus:outline-none focus:text-orange-600 disabled:opacity-50 disabled:pointer-events-none"
              role="tab"
            >
              <i class="fa-solid fa-address-book"></i>
              Address Book
            </button>

            <button
              type="button"
              class="hs-tab-active:border-orange-500 hs-tab-active:text-orange-600 py-1 pe-4 inline-flex items-center gap-x-2 border-s-2 px-5 border-transparent text-sm whitespace-nowrap font-semibold text-gray-600 hover:text-orange-600 focus:outline-none focus:text-orange-600 disabled:opacity-50 disabled:pointer-events-none"
              role="tab"
            >
              <i class="fa-solid fa-store"></i>
              Followed Stores
            </button>

            <button
              type="button"
              class="hs-tab-active:border-orange-500 hs-tab-active:text-orange-600 py-1 pe-4 inline-flex items-center gap-x-2 border-s-2 px-5 border-transparent text-sm whitespace-nowrap font-semibold text-gray-600 hover:text-orange-600 focus:outline-none focus:text-orange-600 disabled:opacity-50 disabled:pointer-events-none"
              role="tab"
            >
              <i class="fa-solid fa-star"></i>
              My Reviews
            </button>

            <button
              type="button"
              class="hs-tab-active:border-orange-500 hs-tab-active:text-orange-600 py-1 pe-4 inline-flex items-center gap-x-2 border-s-2 px-5 border-transparent text-sm whitespace-nowrap font-semibold text-gray-600 hover:text-orange-600 focus:outline-none focus:text-orange-600 disabled:opacity-50 disabled:pointer-events-none"
              role="tab"
            >
              <i class="fa-solid fa-rotate-left"></i>
              My Returns & Cancellations
            </button>

            <button
              type="button"
              class="hs-tab-active:border-orange-500 hs-tab-active:text-orange-600 py-1 pe-4 inline-flex items-center gap-x-2 border-s-2 px-5 border-transparent text-sm whitespace-nowrap font-semibold text-gray-600 hover:text-orange-600 focus:outline-none focus:text-orange-600 disabled:opacity-50 disabled:pointer-events-none"
              role="tab"
            >
              <i class="fa-solid fa-user-check"></i>
              Become A Seller
            </button>

            <button
              type="button"
              class="hs-tab-active:border-orange-500 hs-tab-active:text-orange-600 py-1 pe-4 inline-flex items-center gap-x-2 border-s-2 px-5 border-transparent text-sm whitespace-nowrap font-semibold text-gray-600 hover:text-orange-600 focus:outline-none focus:text-orange-600 disabled:opacity-50 disabled:pointer-events-none"
              role="tab"
            >
              <i class="fa-solid fa-ticket"></i>
              Vouchers
            </button>
          </nav>
        </div>

        <div class="ms-6 w-full pt-10">
          <MyAccount />
        </div>
      </div>
    </section>
  </AppLayout>
</template>
