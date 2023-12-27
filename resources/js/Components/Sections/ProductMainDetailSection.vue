<script setup>
import ProductImageGallery from '@/Components/ProductImageGallery.vue'
import StarRating from '@/Components/Ratings/StarRating.vue'
import RedBadge from '@/Components/Badges/RedBadge.vue'
import GreenBadge from '@/Components/Badges/GreenBadge.vue'
import { useFormatFunctions } from '@/Composables/useFormatFunctions'
import { computed, reactive, ref, watch } from 'vue'
import { router, usePage } from '@inertiajs/vue3'

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

const discountPercentage = computed(() => {
  const discountPercentage =
    ((props.product?.price - props.product?.offer_price) / props.product?.price) * 100

  return Math.round(discountPercentage)
})

// Handle Quantity
const quantity = ref(1)

const increment = () =>
  quantity.value >= props.product.qty ? (quantity.value = props.product.qty) : quantity.value++

const decrement = () => (quantity.value <= 1 ? 1 : quantity.value--)

const formData = reactive({
  product_id: props.product.id,
  qty: quantity.value,
  total_price: props.product.offer_price
    ? quantity.value * props.product.offer_price
    : quantity.value * props.product.price,
  attributes: {}
})

const calculateTotalPrice = () => {
  let totalPrice = 0

  for (const sku of props.product.skus) {
    let isMatch = true

    for (const option of sku.attribute_options) {
      if (formData.attributes[option.attribute.name] !== option.value) {
        isMatch = false
        break
      }
    }

    if (isMatch) {
      totalPrice = sku.price * formData.qty
      break
    }
  }

  return totalPrice
}

const remainingQuantityInStock = computed(() => {
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
  if (props.product.qty !== 0) {
    router.post(
      route('cart-items.store'),
      {
        ...formData
      },
      {
        preserveScroll: true,
        onSuccess: () => {
          toast.success(usePage().props.flash.success, {
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
  <div class="rounded-md bg-white border border-gray-200 overflow-hidden">
    <div class="flex items-start justify-between space-x-6">
      <aside class="w-4/12 p-5">
        <ProductImageGallery :product="product" />
      </aside>

      <div class="w-8/12 min-h-[510px] flex items-start justify-between">
        <main class="space-y-5 py-5">
          <!-- Product  -->
          <div class="w-full flex items-center justify-between">
            <div class="">
              <h2 class="font-semibold text-2xl">{{ product?.name }}</h2>
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
          <!-- <div class="flex items-center">
            <div v-if="product?.qty > 0">
              <span class="text-gray-700 font-semibold text-sm mr-3">
                Total {{ product?.qty }} Available
              </span>
              <GreenBadge> In stock </GreenBadge>
            </div>
            <div v-else class="my-3">
              <span class="text-gray-700 font-semibold text-sm mr-3">
                {{ product.qty }} Available
              </span>
              <RedBadge> In stock </RedBadge>
            </div>
          </div> -->

          <!-- Product Price -->
          <div class="my-2">
            <div v-if="product?.offer_price">
              <span class="text-2xl font-semibold text-orange-600 block">
                $ {{ formatAmount(product?.offer_price) }}
              </span>
              <span class="text-[.9rem] text-gray-500 font-medium line-through mr-5">
                $ {{ formatAmount(product?.price) }}
              </span>
              <span
                class="text-[.6rem] px-2 py-1 bg-orange-200 rounded-full text-orange-600 font-bold"
              >
                {{ discountPercentage }} % OFF
              </span>
            </div>
            <div v-else>
              <span class="text-2xl font-semibold text-orange-600 block">
                $ {{ formatAmount(product?.price) }}
              </span>
            </div>
          </div>

          {{ formData }}

          {{ remainingQuantityInStock }}

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

            <div class="flex items-center ml-5">
              <div v-if="remainingQuantityInStock > 0">
                <span class="text-gray-700 font-semibold text-sm mr-3">
                  {{ remainingQuantityInStock }} item(s) left
                </span>
                <GreenBadge> In stock </GreenBadge>
              </div>
              <div v-else class="my-3">
                <RedBadge> Out of stock </RedBadge>
              </div>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="flex flex-wrap space-x-6 mb-5">
            <button
              type="button"
              @click="handleAddToCart"
              class="text-sm px-6 shadow-md py-3 font-bold rounded-[4px] active:animate-press bg-blue-600 text-white hover:bg-blue-700 duration-200"
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
