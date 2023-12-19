<script setup>
import { useFormatFunctions } from '@/Composables/useFormatFunctions'
import { Link } from '@inertiajs/vue3'

defineProps({ store: Object })

const { formatToTitleCase } = useFormatFunctions()
</script>

<template>
  <div class="hs-dropdown relative inline-flex">
    <button
      id="hs-dropdown-custom-icon-trigger"
      type="button"
      class="hs-dropdown-toggle flex justify-center items-center text-sm font-semibold text-gray-700"
    >
      <i class="fa-solid fa-sort mr-2"></i>
      Sort : &nbsp;
      <span class="text-orange-500 capitalize">
        {{ formatToTitleCase($page.props.ziggy.query?.review_sort) }}
      </span>
    </button>

    <div
      class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-[15rem] bg-white shadow-md rounded-lg p-2 mt-2 border"
      aria-labelledby="hs-dropdown-custom-icon-trigger"
    >
      <Link
        as="button"
        :href="route('stores.show', { store: store?.slug })"
        :data="{
          tab: 'product-rating-and-reviews',
          review_sort: 'recent',
          rating: $page.props.ziggy.query?.rating
        }"
        class="w-full flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm font-medium text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
        preserve-scroll
      >
        Recent
      </Link>
      <Link
        as="button"
        :href="route('stores.show', { store: store?.slug })"
        :data="{
          tab: 'product-rating-and-reviews',
          review_sort: 'rating_high_to_low',
          rating: $page.props.ziggy.query?.rating
        }"
        class="w-full flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm font-medium text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
        preserve-scroll
      >
        Rating: High to Low
      </Link>
      <Link
        as="button"
        :href="route('stores.show', { store: store?.slug })"
        :data="{
          tab: 'product-rating-and-reviews',
          review_sort: 'rating_low_to_high',
          rating: $page.props.ziggy.query?.rating
        }"
        class="w-full flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm font-medium text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
        preserve-scroll
      >
        Rating: Low to High
      </Link>
    </div>
  </div>
</template>
