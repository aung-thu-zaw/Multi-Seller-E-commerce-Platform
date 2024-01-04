<script setup>
import ProductImageGallery from '@/Components/ProductImageGallery.vue'
import StarRating from '@/Components/Ratings/StarRating.vue'
import RedBadge from '@/Components/Badges/RedBadge.vue'
import GreenBadge from '@/Components/Badges/GreenBadge.vue'
import { useFormatFunctions } from '@/Composables/useFormatFunctions'
import { computed, onMounted, reactive, ref, watch } from 'vue'
import { router, usePage } from '@inertiajs/vue3'
import { __ } from '@/Services/translations-inside-setup.js'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'

const props = defineProps({ product: Object, attributes: Object, options: Object, price: Object })

const { formatAmount } = useFormatFunctions()

const avgRating = computed(() => {
  const rawAvgRating = props.product?.product_reviews_avg_rating

  const avgRatingValue = parseFloat(rawAvgRating)

  if (!Number.isNaN(avgRatingValue)) {
    return avgRatingValue.toFixed(1)
  }

  return null
})

// Handle Quantity
const quantity = ref(1)

const increment = () =>
  quantity.value >= props.product.qty ? (quantity.value = props.product.qty) : quantity.value++

const decrement = () => (quantity.value <= 1 ? 1 : quantity.value--)

const formData = reactive({
  product_id: props.product.id,
  store_id: props.product.store_id,
  qty: quantity.value,
  unit_price: 0,
  total_price: 0,
  attributes: {}
})

const calculateTotalPrice = () => {
  let totalPrice = 0

  if (props.attributes && props.options && props.product?.skus.length) {
    for (const sku of props.product.skus) {
      let isMatch = true

      for (const option of sku.attribute_options) {
        if (formData.attributes[option.attribute.name] !== option.value) {
          isMatch = false
          break
        }
      }

      if (isMatch) {
        formData.unit_price = sku.offer_price ? sku.offer_price : sku.price
        totalPrice = sku.offer_price ? formData.qty * sku.offer_price : formData.qty * sku.price
        break
      }
    }

    return totalPrice
  } else {
    formData.unit_price = props.product.offer_price
      ? props.product.offer_price
      : props.product.price

    totalPrice = props.product.offer_price
      ? formData.qty * props.product.offer_price
      : formData.qty * props.product.price

    return totalPrice
  }
}

const selectedSKU = computed(() => {
  const selectedAttributes = Object.values(formData.attributes)

  return props.product?.skus.find((sku) => {
    const skuAttributes = sku.attribute_options.map((option) => option.value)
    return selectedAttributes.every((attr) => skuAttributes.includes(attr))
  })
})

const productOfferPrice = computed(() =>
  selectedSKU.value ? selectedSKU.value.offer_price : props.product.offer_price
)
const productNormalPrice = computed(() =>
  selectedSKU.value ? selectedSKU.value.price : props.product.price
)

const discountPercentage = computed(() => {
  const offerPrice = productOfferPrice.value
  const normalPrice = productNormalPrice.value

  if (offerPrice && normalPrice) {
    return Math.round(((normalPrice - offerPrice) / normalPrice) * 100)
  }

  return 0
})

