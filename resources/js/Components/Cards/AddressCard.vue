<script setup>
import EditAddressModal from '@/Components/Modals/Address/EditAddressModal.vue'
import { router, usePage } from '@inertiajs/vue3'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'
import { __ } from '@/Services/translations-inside-setup.js'
import { inject, ref } from 'vue'

const props = defineProps({ address: Object, shippingAreas: Object })

const confirmingAddressEdit = ref(false)

const confirmOpenModal = () => {
  confirmingAddressEdit.value = true
}

const closeModal = () => {
  confirmingAddressEdit.value = false
}

const swal = inject('$swal')

const handleDeleteAddress = async () => {
  const result = await swal({
    icon: 'question',
    title: __('Delete Address'),
    text: __('Are you sure you would like to do this?'),
    showCancelButton: true,
    confirmButtonText: __('Confirm'),
    cancelButtonText: __('Cancel'),
    confirmButtonColor: '#d52222',
    cancelButtonColor: '#626262',
    timer: 20000,
    timerProgressBar: true,
    reverseButtons: true
  })

  if (result.isConfirmed) {
    router.delete(route('user.address-book.destroy', { address_book: props.address?.id }), {
      preserveScroll: true,
      onSuccess: () => {
        const successMessage = usePage().props.flash.success
        if (successMessage) {
          toast.success(
            __(successMessage, {
              label: __('Address')
            }),
            {
              autoClose: 2000
            }
          )
        }
      }
    })
  }
}
</script>

<template>
  <div
    class="border border-gray-200 rounded-sm flex flex-col items-start p-5 hover:shadow-sm duration-150"
  >
    <ul class="text-xs text-gray-700 space-y-3 w-full mb-5">
      <li class="flex items-start space-x-5">
        <span class="block font-bold w-1/4"> Name : </span>
        <span class="font-medium w-full flex items-center justify-between">
          {{ address.name }}

          <div class="space-x-3 flex items-center">
            <div>
              <button
                type="button"
                @click="confirmOpenModal"
                class="font-bold text-xs text-blue-600 hover:text-blue-500 duration-200"
              >
                <i class="fa-solid fa-edit"></i>
              </button>

              <EditAddressModal
                :show="confirmingAddressEdit"
                @close="closeModal"
                :address="address"
                :shippingAreas="shippingAreas"
              />
            </div>

            <button
              type="button"
              @click="handleDeleteAddress"
              class="font-bold text-xs text-red-600 hover:text-red-500 duration-200"
            >
              <i class="fa-solid fa-trash-can"></i>
            </button>
          </div>
        </span>
      </li>
      <li class="flex items-start space-x-5">
        <span class="block font-bold w-1/4"> Phone : </span>
        <span class="block font-medium w-full"> {{ address.phone }} </span>
      </li>
      <li class="flex items-start space-x-5">
        <span class="block font-bold w-1/4"> Email : </span>
        <span class="block font-medium w-full"> {{ address.email }} </span>
      </li>
      <li class="flex items-start space-x-5">
        <span class="block font-bold w-1/4"> Region : </span>
        <span class="block font-medium w-full"> {{ address.region?.name }} </span>
      </li>
      <li class="flex items-start space-x-5">
        <span class="block font-bold w-1/4"> City : </span>
        <span class="block font-medium w-full"> {{ address.city?.name }} </span>
      </li>
      <li class="flex items-start space-x-5">
        <span class="block font-bold w-1/4"> Township : </span>
        <span class="block font-medium w-full"> {{ address.township?.name }} </span>
      </li>
      <li class="flex items-start space-x-5">
        <span class="block font-bold w-1/4"> Postal Code : </span>
        <span class="block font-medium w-full"> {{ address.postal_code }} </span>
      </li>
      <li class="flex items-start space-x-5">
        <span class="block font-bold w-1/4"> Address : </span>
        <span class="block font-medium w-full">
          {{ address.address }}
        </span>
      </li>
      <li class="flex items-start space-x-5">
        <span class="block font-bold w-1/4"> Landmark : </span>
        <span class="block font-medium w-full"> {{ address.landmark }} </span>
      </li>
    </ul>

    <div class="space-x-2">
      <span
        class="font-medium border border-orange-500 bg-orange-500 text-white text-xs px-3 py-1 rounded-full capitalize"
      >
        {{ address.address_type }}
      </span>
      <span
        v-show="address.is_default_delivery"
        class="font-medium border border-orange-500 text-orange-500 text-xs px-3 py-1 rounded-full"
      >
        Default Delivery Address
      </span>
      <span
        v-show="address.is_default_billing"
        class="font-medium border border-orange-500 text-orange-500 text-xs px-3 py-1 rounded-full"
      >
        Default Billing Address
      </span>
    </div>
  </div>
</template>
