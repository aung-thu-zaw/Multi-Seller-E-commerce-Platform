<script setup>
import Checkbox from '@/Components/Forms/Fields/Checkbox.vue'
import OneStarRating from '@/Components/Ratings/OneStarRating.vue'
import TwoStarRating from '@/Components/Ratings/TwoStarRating.vue'
import ThreeStarRating from '@/Components/Ratings/ThreeStarRating.vue'
import FourStarRating from '@/Components/Ratings/FourStarRating.vue'
import FiveStarRating from '@/Components/Ratings/FiveStarRating.vue'
import { Link, router, usePage } from '@inertiajs/vue3'
import { onMounted, ref, reactive, watch } from 'vue'

const props = defineProps({
  to: {
    type: String,
    required: true
  },

  categories: Object,
  brands: Object
})

const isCategoryShowLess = ref(true)
const isBrandShowLess = ref(true)
const limitedCategories = ref([])
const limitedBrands = ref([])

const params = reactive({
  search: usePage().props.ziggy.query.search,
  sort: usePage().props.ziggy.query.sort ?? 'newest_arrivals',
  page: usePage().props.ziggy.query.page,
  category: usePage().props.ziggy.query.category,
  brand: usePage().props.ziggy.query.brand,
  rating: usePage().props.ziggy.query.rating,
  price: usePage().props.ziggy.query.price,
  view: usePage().props.ziggy.query.view || 'grid'
})

const price = ref(usePage().props.ziggy.query.price || '')
const [minValue, maxValue] = price.value
  .split('-')
  .map((value) => (isNaN(parseInt(value)) ? null : parseInt(value)))
const minPrice = ref(minValue || null)
const maxPrice = ref(maxValue || null)

const selectedBrands = ref(
  usePage().props.ziggy.query?.brand ? usePage().props.ziggy.query.brand.split('--') : []
)

watch(
  () => selectedBrands.value,
  () => {
    params.brand = selectedBrands.value.join('--')
    router.get(route(props.to), { ...params })
  }
)

watch(
  () => params.rating,
  () => {
    router.get(route(props.to), { ...params })
  }
)

onMounted(() => {
  limitedCategories.value = props.categories.slice(0, 10)
  limitedBrands.value = props.brands.slice(0, 10)
})

const handlePrice = () => {
  params.price = `${minPrice.value}-${maxPrice.value}`
  router.get(route(props.to), { ...params })
}
</script>

