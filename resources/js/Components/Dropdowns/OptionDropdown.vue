<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({ product: Object })
</script>

<template>
  <div class="hs-dropdown relative inline-flex">
    <button
      id="hs-dropdown-custom-icon-trigger"
      type="button"
      class="hs-dropdown-toggle flex justify-center items-center disabled:opacity-50 disabled:pointer-events-none space-x-1 text-xs px-3 shadow-md py-3 font-bold rounded-[4px] bg-slate-600 text-white ring-2 ring-slate-300"
    >
      <i class="fa-solid fa-sliders"></i>

      <svg
        class="hs-dropdown-open:rotate-180 w-4 h-4"
        xmlns="http://www.w3.org/2000/svg"
        width="24"
        height="24"
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        stroke-linecap="round"
        stroke-linejoin="round"
      >
        <path d="m6 9 6 6 6-6" />
      </svg>
    </button>
    <div
      class="hs-dropdown-menu z-50 border border-gray-300 transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-[15rem] bg-white shadow-md rounded-lg p-2 mt-2"
      aria-labelledby="hs-dropdown-custom-icon-trigger"
    >
      <Link
        class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
        :href="route('seller.product.images', product?.slug)"
      >
        <i class="fa-solid fa-images"></i>
        Product Images
      </Link>
      <Link
        class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
        href="#"
      >
        <i class="fa-solid fa-boxes-stacked"></i>
        Product Variants
      </Link>
    </div>
  </div>
</template>
