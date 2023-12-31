<script setup>
import UserDashboardLayout from '@/Layouts/UserDashboardLayout.vue'
import AddressCard from '@/Components/Cards/AddressCard.vue'
import CreateAddressModal from '@/Components/Modals/Address/CreateAddressModal.vue'
import { Head } from '@inertiajs/vue3'
import { ref } from 'vue'

defineProps({ addresses: Object, regions: Object, cities: Object, townships: Object })

const confirmingAddressCreation = ref(false)

const confirmOpenModal = () => {
  confirmingAddressCreation.value = true
}

const closeModal = () => {
  confirmingAddressCreation.value = false

  //   form.reset()
}
</script>

<template>
  <Head :title="__('Address Book')" />

  <UserDashboardLayout>
    <div class="flex items-center justify-between pb-2.5 mb-5 border-b">
      <h1 class="font-bold text-md text-gray-700">
        <i class="fa-solid fa-address-book"></i>
        {{ __('Address Book') }}
      </h1>

      <button
        @click="confirmOpenModal"
        class="font-bold text-xs text-orange-500 px-3 py-2 rounded-sm border border-orange-600 hover:bg-orange-600 hover:text-white duration-200"
      >
        <i class="fa-solid fa-plus"></i>
        Add New Address
      </button>

      <CreateAddressModal
        :show="confirmingAddressCreation"
        @close="closeModal"
        :regions="regions"
        :cities="cities"
        :townships="townships"
      />
    </div>

    <div class="p-10 border border-gray-200 bg-white rounded-md">
      <div class="grid grid-cols-2 gap-5 overflow-auto max-h-[770px] py-1">
        <!-- Card -->
        <AddressCard v-for="address in addresses" :key="address.id" :address="address" />
      </div>
    </div>
  </UserDashboardLayout>
</template>
