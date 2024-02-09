<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <div class="grid grid-cols-4 gap-3 w-full">
    <div
      class="border font-bold text-sm text-gray-700 p-5 rounded-md bg-white hover:shadow-lg hover:scale-105 transition-all"
    >
      <Link as="button" href="#" class="flex flex-col items-center justify-center space-y-3 w-full">
        <span
          class="border bg-orange-600 text-white w-10 h-10 p-5 flex items-center justify-center rounded-full ring-1 ring-orange-300 shadow"
        >
          <i class="fa-solid fa-boxes-packing"></i>
        </span>

        <p class="text-center">{{ __('My Account') }}</p>
      </Link>
    </div>

    <div
      class="border font-bold text-sm text-gray-700 p-5 rounded-md bg-white hover:shadow-lg hover:scale-105 transition-all"
    >
      <Link as="button" href="#" class="flex flex-col items-center justify-center space-y-3 w-full">
        <span
          class="border bg-orange-600 text-white w-10 h-10 p-5 flex items-center justify-center rounded-full ring-1 ring-orange-300 shadow"
        >
          <i class="fa-solid fa-boxes-packing"></i>
        </span>

        <p class="text-center">{{ __('My Orders') }}</p>
      </Link>
    </div>

    <div
      class="border font-bold text-sm text-gray-700 p-5 rounded-md bg-white hover:shadow-lg hover:scale-105 transition-all"
    >
      <Link as="button" href="#" class="flex flex-col items-center justify-center space-y-3 w-full">
        <span
          class="border bg-orange-600 text-white w-10 h-10 p-5 flex items-center justify-center rounded-full ring-1 ring-orange-300 shadow"
        >
          <i class="fa-solid fa-boxes-packing"></i>
        </span>

        <p class="text-center">{{ __('My Returns') }}</p>
      </Link>
    </div>

    <div
      class="border font-bold text-sm text-gray-700 p-5 rounded-md bg-white hover:shadow-lg hover:scale-105 transition-all"
    >
      <Link as="button" href="#" class="flex flex-col items-center justify-center space-y-3 w-full">
        <span
          class="border bg-orange-600 text-white w-10 h-10 p-5 flex items-center justify-center rounded-full ring-1 ring-orange-300 shadow"
        >
          <i class="fa-solid fa-boxes-packing"></i>
        </span>

        <p class="text-center">{{ __('My Cancellations') }}</p>
      </Link>
    </div>

    <div
      class="border font-bold text-sm text-gray-700 p-5 rounded-md bg-white hover:shadow-lg hover:scale-105 transition-all"
    >
      <Link as="button" href="#" class="flex flex-col items-center justify-center space-y-3 w-full">
        <span
          class="border bg-orange-600 text-white w-10 h-10 p-5 flex items-center justify-center rounded-full ring-1 ring-orange-300 shadow"
        >
          <i class="fa-solid fa-boxes-packing"></i>
        </span>

        <p class="text-center">{{ __('My Payment Options') }}</p>
      </Link>
    </div>

    <div
      class="border font-bold text-sm text-gray-700 p-5 rounded-md bg-white hover:shadow-lg hover:scale-105 transition-all"
    >
      <Link as="button" href="#" class="flex flex-col items-center justify-center space-y-3 w-full">
        <span
          class="border bg-orange-600 text-white w-10 h-10 p-5 flex items-center justify-center rounded-full ring-1 ring-orange-300 shadow"
        >
          <i class="fa-solid fa-boxes-packing"></i>
        </span>

        <p class="text-center">{{ __('Change Password') }}</p>
      </Link>
    </div>

    <div
      class="border font-bold text-sm text-gray-700 p-5 rounded-md bg-white hover:shadow-lg hover:scale-105 transition-all"
    >
      <Link as="button" href="#" class="flex flex-col items-center justify-center space-y-3 w-full">
        <span
          class="border bg-orange-600 text-white w-10 h-10 p-5 flex items-center justify-center rounded-full ring-1 ring-orange-300 shadow"
        >
          <i class="fa-solid fa-boxes-packing"></i>
        </span>

        <p class="text-center">{{ __('My Vouchers') }}</p>
      </Link>
    </div>

    <div
      class="border font-bold text-sm text-gray-700 p-5 rounded-md bg-white hover:shadow-lg hover:scale-105 transition-all"
    >
      <Link as="button" href="#" class="flex flex-col items-center justify-center space-y-3 w-full">
        <span
          class="border bg-orange-600 text-white w-10 h-10 p-5 flex items-center justify-center rounded-full ring-1 ring-orange-300 shadow"
        >
          <i class="fa-solid fa-boxes-packing"></i>
        </span>

        <p class="text-center">{{ __('Address Book') }}</p>
      </Link>
    </div>

    <div
      class="border font-bold text-sm text-gray-700 p-5 rounded-md bg-white hover:shadow-lg hover:scale-105 transition-all"
    >
      <Link as="button" href="#" class="flex flex-col items-center justify-center space-y-3 w-full">
        <span
          class="border bg-orange-600 text-white w-10 h-10 p-5 flex items-center justify-center rounded-full ring-1 ring-orange-300 shadow"
        >
          <i class="fa-solid fa-boxes-packing"></i>
        </span>

        <p class="text-center">{{ __('Notification Settings') }}</p>
      </Link>
    </div>
  </div>
</template>
