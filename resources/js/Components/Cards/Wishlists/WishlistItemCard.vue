<script setup>
import NormalButton from '@/Components/Buttons/NormalButton.vue'
import { useFormatFunctions } from '@/Composables/useFormatFunctions'
import { computed, inject } from 'vue'
import { __ } from '@/Services/translations-inside-setup.js'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'
import { router, usePage } from '@inertiajs/vue3'

const props = defineProps({ wishlist: Object })

const swal = inject('$swal')

const product = computed(() => props.wishlist?.product)

const { formatAmount } = useFormatFunctions()

const discountPercentage = computed(() => {
  const discountPercentage =
    ((product.value?.price - product.value?.offer_price) / product.value?.price) * 100

  return Math.round(discountPercentage)
})

const removeWishlistItem = async (wishlist) => {
  const result = await swal({
    icon: 'question',
    title: `Remove From Watchlist`,
    text: `Are you sure you want to remove this item(s)?`,
    showCancelButton: true,
    confirmButtonText: 'Yes, remove it!',
    confirmButtonColor: '#d52222',
    cancelButtonColor: '#626262',
    timer: 20000,
    timerProgressBar: true,
    reverseButtons: true
  })

  if (result.isConfirmed) {
    router.delete(route('user.my-wishlists.destroy', { wishlist }), {
      preserveScroll: true,
      onSuccess: () => {
        const successMessage = usePage().props.flash.success
        toast.success(__(successMessage), {
          autoClose: 2000
        })
      }
    })
  }
}
</script>

<template>
  <div
    class="border border-gray-200 rounded-md flex items-start justify-between space-x-5 p-5 mb-4"
  >
    <div class="w-[400px] flex items-start">
      <div class="min-w-[100px] overflow-hidden">
        <img :src="product?.image" alt="product image" class="w-20 h-20 rounded-md object-cover" />
      </div>
      <div class="space-y-2">
        <h3 class="font-semibold text-sm text-gray-700">
          {{ product?.name }}
        </h3>
        <p class="text-[.8rem] text-orange-600 font-bold">Only {{ product?.qty }} item(s) left</p>
      </div>
    </div>

    <div>
      <div v-if="product?.offer_price" class="space-y-2">
        <p class="font-bold text-orange-600 text-xl">$ {{ formatAmount(product?.offer_price) }}</p>
        <div class="font-bold space-x-2">
          <span class="text-gray-600 text-sm line-through">
            $ {{ formatAmount(product?.price) }}
          </span>
          <span class="text-[.7rem] px-2 py-1 bg-orange-200 rounded-full text-orange-600 font-bold">
            {{ discountPercentage }} % OFF
          </span>
        </div>
        <p class="font-medium text-green-600 text-sm">Price dropped</p>
      </div>
      <div v-else>
        <p class="font-bold text-orange-600 text-xl">$ {{ formatAmount(product?.price) }}</p>
      </div>
    </div>
    <div class="space-x-3">
      <NormalButton class="text-white bg-blue-600 hover:bg-blue-700">
        <i class="fa-solid fa-cart-plus"></i>
        Add to cart
      </NormalButton>
      <NormalButton
        @click="removeWishlistItem(wishlist?.id)"
        class="text-white bg-red-600 hover:bg-red-700"
      >
        <i class="fa-solid fa-trash-can"></i>
        Remove
      </NormalButton>
    </div>
  </div>
</template>
