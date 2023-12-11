<script setup>
import { usePage, router } from '@inertiajs/vue3'
import { reactive } from 'vue'

const params = reactive({
  search_question: usePage().props.ziggy.query?.search_question,
  category: usePage().props.ziggy.query?.category,
  page: usePage().props.ziggy.query?.page
})

// Handle Search
const handleSearch = () => {
  router.get(
    route('faqs.index'),
    {
      search_question: params.search_question,
      category: params.category
    },
    {
      replace: true,
      preserveState: true
    }
  )
}

// Remove Search Param
const removeSearch = () => {
  params.search_question = ''
  router.get(
    route('faqs.index'),
    {
      category: params.category
    },
    {
      replace: true,
      preserveState: true
    }
  )
}
</script>

<template>
  <div class="relative w-[700px] mb-5">
    <form @submit.prevent="handleSearch" class="flex items-center">
      <div class="relative w-full mr-2">
        <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none">
          <svg
            class="w-4 h-4 text-gray-500"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 20 20"
          >
            <path
              stroke="currentColor"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
            />
          </svg>
        </div>

        <button
          type="button"
          @click="removeSearch"
          v-show="params.search_question"
          class="absolute inset-y-0 right-0 flex items-center pr-5 hover:cursor-pointer text-gray-500 hover:text-red-600 transition-all"
        >
          <i class="fa-solid fa-circle-xmark"></i>
        </button>

        <input
          type="text"
          id="default-search"
          class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-md bg-gray-50 font-semibold focus:ring-2 focus:ring-orange-300 focus:border-orange-400 transition-all"
          :placeholder="__('Search for a question')"
          v-model="params.search_question"
        />
      </div>

      <button type="submit" class="bg-orange-600 p-4 rounded-md focus:ring-2 focus:ring-orange-300">
        <svg
          class="w-5 h-5 text-white font-bold"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 20 20"
        >
          <path
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
          />
        </svg>
      </button>
    </form>
  </div>
</template>
