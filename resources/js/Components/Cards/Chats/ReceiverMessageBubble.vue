<script setup>
defineProps({ message: Object })
</script>

<template>
  <!-- Chat -->
  <li class="max-w-lg flex gap-x-2 sm:gap-x-4 me-11">
    <img
      class="inline-block h-9 w-9 rounded-full object-cover"
      :src="
        $page.url.startsWith('/seller/chat-inbox')
          ? message?.customer?.avatar
          : message?.store?.avatar
      "
      alt="receiver-image"
    />

    <div>
      <!-- Card -->
      <div class="inline-block bg-white border border-gray-200 rounded-2xl p-4 space-y-3 shadow-md">
        <p class="text-sm text-gray-800">{{ message?.message }}</p>
      </div>
      <!-- End Card -->

      <span class="mt-1.5 flex items-center gap-x-1 text-xs text-gray-500">
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
  </li>
  <!-- End Chat -->
</template>
