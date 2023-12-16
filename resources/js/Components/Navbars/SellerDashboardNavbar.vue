<script setup>
import GreenBadge from '@/Components/Badges/GreenBadge.vue'
import RedBadge from '@/Components/Badges/RedBadge.vue'
import UserDropdown from '@/Components/Dropdowns/UserDropdown.vue'
import LanguageDropdownForDashboard from '@/Components/Dropdowns/LanguageDropdownForDashboard.vue'
import NotificationDropdownForSellerDashboard from '@/Components/Dropdowns/Notifications/NotificationDropdownForSellerDashboard.vue'
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

const store = computed(() => usePage().props.auth?.store)
</script>

<template>
  <!-- Navbar -->
  <nav
    class="hidden sticky top-0 w-full z-2 md:flex-row md:flex-nowrap md:justify-start md:flex items-center p-4 bg-blue-600"
  >
    <div
      class="w-full mx-auto items-center flex justify-between md:flex-nowrap flex-wrap md:px-10 px-4"
    >
      <!-- Brand -->
      <span class="text-white text-sm hidden lg:inline-block font-bold space-x-3">
        <span>
          {{ __('Seller Dashboard') }}
        </span>

        <GreenBadge v-if="store?.status === 'active'">
          <i class="fa-solid fa-circle-check"></i>
          Active
        </GreenBadge>
        <RedBadge v-else>
          <i class="fa-solid fa-circle-xmark"></i>
          Inactive
        </RedBadge>
      </span>
      <!-- Form -->
      <form class="md:flex hidden flex-row flex-wrap items-center lg:ml-auto mr-3 w-[250px]">
        <div class="relative flex w-full flex-wrap items-stretch">
          <span
            class="z-10 h-full leading-snug font-normal absolute text-center text-blueGray-300 bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3"
          >
            <i class="fas fa-search"></i>
          </span>
          <input
            type="text"
            placeholder="Search here..."
            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm shadow outline-none focus:outline-none focus:ring-2 focus:ring-blue-300 font-medium w-full pl-10"
          />
        </div>
      </form>
      <!-- User -->
      <ul class="z-50 flex-col md:flex-row list-none items-center hidden md:flex space-x-3">
        <!-- Seller Dashboard Notification Dropdown -->
        <NotificationDropdownForSellerDashboard />

        <!-- Seller Dashboard Language Dropdown -->
        <LanguageDropdownForDashboard />

        <!-- User Dropdown -->
        <UserDropdown />
      </ul>
    </div>
  </nav>
  <!-- End Navbar -->
</template>
