<script setup>
import SellerDashboardLayout from '@/Layouts/SellerDashboardLayout.vue'
import Breadcrumb from '@/Components/Breadcrumbs/Breadcrumb.vue'
import StoreInformation from './Partials/StoreInformation.vue'
import BusinessInformation from './Partials/BusinessInformation.vue'
import BankAccount from './Partials/BankAccount.vue'
import { Head, Link } from '@inertiajs/vue3'

defineProps({ businessInformation: Object, bankAccount: Object })
</script>

<template>
  <Head :title="__('Store Settings')" />

  <SellerDashboardLayout>
    <!-- Breadcrumb And Trash Button  -->
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb to="seller.store-settings.edit" icon="fa-gears" label="Store Settings" />
      </div>

      <div class="w-full">
        <div class="border-b border-gray-300 flex items-center justify-between">
          <nav class="flex space-x-5">
            <Link
              as="button"
              :href="route('seller.store-settings.edit')"
              :data="{ tab: 'store-information' }"
              preserve-scroll
              class="py-4 px-1 inline-flex items-center gap-x-1.5 text-sm font-medium whitespace-nowrap hover:text-blue-600 text-gray-600"
              :class="{
                'border-b-2 font-semibold border-blue-600 text-blue-600':
                  $page.props.ziggy.query?.tab === 'store-information' ||
                  !$page.props.ziggy.query?.tab
              }"
            >
              Store Information
            </Link>

            <Link
              as="button"
              :href="route('seller.store-settings.edit')"
              :data="{ tab: 'business-information' }"
              preserve-scroll
              class="py-4 px-1 inline-flex items-center gap-x-1.5 text-sm font-medium whitespace-nowrap hover:text-blue-600 text-gray-600"
              :class="{
                'border-b-2 font-semibold border-blue-600 text-blue-600':
                  $page.props.ziggy.query?.tab === 'business-information'
              }"
            >
              Business Information
            </Link>
            <Link
              as="button"
              :href="route('seller.store-settings.edit')"
              :data="{ tab: 'bank-account' }"
              preserve-scroll
              class="py-4 px-1 inline-flex items-center gap-x-1.5 text-sm font-medium whitespace-nowrap hover:text-blue-600 text-gray-600"
              :class="{
                'border-b-2 font-semibold border-blue-600 text-blue-600':
                  $page.props.ziggy.query?.tab === 'bank-account'
              }"
            >
              Bank Account
            </Link>
          </nav>
        </div>

        <div class="mt-3">
          <div
            v-show="
              $page.props.ziggy.query?.tab === 'store-information' || !$page.props.ziggy.query?.tab
            "
          >
            <StoreInformation />
          </div>

          <div v-show="$page.props.ziggy.query?.tab === 'business-information'">
            <BusinessInformation :businessInformation="businessInformation" />
          </div>

          <div v-show="$page.props.ziggy.query?.tab === 'bank-account'">
            <BankAccount :bankAccount="bankAccount" />
          </div>
        </div>
      </div>
    </div>
  </SellerDashboardLayout>
</template>
