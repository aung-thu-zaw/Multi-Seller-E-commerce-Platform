<script setup>
</script>

<template>
  <div class="hs-dropdown relative inline-flex">
    <button
      id="hs-dropdown-custom-icon-trigger"
      type="button"
      class="hs-dropdown-toggle flex justify-center items-center text-sm font-semibold text-gray-700"
    >
      <i class="fa-solid fa-filter mr-2"></i>
      Filter Star : &nbsp; <span class="text-orange-500"> All Star </span>
    </button>

    <div
      class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-[15rem] bg-white shadow-md rounded-lg p-2 mt-2 border"
      aria-labelledby="hs-dropdown-custom-icon-trigger"
    >
      <a
        class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm font-medium text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
        href="#"
      >
        1 Star
      </a>
      <a
        class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm font-medium text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
        href="#"
      >
        2 Star
      </a>
      <a
        class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm font-medium text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
        href="#"
      >
        3 Star
      </a>
      <a
        class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm font-medium text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
        href="#"
      >
        4 Star
      </a>
      <a
        class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm font-medium text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
        href="#"
      >
        5 Star
      </a>
    </div>
  </div>
</template>
