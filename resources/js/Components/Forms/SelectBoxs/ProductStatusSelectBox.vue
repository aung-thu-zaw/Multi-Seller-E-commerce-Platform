<script setup>
import { router, usePage } from '@inertiajs/vue3'
import { ref, watch } from 'vue'
import { __ } from '@/Services/translations-inside-setup.js'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'


const props = defineProps({ product: Object })

const productStatus = ref(props.product?.status)

watch(productStatus, (newProductStatus) => {
  router.patch(
    route('admin.products.status.update', { product: props.product?.slug }),
    {
      product_status: newProductStatus
    },
    {
      preserveScroll: true,
      onSuccess: () => {
        const successMessage = usePage().props.flash.success
        if (successMessage) {
          toast.success(__(successMessage, { label: __('Product status') }), {
            autoClose: 2000
          })
        }
        // const errorMessage = usePage().props.flash.error
        // if (errorMessage) {
        //   toast.error(__(errorMessage), {
        //     autoClose: 2000
        //   })
        // }
      }
    }
  )
})
</script>


<template>
  <div class="min-w-[120px]">
    <select
      class="rounded-md p-3 w-full text-sm font-semibold text-gray-600 border border-gray-300 bg-gray-50 focus:ring-2 transition-all focus:ring-orange-300 focus:border-orange-400"
      v-model="productStatus"
    >
      <option disabled>{{ __('Select an option') }}</option>
      <option value="draft" :selected="product.status === 'draft'">Draft</option>
      <option value="pending" :selected="product.status === 'pending'">Pending</option>
      <option value="approved" :selected="product.status === 'approved'">Approved</option>
      <option value="rejected" :selected="product.status === 'rejected'">Rejected</option>
    </select>
  </div>
</template>
