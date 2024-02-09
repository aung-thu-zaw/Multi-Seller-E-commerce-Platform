<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

const params = computed(() => {
  return {
    sort: usePage().props.ziggy.query.sort ?? 'newest_arrivals',
    view: usePage().props.ziggy.query.view ?? 'grid'
  }
})
</script>

<template>
  <li>
    <div
      class="hs-dropdown [--strategy:static] sm:[--strategy:absolute] [--adaptive:none] sm:[--trigger:hover]"
    >
      <button
        type="button"
        class="flex items-center text-gray-700 hover:text-gray-500 font-semibold"
      >
        <i class="fa-solid fa-list mr-1 text-xs"></i>
        {{ __('Shop By Categories') }}
        <svg
          class="ms-2 flex-shrink-0 w-4 h-4"
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
        class="hs-dropdown-menu transition-[opacity,margin] sm:border duration-[0.1ms] sm:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 w-full hidden z-30 top-full start-0 min-w-[15rem] bg-white sm:shadow-md rounded-lg py-2 sm:px-2 before:absolute border-2 border-slate-300 max-w-5xl overflow-auto max-h-[600px]"
      >
        <div class="grid grid-cols-3 gap-5 p-5">
          <div
            v-for="category in $page.props?.parentCategory"
            :key="category?.id"
            class="flex flex-col"
          >
            <div class="flex items-center">
              <img
                :src="category.image"
                alt="category-image"
                class="w-10 h-10 rounded-full ring-2 ring-orange-200 mr-2"
              />

              <Link
                class="font-bold text-lg text-gray-700 hover:underline hover:text-orange-500 transition-all"
                :href="route('products.category', category.slug)"
                :data="{
                  sort: params.sort,
                  view: params.view
                }"
              >
                {{ category?.name }}
              </Link>
            </div>
            <ul
              v-for="childCategory in category.children"
              :key="childCategory.id"
              class="list-disc pl-14"
            >
              <li>
                <Link
                  :href="route('products.category', childCategory.slug)"
                  :data="{
                    sort: params.sort,
                    view: params.view
                  }"
                  class="font-medium text-gray-600 hover:underline hover:text-orange-500 transition-all"
                >
                  {{ childCategory.name }}
                </Link>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </li>
</template>
