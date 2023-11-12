<script setup>
import English from "@/assets/images/united-state.png";
import Myanmar from "@/assets/images/myanmar.png";
</script>

<template>
  <div class="hs-dropdown relative inline-flex">
    <button
      id="hs-dropdown-custom-icon-trigger"
      type="button"
      class="hs-dropdown-toggle flex items-center whitespace-nowrap px-4 pt-2.5 pb-2 text-sm font-bold uppercase leading-normal text-white"
    >
      <i class="fa-solid fa-globe mr-1"></i>
    </button>

    <div
      class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden bg-white shadow-md rounded-lg p-2 mt-2"
      aria-labelledby="hs-dropdown-custom-icon-trigger"
    >
      <div>
        <div
          class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
        >
          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <img :src="English" alt="English" class="w-5 mr-2" />

              English
            </div>
          </div>
        </div>
        <div
          class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
        >
          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <img :src="Myanmar" alt="Myanmar" class="w-5 mr-2" />

              Myanmar
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