const remainingQuantityInStock = computed(() => {
  if (props.attributes && props.options && props.product?.skus.length) {
    for (const sku of props.product.skus) {
      let isMatch = true

      for (const option of sku.attribute_options) {
        if (formData.attributes[option.attribute.name] !== option.value) {
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
    return props.product?.qty
  }
})

const getDefaultAttributes = () => {
  if (props.attributes && props.options && props.product?.skus.length) {
    const defaultAttributes = {}

    for (const attributeId in props.attributes) {
      const attributeName = props.attributes[attributeId]
      const options = props.options[attributeId]

      defaultAttributes[attributeName] = options[0].value
    }

    return defaultAttributes
  } else {
    return {}
  }
}

onMounted(() => {
  Object.assign(formData.attributes, getDefaultAttributes())
  formData.total_price = calculateTotalPrice()
})

const handleSelectedAttributes = (option) => {
  formData.attributes[option.attribute.name] = option.value
  formData.total_price = calculateTotalPrice()
}

watch(quantity, (newValue) => {
  formData.qty = newValue
  formData.total_price = calculateTotalPrice()
})

const handleAddToCart = () => {
  if (remainingQuantityInStock.value !== 0) {
    router.post(
      route('cart-items.store'),
      {
        ...formData
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

// const saveToWishlist = () => {
//   router.post(
//     route('wishlists.store', {
//       product_id: props.cartItem?.product.id,
//       store_id: props.cartItem?.product.store_id,
//       attributes: props.cartItem?.attributes
//     }),
//     {},
//     {
//       preserveScroll: true,
//       onSuccess: () => {
//         router.delete(route('cart-items.destroy', props.cartItem?.id))
//         const successMessage = usePage().props.flash.success
//         toast.success(__(successMessage), {
//           autoClose: 2000
//         })
//       }
//     }
//   )
// }

const handleAddToWishlist = () => {
  router.post(
    route('wishlists.store', {
      product_id: props.product.id,
      store_id: props.product.store_id,
      attributes: formData.attributes
    }),
    {},
    {
      preserveScroll: true,
      onSuccess: () => {
        const successMessage = usePage().props.flash.success
        toast.success(__(successMessage), {
          autoClose: 2000
        })
      }
    }
  )
}

const saved = computed(() => {
  return usePage().props.auth?.wishlists.some(
    (wishlists) => wishlists.product_id === props.product?.id
  )
})
</script>

<template>
  <div class="rounded-md bg-white border border-gray-200 overflow-hidden">
    <div class="flex items-start justify-between space-x-6">
      <aside class="w-5/12 p-5">
        <ProductImageGallery :product="product" />
      </aside>

      <div class="w-7/12 min-h-[510px] flex items-start justify-between">
        <main class="space-y-5 py-5 w-full">
          <!-- Product  -->
          <div class="flex items-center justify-between w-full">
            <div class="">
              <h2 class="font-semibold text-2xl">{{ product?.name }}</h2>
            </div>

            <div class="flex items-center space-x-2 pr-8">
              <button
                @click="handleAddToWishlist"
                class="rounded-full w-8 h-8 bg-gray-100 text-gray-700 hover:bg-gray-200 hover:text-gray-800 flex items-center text-xs justify-center border"
                    :class="{ 'text-orange-600': saved }"
              >
                <i class="fa-solid fa-heart"></i>
              </button>
              <!-- Popover -->
              <div class="hs-tooltip inline-block [--trigger:click] [--placement:bottom]">
                <button
                  type="button"
                  class="hs-tooltip-toggle flex justify-center items-center h-10 w-10 text-sm font-semibold"
                >
                  <span
                    class="rounded-full w-8 h-8 bg-gray-100 text-gray-700 hover:bg-gray-200 hover:text-gray-800 flex items-center justify-center border"
                  >
                    <i class="fa-solid fa-share-nodes"></i>
                  </span>
                  <div
                    class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-3 px-4 bg-white border text-sm text-gray-600 rounded-lg shadow-md"
                    role="tooltip"
                  >
                    <ul class="space-y-3">
                      <li>Facebook</li>
                      <li>Twitter</li>
                      <li>LinkedIn</li>
                      <li>Instagram</li>
                      <li>Youtube</li>
                    </ul>
                  </div>
                </button>
              </div>
              <!-- End Popover -->
            </div>
          </div>

          <!-- Rating -->
          <div>
            <div v-if="avgRating > 0" class="flex items-center space-x-2">
              <StarRating :rating="avgRating" />
              <p class="font-bold text-gray-700 text-sm text-center">{{ avgRating }} out of 5</p>
            </div>
            <div v-else class="flex items-center space-x-2">
              <svg
                class="flex-shrink-0 w-3 h-3 text-yellow-400"
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                fill="currentColor"
                viewBox="0 0 16 16"
              >
                <path
                  d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
                />
              </svg>

              <p class="font-bold text-gray-700 text-sm text-center">No Reviews</p>
            </div>
          </div>

          <!-- Product Brand -->
          <p class="text-gray-700 text-sm font-semibold">
            <i class="fa fa-award"></i>
            <span v-if="product?.brand"> Brand : {{ product?.brand?.name }} </span>
            <span v-else> Brand : No Brand </span>
          </p>

          <!-- Current Product Stock -->
          <div class="flex items-center">
            <div v-if="remainingQuantityInStock > 0">
              <span class="text-gray-700 font-semibold text-sm mr-3">
                Total {{ remainingQuantityInStock }} item(s) Available
              </span>
              <GreenBadge> In stock </GreenBadge>
            </div>
            <div v-else class="my-3">
              <span class="text-gray-700 font-semibold text-sm mr-3">
                Total {{ remainingQuantityInStock }} item(s) Available
              </span>
              <RedBadge> Out of stock </RedBadge>
            </div>
          </div>

          <!-- Product Price -->
          <div class="my-2">
            <div v-if="productOfferPrice">
              <span class="text-2xl font-semibold text-orange-600 block">
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
              <span class="text-2xl font-semibold text-orange-600 block">
                $ {{ formatAmount(productNormalPrice) }}
              </span>
            </div>
          </div>

          <!-- Variants -->
          <div class="space-y-5 capitalize">
            <div
              v-for="(attribute, index) in attributes"
              :key="index"
              v-show="options[index]"
              class="flex items-center"
            >
              <p class="font-semibold text-sm text-gray-700 mr-5">{{ attribute }} :</p>
              <div class="flex items-center space-x-3">
                <button
                  v-for="option in options[index]"
                  :key="option"
                  class="px-3.5 py-1 flex items-center justify-center text-sm font-semibold rounded-sm border border-gray-300 hover:border-orange-400 duration-100"
                  :class="{
                    'border-orange-500 ring-2 ring-orange-300':
                      formData.attributes[attribute] === option.value
                  }"
                  @click="handleSelectedAttributes(option)"
                >
                  <span> {{ option.value }} </span>
                </button>
              </div>
            </div>
          </div>

          <!-- Handle Quantity -->
          <div class="my-5 flex items-center">
            <p class="font-semibold text-sm text-gray-700 mr-5">Quantity :</p>
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

          <!-- Action Buttons -->
          <div class="flex flex-wrap space-x-6 mb-5">
            <button
              type="button"
              @click="handleAddToCart"
              class="text-sm px-6 shadow-md py-3 font-bold rounded-[4px] active:animate-press bg-blue-600 text-white hover:bg-blue-700 duration-200"
              :disabled="remainingQuantityInStock === 0"
            >
              <i class="fa-solid fa-cart-plus"></i>
              Add to cart
            </button>
            <button
              class="text-sm px-6 shadow-md py-3 font-bold rounded-[4px] active:animate-press bg-yellow-500 text-white hover:bg-yellow-600 duration-200"
            >
              <i class="fa-solid fa-basket-shopping"></i>
              Buy now
            </button>
          </div>
        </main>
      </div>
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


        <!-- <aside class="bg-gray-50 min-w-[300px]">
          <div class="px-6 py-3.5 space-y-3">
            <div class="flex items-center justify-between">
              <h3 class="font-bold text-sm text-gray-800">Available Delivery</h3>

              <a href="#" class="font-semibold text-xs text-orange-600">Change</a>
            </div>
            <div class="font-medium text-gray-700 text-sm flex items-start space-x-2">
              <i class="fa-solid fa-location-dot"></i>
              <span> Tanintharyi, Myeik, Myeik </span>
            </div>
          </div>

          <hr />

          <div class="px-6 py-3.5 space-y-3">
            <div class="font-medium text-gray-700 text-sm flex items-start space-x-2">
              <i class="fa-solid fa-box"></i>

              <p>
                Standard Delivery
                <br />
                <span class="text-gray-500 text-xs"> 23 Dec - 27 Dec </span>
              </p>

              <span class="text-orange-600 text-sm font-medium"> Ks 12,00</span>
            </div>
            <div class="font-medium text-gray-700 text-sm flex items-start space-x-2">
              <i class="fa-solid fa-money-bill"></i>
              <span> Cash on Delivery Available </span>
            </div>
          </div>

          <hr />

          <div class="px-6 py-3.5 space-y-3">
            <h3 class="font-bold text-sm text-gray-800">Services</h3>
            <div class="font-medium text-gray-700 text-sm flex items-start space-x-2">
              <i class="fa-solid fa-truck"></i>
              <p>
                14 days free & easy return
                <br />
                <span class="text-gray-500 text-xs"> Change of mind is not applicable </span>
              </p>
            </div>
            <div class="font-medium text-gray-700 text-sm flex items-start space-x-2">
              <i class="fa-solid fa-shield"></i>
              <span> Warranty Available </span>
            </div>
          </div>

          <hr />

          <div class="px-6 py-3.5 space-y-3">
            <div class="flex items-center justify-between">
              <h3 class="font-bold text-sm text-gray-800">Sold By</h3>

              <button class="font-bold text-xs text-orange-600">
                <i class="fa-solid fa-message"></i>
                Chat Now
              </button>
            </div>
            <div class="font-semibold text-gray-700 text-md flex items-start space-x-2">
              K Mobile Shop
            </div>
          </div>
        </aside> -->

<!-- <div class="flex items-center">
              <p class="font-semibold text-sm text-gray-700 mr-5">Color :</p>
              <div class="flex items-center space-x-3">
                <div
                  class="w-10 h-10 p-0.5 rounded-sm border border-gray-300 hover:border-orange-400 duration-100"
                >
                  <img
                    src="https://storage.sg.content-cdn.io/cdn-cgi/image/width=1000,height=1333,quality=90,format=auto,fit=cover,g=top/in-resources/22a79ec5-e694-4d7a-ac5a-85c8fa45b7f1/Images/ProductImages/Source/ITMTR01118-Ash-Blue_01.jpg"
                    alt=""
                    class="w-full h-full object-cover"
                  />
                </div>
                <div
                  class="w-10 h-10 p-0.5 rounded-sm border border-gray-300 hover:border-orange-400 duration-100"
                >
                  <img
                    src="https://storage.sg.content-cdn.io/cdn-cgi/image/width=1000,height=1333,quality=90,format=auto,fit=cover,g=top/in-resources/22a79ec5-e694-4d7a-ac5a-85c8fa45b7f1/Images/ProductImages/Source/ITMTR01118-Ash-Blue_01.jpg"
                    alt=""
                    class="w-full h-full object-cover"
                  />
                </div>
                <div
                  class="w-10 h-10 p-0.5 rounded-sm border border-gray-300 hover:border-orange-400 duration-100"
                >
                  <img
                    src="https://storage.sg.content-cdn.io/cdn-cgi/image/width=1000,height=1333,quality=90,format=auto,fit=cover,g=top/in-resources/22a79ec5-e694-4d7a-ac5a-85c8fa45b7f1/Images/ProductImages/Source/ITMTR01118-Ash-Blue_01.jpg"
                    alt=""
                    class="w-full h-full object-cover"
                  />
                </div>
                <div
                  class="w-10 h-10 p-0.5 rounded-sm border border-gray-300 hover:border-orange-400 duration-100"
                >
                  <img
                    src="https://storage.sg.content-cdn.io/cdn-cgi/image/width=1000,height=1333,quality=90,format=auto,fit=cover,g=top/in-resources/22a79ec5-e694-4d7a-ac5a-85c8fa45b7f1/Images/ProductImages/Source/ITMTR01118-Ash-Blue_01.jpg"
                    alt=""
                    class="w-full h-full object-cover"
                  />
                </div>
                <div
                  class="w-10 h-10 p-0.5 rounded-sm border border-gray-300 hover:border-orange-400 duration-100"
                >
                  <img
                    src="https://storage.sg.content-cdn.io/cdn-cgi/image/width=1000,height=1333,quality=90,format=auto,fit=cover,g=top/in-resources/22a79ec5-e694-4d7a-ac5a-85c8fa45b7f1/Images/ProductImages/Source/ITMTR01118-Ash-Blue_01.jpg"
                    alt=""
                    class="w-full h-full object-cover"
                  />
                </div>
                <div
                  class="w-10 h-10 p-0.5 rounded-sm border border-gray-300 hover:border-orange-400 duration-100"
                >
                  <img
                    src="https://storage.sg.content-cdn.io/cdn-cgi/image/width=1000,height=1333,quality=90,format=auto,fit=cover,g=top/in-resources/22a79ec5-e694-4d7a-ac5a-85c8fa45b7f1/Images/ProductImages/Source/ITMTR01118-Ash-Blue_01.jpg"
                    alt=""
                    class="w-full h-full object-cover"
                  />
                </div>
              </div>
            </div> -->
