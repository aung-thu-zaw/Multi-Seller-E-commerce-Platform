<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <section id="flash-sales" class="my-16">
    <div
      class="container max-w-screen-xl mx-auto border border-gray-200 bg-white rounded-md shadow-md"
    >
      <!-- Title -->
      <div class="text-slate-600 flex items-center justify-between border-b px-6 py-3">
        <h2 class="text-2xl font-bold">
          <i class="fa-solid fa-bolt text-orange-600 animate-pulse"></i>
          {{ __('Flash Sales') }}
        </h2>
        <div class="flex items-center space-x-5">
          <div
            class="flex flex-col items-center justify-between font-semibold bg-orange-600 text-white ring-2 ring-orange-200 w-14 h-14 p-3 rounded-sm shadow"
          >
            <span class="text-sm">10</span>
            <span class="text-[.7rem]">Days</span>
          </div>
          <div
            class="flex flex-col items-center justify-between font-semibold bg-orange-600 text-white ring-2 ring-orange-200 w-14 h-14 p-3 rounded-sm shadow"
          >
            <span class="text-sm">5</span>
            <span class="text-[.7rem]">Hours</span>
          </div>
          <div
            class="flex flex-col items-center justify-between font-semibold bg-orange-600 text-white ring-2 ring-orange-200 w-14 h-14 p-3 rounded-sm shadow"
          >
            <span class="text-sm">3</span>
            <span class="text-[.7rem]">Minutes</span>
          </div>
          <div
            class="flex flex-col items-center justify-between font-semibold bg-orange-600 text-white ring-2 ring-orange-200 w-14 h-14 p-3 rounded-sm shadow"
          >
            <span class="text-sm animate-pulse">34</span>
            <span class="text-[.7rem]">Seconds</span>
          </div>
        </div>
        <Link
          href="#"
          class="font-bold text-sm rounded-full px-4 py-2 text-orange-600 border border-orange-600 hover:bg-orange-600 hover:text-white transition-all"
        >
          {{ __('Shop More') }}
          <i class="fa-solid fa-angles-right ml-1"></i>
        </Link>
      </div>

      <div class="grid grid-cols-5 gap-4 p-5">
        <!-- <ProductGridCard /> -->
      </div>
    </div>
  </section>
</template>
