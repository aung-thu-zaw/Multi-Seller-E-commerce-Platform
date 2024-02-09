<script setup>
import NormalButton from '@/Components/Buttons/NormalButton.vue'
import { useFormatFunctions } from '@/Composables/useFormatFunctions'
import { computed, inject, ref, watch } from 'vue'
import { Link, router, usePage } from '@inertiajs/vue3'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'
import { __ } from '@/Services/translations-inside-setup.js'

const props = defineProps({ cartItem: Object })

const swal = inject('$swal')
const product = computed(() => props.cartItem?.product)

const attributes = computed(() => {
  return JSON.parse(props.cartItem?.attributes)
})

const quantity = ref(props.cartItem?.qty)

const increment = () =>
  quantity.value >= props.cartItem?.product?.qty
    ? (quantity.value = props.cartItem?.product?.qty)
    : quantity.value++

const decrement = () => (quantity.value <= 1 ? 1 : quantity.value--)

const formattedAttributes = computed(() => {
  if (!attributes.value) return ''

  return Object.entries(attributes.value)
    .map(([key, value]) => `${key}: ${value}`)
    .join(' | ')
})

const remainingQuantityInStock = computed(() => {
  if (props.cartItem?.product?.skus.length) {
    for (const sku of props.cartItem.product.skus) {
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
    return props.cartItem.product?.qty
  }
})

watch(quantity, (newValue) => {
  router.patch(
    route('cart-items.update', props.cartItem?.id),
    {
      qty: newValue,
      total_price: calculateTotalPrice()
    },
    {
      preserveScroll: true
    }
  )
})

const { formatAmount } = useFormatFunctions()

const calculateTotalPrice = () => {
  let totalPrice = 0

  if (props.cartItem?.product?.skus.length) {
    for (const sku of props.cartItem.product.skus) {
      let isMatch = true

      for (const option of sku.attribute_options) {
        if (attributes.value[option.attribute.name] !== option.value) {
          isMatch = false
          break
        }
      }

      if (isMatch) {
        totalPrice = sku.offer_price ? quantity.value * sku.offer_price : quantity.value * sku.price
        break
      }
    }

    return totalPrice
  } else {
    totalPrice = props.cartItem?.product?.offer_price
      ? quantity.value * props.cartItem?.product?.offer_price
      : quantity.value * props.cartItem?.product?.price

    return totalPrice
  }
}

const selectedSKU = computed(() => {
  const selectedAttributes = props.cartItem.attributes?.length
    ? Object.values(JSON.parse(props.cartItem.attributes))
    : null

  return props.cartItem?.product?.skus.find((sku) => {
    const skuAttributes = sku.attribute_options.map((option) => option.value)
    return selectedAttributes.every((attr) => skuAttributes.includes(attr))
  })
})

const productOfferPrice = computed(() =>
  selectedSKU.value ? selectedSKU.value.offer_price : props.cartItem?.product?.offer_price
)
const productNormalPrice = computed(() =>
  selectedSKU.value ? selectedSKU.value.price : props.cartItem?.product?.price
)

const discountPercentage = computed(() => {
  const offerPrice = productOfferPrice.value
  const normalPrice = productNormalPrice.value

  if (offerPrice && normalPrice) {
    return Math.round(((normalPrice - offerPrice) / normalPrice) * 100)
  }

  return 0
})

const saveToWishlist = () => {
  router.post(
    route('wishlists.store', {
      product_id: props.cartItem?.product.id,
      store_id: props.cartItem?.product.store_id,
      attributes: props.cartItem?.attributes
    }),
    {},
    {
      preserveScroll: true,
      onSuccess: () => {
        router.delete(route('cart-items.destroy', props.cartItem?.id))
        const successMessage = usePage().props.flash.success
        toast.success(__(successMessage), {
          autoClose: 2000
        })
      }
    }
  )
}

const removeItem = async () => {
  const result = await swal({
    icon: 'question',
    title: `Remove From Shopping Cart`,
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
    router.delete(route('cart-items.destroy', { cart_item: props.cartItem?.id }), {
      preserveScroll: true,
      onSuccess: () => {
        toast.success(__(usePage().props.flash.success), {
          autoClose: 2000
        })
      }
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
          <Link :href="route('products.show', { product: cartItem?.product?.slug })">
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
          $ {{ formatAmount(cartItem.total_price) }}

          <small class="text-gray-700 text-sm font-medium block">
            ${{ formatAmount(productOfferPrice) }} / per item
          </small>
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
          $ {{ formatAmount(cartItem.total_price) }}
          <small class="text-gray-700 text-sm font-medium block">
            ${{ formatAmount(productNormalPrice) }} / per item
          </small>
        </span>
      </div>
    </div>

    <!-- Handle Quantity -->
    <div class="flex items-center">
      <div class="flex items-center space-x-3">
        <button
          @click="increment"
          class="focus:ring-2 focus:ring-orange-300 bg-orange-500 hover:bg-orange-600 rounded-full text-xs w-8 h-8 flex items-center justify-center"
        >
          <i class="fa-solid fa-plus text-white"></i>
        </button>

        <input
          type="number"
          class="p-2 w-[80px] font-semibold text-sm text-gray-800 border text-center border-gray-300 bg-gray-50 focus:ring-2 focus:ring-orange-300 focus:border-orange-400 rounded-md transition-all"
          v-model="quantity"
        />

        <button
          @click="decrement"
          class="focus:ring-2 focus:ring-orange-300 bg-orange-500 hover:bg-orange-600 mr-2 rounded-full text-xs w-8 h-8 flex items-center justify-center"
        >
          <i class="fa-solid fa-minus text-white"></i>
        </button>
      </div>
    </div>

    <div class="space-x-3 flex items-center">
      <NormalButton @click="saveToWishlist" class="text-white bg-blue-600 hover:bg-blue-700">
        <i class="fa-solid fa-heart"></i>
      </NormalButton>
      <NormalButton @click="removeItem" class="text-white bg-red-600 hover:bg-red-700">
        <i class="fa-solid fa-trash-can"></i>
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
