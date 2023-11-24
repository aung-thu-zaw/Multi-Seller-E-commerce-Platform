<template>
  <!-- Chat -->
  <li class="max-w-lg flex gap-x-2 sm:gap-x-4 me-11">
    <img
      class="inline-block h-9 w-9 rounded-full"
      src="https://images.unsplash.com/photo-1541101767792-f9b2b1c4f127?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&&auto=format&fit=facearea&facepad=3&w=300&h=300&q=80"
      alt="Image Description"
    />

    <div>
      <!-- Card -->
      <div class="bg-white border border-gray-200 rounded-2xl p-4 space-y-3 shadow-md">
        <h2 class="font-medium text-gray-800">How can we help?</h2>
        <div class="space-y-1.5">
          <p class="mb-1.5 text-sm text-gray-800">You can ask questions like:</p>
          <ul class="list-disc list-outside space-y-1.5 ps-3.5">
            <li class="text-sm text-gray-800">What's Preline UI?</li>

            <li class="text-sm text-gray-800">How many Starter Pages & Examples are there?</li>

            <li class="text-sm text-gray-800">Is there a PRO version?</li>
          </ul>
        </div>
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