<template>
  <div class="w-[250px] py-5 space-y-8">
    <!-- Category -->
    <div v-if="categories.length">
      <h1 class="font-bold text-lg text-gray-800 pb-3.5 mb-3 border-b">Category</h1>
      <ul class="font-medium text-sm text-gray-700 space-y-2" v-if="isCategoryShowLess">
        <li v-for="category in limitedCategories" :key="category.id">
          <Link
            class="hover:text-orange-600"
            :class="{ 'text-orange-600': params?.category === category.slug }"
            :href="route(to)"
            :data="{ ...params, category: category.slug }"
          >
            {{ category.name }}
          </Link>
        </li>
      </ul>
      <ul class="font-medium text-sm text-gray-700 space-y-2" v-else>
        <li v-for="category in categories" :key="category.id" class="hover:text-orange-600">
          <Link
            class="hover:text-orange-600"
            :class="{ 'text-orange-600': params?.category === category?.slug }"
            :href="route(to)"
            :data="{ ...params, category: category.slug }"
          >
            {{ category.name }}
          </Link>
        </li>
      </ul>

      <button
        v-if="categories.length > 10"
        @click="isCategoryShowLess = !isCategoryShowLess"
        class="font-semibold text-xs w-full hover:text-orange-700 mt-5"
      >
        <span v-if="!isCategoryShowLess">
          Show Less
          <i class="fa-solid fa-chevron-up ml-3 animate-bounce"></i>
        </span>
        <span v-else>
          Show More
          <i class="fa-solid fa-chevron-down ml-3 animate-bounce"></i>
        </span>
      </button>
    </div>

    <!-- Brand -->
    <div v-if="brands.length">
      <h1 class="font-bold text-lg text-gray-800 pb-3.5 mb-3 border-b">Brand</h1>
      <ul class="font-medium text-sm text-gray-700 space-y-2" v-if="isBrandShowLess">
        <li v-for="brand in limitedBrands" :key="brand.id" class="hover:text-orange-600 space-x-1">
          <Checkbox v-model:checked="selectedBrands" :value="brand.slug" />
          <span>{{ brand.name }}</span>
        </li>
      </ul>

      <ul class="font-medium text-sm text-gray-700 space-y-2" v-else>
        <li v-for="brand in brands" :key="brand.id" class="hover:text-orange-600 space-x-1">
          <Checkbox v-model:checked="selectedBrands" :value="brand.slug" />
          <span>{{ brand.name }}</span>
        </li>
      </ul>

      <button
        v-if="brands.length > 10"
        @click="isBrandShowLess = !isBrandShowLess"
        class="font-semibold text-xs w-full hover:text-orange-700 mt-5"
      >
        <span v-if="!isBrandShowLess">
          Show Less
          <i class="fa-solid fa-chevron-up ml-3 animate-bounce"></i>
        </span>
        <span v-else>
          Show More
          <i class="fa-solid fa-chevron-down ml-3 animate-bounce"></i>
        </span>
      </button>
    </div>

    <!-- <div>
      <h1 class="font-bold text-lg text-gray-800 pb-3.5 mb-3 border-b">Warranty Type</h1>
      <ul class="font-medium text-sm text-gray-700 space-y-2">
        <li class="hover:text-orange-600 space-x-1">
          <Checkbox />
          <span> No Warranty </span>
        </li>

        <li class="hover:text-orange-600 space-x-1">
          <Checkbox />
          <span> 14 Days Warranty </span>
        </li>
      </ul>
    </div>

    <div>
      <h1 class="font-bold text-lg text-gray-800 pb-3.5 mb-3 border-b">Services</h1>
      <ul class="font-medium text-sm text-gray-700 space-y-2">
        <li class="hover:text-orange-600 space-x-1">
          <Checkbox />
          <span> Cash On Delivery </span>
        </li>

        <li class="hover:text-orange-600 space-x-1">
          <Checkbox />
          <span> Free Delivery </span>
        </li>
      </ul>
    </div> -->

    <!-- Rating -->
    <div>
      <h1 class="font-bold text-lg text-gray-800 pb-3.5 mb-3 border-b">Rating</h1>
      <ul class="font-medium text-sm text-gray-700 space-y-2">
        <li class="flex items-center space-x-2">
          <div>
            <input
              type="radio"
              name="hs-default-radio"
              class="shrink-0 mt-0.5 border-gray-200 rounded-full text-orange-600 focus:ring-orange-500"
              id="hs-default-radio"
              value="5"
              v-model="params.rating"
            />
          </div>
          <FiveStarRating />
        </li>
        <li class="flex items-center space-x-2">
          <div>
            <input
              type="radio"
              name="hs-default-radio"
              class="shrink-0 mt-0.5 border-gray-200 rounded-full text-orange-600 focus:ring-orange-500"
              id="hs-default-radio"
              value="4"
              v-model="params.rating"
            />
          </div>
          <FourStarRating />

          <span class="text-xs">and up</span>
        </li>
        <li class="flex items-center space-x-2">
          <div>
            <input
              type="radio"
              name="hs-default-radio"
              class="shrink-0 mt-0.5 border-gray-200 rounded-full text-orange-600 focus:ring-orange-500"
              id="hs-default-radio"
              value="3"
              v-model="params.rating"
            />
          </div>
          <ThreeStarRating />
          <span class="text-xs">and up</span>
        </li>
        <li class="flex items-center space-x-2">
          <div>
            <input
              type="radio"
              name="hs-default-radio"
              class="shrink-0 mt-0.5 border-gray-200 rounded-full text-orange-600 focus:ring-orange-500"
              id="hs-default-radio"
              value="2"
              v-model="params.rating"
            />
          </div>
          <TwoStarRating />
          <span class="text-xs">and up</span>
        </li>
        <li class="flex items-center space-x-2">
          <div>
            <input
              type="radio"
              name="hs-default-radio"
              class="shrink-0 mt-0.5 border-gray-200 rounded-full text-orange-600 focus:ring-orange-500"
              id="hs-default-radio"
              value="1"
              v-model="params.rating"
            />
          </div>
          <OneStarRating />
          <span class="text-xs">and up</span>
        </li>
      </ul>
    </div>

    <!-- Price -->
    <div>
      <h1 class="font-bold text-lg text-gray-800 pb-3.5 mb-3 border-b">Price</h1>
      <ul class="font-medium text-sm text-gray-700 space-y-2">
        <li>
          <form @submit.prevent="handlePrice" class="flex items-center">
            <input
              type="number"
              placeholder="Min"
              class="w-20 h-8 border-gray-300 rounded-sm text-gray-700 focus:ring-0 focus:border-gray-300"
              v-model="minPrice"
            />
            <span class="mx-2 text-orange-500">-</span>
            <input
              type="number"
              placeholder="Max"
              class="w-20 h-8 border-gray-300 rounded-sm text-gray-700 focus:ring-0 focus:border-gray-300"
              v-model="maxPrice"
            />
            <button
              type="submit"
              class="bg-orange-600 px-3 py-1 ml-4 text-white rounded-sm hover:bg-orange-700"
            >
              <i class="fa-solid fa-play"></i>
            </button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</template>
