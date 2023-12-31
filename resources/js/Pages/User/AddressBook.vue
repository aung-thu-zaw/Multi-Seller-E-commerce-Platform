<script setup>
import UserDashboardLayout from '@/Layouts/UserDashboardLayout.vue'
import AddressCard from '@/Components/Cards/AddressCard.vue'
import CreateAddressModal from '@/Components/Modals/Address/CreateAddressModal.vue'
import { Head } from '@inertiajs/vue3'

defineProps({ addresses: Object })
</script>

<template>
  <Head :title="__('Address Book')" />

  <UserDashboardLayout>
    <div class="flex items-center justify-between pb-2.5 mb-5 border-b">
      <h1 class="font-bold text-md text-gray-700">
        <i class="fa-solid fa-address-book"></i>
        {{ __('Address Book') }}
      </h1>

      <CreateAddressModal />
    </div>

    <div class="p-10 border border-gray-200 bg-white rounded-md">
      <div class="grid grid-cols-2 gap-5 overflow-auto max-h-[770px] py-1">
        <!-- Card -->
        <AddressCard v-for="address in addresses" :key="address.id" :address="address" />
      </div>
    </div>
  </UserDashboardLayout>
</template>
