<script setup>
import SellerDashboardLayout from '@/Layouts/SellerDashboardLayout.vue'
import Breadcrumb from '@/Components/Breadcrumbs/Breadcrumb.vue'
import StoreInformation from './Partials/StoreInformation.vue'
import BusinessInformation from './Partials/BusinessInformation.vue'
import BankAccount from './Partials/BankAccount.vue'
import { Head } from '@inertiajs/vue3'
</script>


<template>
  <Head :title="__('Store Settings')" />

  <SellerDashboardLayout>
    <!-- Breadcrumb And Trash Button  -->
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb to="seller.store-settings.index" icon="fa-gears" label="Store Settings" />
      </div>

      <div class="w-full">
        <div class="border-b border-gray-300 flex items-center justify-between">
          <nav class="flex space-x-5" aria-label="Tabs" role="tablist">
            <button
              type="button"
              class="hs-tab-active:font-semibold hs-tab-active:border-orange-600 hs-tab-active:text-orange-600 py-4 px-1 inline-flex items-center gap-x-1.5 border-b-2 border-transparent text-sm font-medium whitespace-nowrap text-gray-600 hover:text-orange-600"
              id="store-information"
              data-hs-tab="#tabs-with-icons-1"
              aria-controls="tabs-with-icons-1"
              role="tab"
            >
              Store Information
            </button>
            <button
              type="button"
              class="hs-tab-active:font-semibold hs-tab-active:border-orange-600 hs-tab-active:text-orange-600 py-4 px-1 inline-flex items-center gap-x-1.5 border-b-2 border-transparent text-sm font-medium whitespace-nowrap text-gray-600 hover:text-orange-600"
              id="seller-information"
              data-hs-tab="#tabs-with-icons-2"
              aria-controls="tabs-with-icons-2"
              role="tab"
            >
              Business Information
            </button>
            <button
              type="button"
              class="hs-tab-active:font-semibold hs-tab-active:border-orange-600 hs-tab-active:text-orange-600 py-4 px-1 inline-flex items-center gap-x-1.5 border-b-2 border-transparent text-sm font-medium whitespace-nowrap text-gray-600 hover:text-orange-600"
              id="bank-account"
              data-hs-tab="#tabs-with-icons-3"
              aria-controls="tabs-with-icons-3"
              role="tab"
            >
              Bank Account
            </button>
          </nav>
        </div>

        <div class="mt-3">
          <div id="tabs-with-icons-1" role="tabpanel" aria-labelledby="store-information">
            <StoreInformation />
          </div>

          <div
            id="tabs-with-icons-2"
            class="hidden"
            role="tabpanel"
            aria-labelledby="seller-information"
          >
            <BusinessInformation />
          </div>

          <div id="tabs-with-icons-3" class="hidden" role="tabpanel" aria-labelledby="bank-account">
            <BankAccount />
          </div>
        </div>
      </div>
    </div>
  </SellerDashboardLayout>
</template>
