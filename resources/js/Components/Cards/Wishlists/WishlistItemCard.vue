<script setup>
import NormalButton from '@/Components/Buttons/NormalButton.vue'
import { useFormatFunctions } from '@/Composables/useFormatFunctions'
import { computed, inject } from 'vue'
import { Link, router, usePage } from '@inertiajs/vue3'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'
import { __ } from '@/Services/translations-inside-setup.js'

const props = defineProps({ wishlist: Object })

const swal = inject('$swal')
const product = computed(() => props.wishlist?.product)

const attributes = computed(() => {
  return JSON.parse(props.wishlist?.attributes)
})

const formattedAttributes = computed(() => {
  if (!attributes.value) return ''

  return Object.entries(attributes.value)
    .map(([key, value]) => `${key}: ${value}`)
    .join(' | ')
})

const remainingQuantityInStock = computed(() => {
  if (props.wishlist?.product?.skus.length) {
    for (const sku of props.wishlist.product.skus) {
      let isMatch = true

      for (const option of sku.attribute_options) {
        if (attributes.value[option.attribute.name] !== option.value) {
          isMatch = false
          break
        }
      }

      if (isMatch && sku.qty > 0) {
        return sku.qty
      }
    }

    return 0
  } else {
    return props.wishlist.product?.qty
  }
})

const { formatAmount } = useFormatFunctions()

const selectedSKU = computed(() => {
  const selectedAttributes = props.wishlist.attributes?.length
    ? Object.values(JSON.parse(props.wishlist.attributes))
    : null

  return props.wishlist?.product?.skus.find((sku) => {
    const skuAttributes = sku.attribute_options.map((option) => option.value)
    return selectedAttributes.every((attr) => skuAttributes.includes(attr))
  })
})

const productOfferPrice = computed(() =>
  selectedSKU.value ? selectedSKU.value.offer_price : props.wishlist?.product?.offer_price
)
const productNormalPrice = computed(() =>
  selectedSKU.value ? selectedSKU.value.price : props.wishlist?.product?.price
)

const discountPercentage = computed(() => {
  const offerPrice = productOfferPrice.value
  const normalPrice = productNormalPrice.value

  if (offerPrice && normalPrice) {
    return Math.round(((normalPrice - offerPrice) / normalPrice) * 100)
  }

  return 0
})

const removeItem = async () => {
  const result = await swal({
    icon: 'question',
    title: `Remove From Wishlists`,
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
    router.delete(route('wishlists.destroy', { wishlist: props.wishlist.id }), {
      preserveScroll: true,
      onSuccess: () => {
        toast.success(__(usePage().props.flash.success), {
          autoClose: 2000
        })
      }
    })
  }
}

const handleAddToCart = () => {
  if (remainingQuantityInStock.value !== 0) {
    router.post(
      route('cart-items.store'),
      {
        product_id: product.value.id,
        qty: 1,
        total_price: productOfferPrice.value ?? productNormalPrice.value,
        attributes: props.wishlist?.attributes
      },
      {
        preserveScroll: true,
        onSuccess: () => {
          toast.success(__(usePage().props.flash.success), {
            autoClose: 2000
          })
        }
      }
    )
  } else {
    toast.error('Product is sold out.', {
      autoClose: 2000
    })
  }
}
</script>

<template>
  <div class="border border-gray-200 rounded-md flex items-center justify-between p-5 mb-4 w-full">
    <div class="w-[400px] flex items-center">
      <div class="flex items-start">
        <div class="min-w-[100px] overflow-hidden">
          <img
            :src="product?.image"
            alt="product image"
            class="w-20 h-20 rounded-md object-cover"
          />
        </div>
      </div>
      <div class="space-y-2">
        <h3 class="font-semibold text-md text-gray-700 hover:text-orange-600">
          <Link :href="route('products.show', { product: product?.slug })">
            {{ product?.name }}
          </Link>
        </h3>
        <p class="text-xs font-semibold text-gray-600 capitalize">
          {{ formattedAttributes }}
        </p>

        <div class="flex items-center text-[.8rem] font-bold">
          <span v-if="remainingQuantityInStock > 0" class="text-orange-600">
            Only {{ remainingQuantityInStock }} item(s) left
          </span>
          <span v-else class="text-red-600"> Out of stock </span>
        </div>
      </div>
    </div>

    <!-- Price -->
    <div class="my-2">
      <div v-if="productOfferPrice">
        <span class="text-xl font-semibold text-orange-600 block">
          $ {{ formatAmount(productOfferPrice) }}
        </span>

        <span
          v-if="productNormalPrice"
          class="text-[.9rem] text-gray-500 font-medium line-through mr-5"
        >
          $ {{ formatAmount(productNormalPrice) }}
        </span>

        <span
          v-if="discountPercentage"
          class="text-[.6rem] px-2 py-1 bg-orange-200 rounded-full text-orange-600 font-bold"
        >
          {{ discountPercentage }} % OFF
        </span>
      </div>
      <div v-else>
        <span class="text-xl font-semibold text-orange-600 block">
          $ {{ formatAmount(productNormalPrice) }}
        </span>
      </div>
    </div>

    <div class="space-x-3 flex items-center">
      <NormalButton @click="handleAddToCart" class="text-white bg-blue-600 hover:bg-blue-700">
        <i class="fa-solid fa-cart-plus"></i>
        Add to cart
      </NormalButton>
      <NormalButton @click="removeItem" class="text-white bg-red-600 hover:bg-red-700">
        <i class="fa-solid fa-trash-can"></i>
        Remove
      </NormalButton>
    </div>
  </div>
</template>

<style scoped>
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  display: none;
}

.scrollbar::-webkit-scrollbar {
  height: 10px;
}
</style>
