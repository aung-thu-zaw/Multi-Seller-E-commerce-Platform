<script setup>
import { useFormatFunctions } from '@/Composables/useFormatFunctions'
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'

const props = defineProps({ cartItem: Object })

const product = computed(() => props.cartItem?.product)

const attributes = computed(() => {
  return JSON.parse(props.cartItem?.attributes)
})

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

const { formatAmount } = useFormatFunctions()

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

    <p class="text-gray-700 text-sm font-bold">Qty : {{ cartItem.qty }}</p>
  </div>
</template>
