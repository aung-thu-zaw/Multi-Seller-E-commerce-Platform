<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({ store: Object })
</script>

<template>
  <div class="hs-dropdown relative inline-flex">
    <button
      id="hs-dropdown-custom-icon-trigger"
      type="button"
      class="hs-dropdown-toggle flex justify-center items-center text-sm font-semibold text-gray-700"
    >
      <i class="fa-solid fa-filter mr-2"></i>
      Filter Star : &nbsp;
      <span class="text-orange-500 capitalize"> {{ $page.props.ziggy.query?.rating }} Star </span>
    </button>

    <div
      class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-[15rem] bg-white shadow-md rounded-lg p-2 mt-2 border"
      aria-labelledby="hs-dropdown-custom-icon-trigger"
    >
      <Link
        as="button"
        :href="route('stores.show', { store: store?.slug })"
        :data="{
          tab: $page.props.ziggy.query?.tab,
          rating: 'all',
          review_sort: $page.props.ziggy.query?.review_sort
        }"
        preserve-scroll
        class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm font-medium text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 w-full"
      >
        All Star
      </Link>
      <Link
        as="button"
        :href="route('stores.show', { store: store?.slug })"
        :data="{
          tab: $page.props.ziggy.query?.tab,
          rating: '1',
          review_sort: $page.props.ziggy.query?.review_sort
        }"
        preserve-scroll
        class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm font-medium text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 w-full"
      >
        1 Star
      </Link>
      <Link
        as="button"
        :href="route('stores.show', { store: store?.slug })"
        :data="{
          tab: $page.props.ziggy.query?.tab,
          rating: '2',
          review_sort: $page.props.ziggy.query?.review_sort
        }"
        preserve-scroll
        class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm font-medium text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 w-full"
      >
        2 Star
      </Link>
      <Link
        as="button"
        :href="route('stores.show', { store: store?.slug })"
        :data="{
          tab: $page.props.ziggy.query?.tab,
          rating: '3',
          review_sort: $page.props.ziggy.query?.review_sort
        }"
        preserve-scroll
        class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm font-medium text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 w-full"
      >
        3 Star
      </Link>
      <Link
        as="button"
        :href="route('stores.show', { store: store?.slug })"
        :data="{
          tab: $page.props.ziggy.query?.tab,
          rating: '4',
          review_sort: $page.props.ziggy.query?.review_sort
        }"
        preserve-scroll
        class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm font-medium text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 w-full"
      >
        4 Star
      </Link>
      <Link
        as="button"
        :href="route('stores.show', { store: store?.slug })"
        :data="{
          tab: $page.props.ziggy.query?.tab,
          rating: '5',
          review_sort: $page.props.ziggy.query?.review_sort
        }"
        preserve-scroll
        class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm font-medium text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 w-full"
      >
        5 Star
      </Link>
    </div>
  </div>
</template>
