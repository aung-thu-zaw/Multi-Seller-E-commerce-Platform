<script setup>
import { router, usePage } from '@inertiajs/vue3'
import { ref, watch } from 'vue'

const blogSearch = ref(usePage().props.ziggy.query?.search_blog)

const delayedSearch = ref(null)

const handleSearch = () => {
  if (delayedSearch.value) {
    clearTimeout(delayedSearch.value)
  }
  delayedSearch.value = setTimeout(() => {
    router.get(
      route('blogs.index'),
      {
        search_blog: blogSearch.value,
        sort: usePage().props.ziggy.query?.sort,
        direction: usePage().props.ziggy.query?.direction,
        page: usePage().props.ziggy.query?.page,
        blog_category: usePage().props.ziggy.query?.blog_category,
        tag: usePage().props.ziggy.query?.tag,
        view: usePage().props.ziggy.query?.view
      },
      {
        replace: true,
        preserveState: true
      }
    )
  }, 400)
}

const removeSearch = () => {
  blogSearch.value = ''
  router.get(
    route('blogs.index'),
    {
      sort: usePage().props.ziggy.query?.sort,
      direction: usePage().props.ziggy.query?.direction,
      page: usePage().props.ziggy.query?.page,
      blog_category: usePage().props.ziggy.query?.blog_category,
      tag: usePage().props.ziggy.query?.tag,
      view: usePage().props.ziggy.query?.view
    },
    {
      replace: true,
      preserveState: true
    }
  )
}

watch(
  () => blogSearch.value,
  () => {
    if (blogSearch.value === '') {
      removeSearch()
    } else {
      handleSearch()
    }
  }
)
</script>

<template>
  <div class="relative w-[400px]">
    <form class="flex items-center">
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
          v-show="blogSearch"
          @click="removeSearch"
          class="absolute inset-y-0 right-0 flex items-center pr-5 hover:cursor-pointer text-gray-500 hover:text-red-600 transition-all"
        >
          <i class="fa-solid fa-circle-xmark"></i>
        </button>

        <input
          type="text"
          id="default-search"
          class="block w-full p-3.5 pl-10 text-sm text-gray-900 border border-gray-300 rounded-md bg-gray-50 font-semibold focus:ring-2 focus:ring-orange-300 focus:border-orange-400 transition-all"
          placeholder="Search Blog"
          v-model="blogSearch"
        />
      </div>
    </form>
  </div>
</template>
