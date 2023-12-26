<script setup>
defineProps({ message: Object })
</script>

<template>
  <!-- Chat -->
  <li class="flex ms-auto gap-x-2 sm:gap-x-4">
    <div class="grow text-end space-y-3">
      <div class="inline-flex flex-col justify-end">
        <!-- Card -->
        <div class="inline-block bg-orange-600 rounded-2xl p-4 shadow-md">
          <p class="text-sm text-white">{{ message?.message }}</p>
        </div>
        <!-- End Card -->

        <span class="mt-1.5 ms-auto flex items-center gap-x-1 text-xs text-gray-500">
          <svg
            class="flex-shrink-0 w-3 h-3"
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
            <path d="M18 6 7 17l-5-5" />
            <path d="m22 10-7.5 7.5L13 16" />
          </svg>
          Sent
        </span>
      </div>
    </div>

    <img
      class="inline-block h-9 w-9 rounded-full"
      :src="message?.customer?.avatar"
      alt="sender-image"
    />
  </li>
  <!-- End Chat -->
</template>
