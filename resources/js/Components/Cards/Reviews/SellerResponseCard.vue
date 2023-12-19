<script setup>
defineProps({ response: Object })
</script>

<template>
  <div class="pl-14 w-full">
    <div class="w-full flex items-start justify-between">
      <div class="flex items-center space-x-3 mb-3 ml-4">
        <!-- avatar -->
        <span
          class="w-10 h-10 text-sm text-white bg-slate-200 inline-flex items-center justify-center rounded-full ring-2"
        >
          <img
            class="w-full h-full object-cover rounded-full align-middle border-none shadow-lg ring-2 ring-orange-300"
            :src="response?.store?.avatar"
            alt="store-avatar"
          />
        </span>

        <div class="flex flex-col items-start">
          <h3 class="font-bold text-gray-700">{{ response?.store?.store_name }}</h3>
          <span class="text-xs font-medium text-orange-500"> Response from store </span>
        </div>
      </div>

      <div class="flex items-center space-x-2">
        <p class="font-semibold text-sm text-gray-700">{{ response?.created_at }}</p>

        <div class="hs-dropdown relative inline-flex">
          <button
            id="hs-dropdown-custom-icon-trigger"
            type="button"
            class="hs-dropdown-toggle flex justify-center items-center w-9 h-9 text-sm font-semibold text-gray-800"
          >
            <svg
              class="flex-none w-4 h-4 text-gray-600"
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
              <circle cx="12" cy="12" r="1" />
              <circle cx="12" cy="5" r="1" />
              <circle cx="12" cy="19" r="1" />
            </svg>
          </button>

          <div
            class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-[15rem] bg-white shadow-md rounded-lg p-2 mt-2 border"
            aria-labelledby="hs-dropdown-custom-icon-trigger"
          >
            <a
              class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm font-medium text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
              href="#"
            >
              Report Abuse
            </a>
          </div>
        </div>
      </div>
    </div>

    <p class="text-sm font-medium text-gray-700 pl-16">
      {{ response?.response }}
    </p>
  </div>
</template>
