<script setup>
import { router, usePage } from '@inertiajs/vue3'
import { reactive } from 'vue'

const props = defineProps({ store: Object })

const params = reactive({
  search: usePage().props.ziggy.query?.search,
  sort: usePage().props.ziggy.query.sort ?? 'newest_arrivals',
  category: usePage().props.ziggy.query?.category,
  brand: usePage().props.ziggy.query?.brand,
  rating: usePage().props.ziggy.query?.rating,
  price: usePage().props.ziggy.query?.price,
  tab: 'all-products',
  view: usePage().props.ziggy.query.view ?? 'grid'
})

const handleSearch = () => {
  router.get(
    route('stores.show', { store: props.store?.slug }),
    {
      search: params.search,
      sort: params.sort,
      tab: params.tab,
      category: params.category,
      brand: params.brand,
      rating: params.rating,
      price: params.price,
      view: params.view
    },
    { preserveScroll: true }
  )
}

const handelRemoveSearch = () => {
  params.search = ''
  router.get(
    route('stores.show', { store: props.store?.slug }),
    {
      sort: params.sort,
      tab: params.tab,
      category: params.category,
      brand: params.brand,
      rating: params.rating,
      price: params.price,
      view: params.view
    },
    { preserveScroll: true }
  )
}
</script>

<template>
  <div class="relative w-[400px]">
    <form @submit.prevent="handleSearch" class="flex items-center">
      <div class="relative w-full mr-2">
        <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none">
          <svg
            class="w-4 h-4 text-gray-500"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 20 20"
          >
            <path
              stroke="currentColor"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
            />
          </svg>
        </div>

        <button
          v-show="params.search"
          @click="handelRemoveSearch"
          type="button"
          class="absolute inset-y-0 right-0 flex items-center pr-5 hover:cursor-pointer text-gray-500 hover:text-red-600 transition-all"
        >
          <i class="fa-solid fa-circle-xmark"></i>
        </button>

        <input
          type="text"
          id="default-search"
          class="block w-full p-3.5 pl-10 text-sm text-gray-900 border border-gray-300 rounded-md bg-gray-50 font-semibold focus:ring-2 focus:ring-orange-300 focus:border-orange-400 transition-all"
          :placeholder="__('Search Product')"
          v-model="params.search"
        />
      </div>

      <button type="submit" class="bg-orange-600 p-4 rounded-md focus:ring-2 focus:ring-orange-300">
        <svg
          class="w-4 h-4 text-white font-bold"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 20 20"
        >
          <path
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
          />
        </svg>
      </button>
    </form>
  </div>
</template>
