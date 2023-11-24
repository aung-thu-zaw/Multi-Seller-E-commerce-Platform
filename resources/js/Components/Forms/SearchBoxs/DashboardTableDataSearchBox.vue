<script setup>
import { router, usePage } from '@inertiajs/vue3'
import { ref, watch } from 'vue'

const props = defineProps({
  to: {
    type: String,
    required: true
  },

  placeholder: {
    type: String,
    default: 'Search by name ...'
  }
})

const search = ref(usePage().props.ziggy.query?.search)

const delayedSearch = ref(null)

const handleSearch = () => {
  if (delayedSearch.value) {
    clearTimeout(delayedSearch.value)
  }
  delayedSearch.value = setTimeout(() => {
    router.get(
      route(props.to),
      {
        search: search.value,
        per_page: usePage().props.ziggy.query?.per_page,
        sort: usePage().props.ziggy.query?.sort,
        direction: usePage().props.ziggy.query?.direction,
        created_from: usePage().props.ziggy.query?.created_from,
        created_until: usePage().props.ziggy.query?.created_until,
        deleted_from: usePage().props.ziggy.query?.deleted_from,
        deleted_until: usePage().props.ziggy.query?.deleted_until,
        filter_by_status: usePage().props.ziggy.query?.filter_by_status
      },
      {
        replace: true,
        preserveState: true
      }
    )
  }, 400)
}

const removeSearch = () => {
  search.value = ''
  router.get(
    route(props.to),
    {
      per_page: usePage().props.ziggy.query?.per_page,
      sort: usePage().props.ziggy.query?.sort,
      direction: usePage().props.ziggy.query?.direction,
      created_from: usePage().props.ziggy.query?.created_from,
      created_until: usePage().props.ziggy.query?.created_until,
      deleted_from: usePage().props.ziggy.query?.deleted_from,
      deleted_until: usePage().props.ziggy.query?.deleted_until,
      filter_by_status: usePage().props.ziggy.query?.filter_by_status
    },
    {
      replace: true,
      preserveState: true
    }
  )
}

watch(
  () => search.value,
  () => {
    if (search.value === '') {
      removeSearch()
    } else {
      handleSearch()
    }
  }
)
</script>

<template>
  <div class="min-w-[300px] max-w-[400px] w-full">
    <form>
      <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">
        Search
      </label>
      <div class="relative">
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
          v-show="search"
          @click="removeSearch"
          class="absolute inset-y-0 right-0 flex items-center pr-5 hover:cursor-pointer text-gray-500 hover:text-red-600 transition-all"
        >
          <i class="fa-solid fa-circle-xmark"></i>
        </button>
        <input
          type="text"
          id="default-search"
          class="block w-full p-4 pl-10 text-xs text-gray-900 border border-gray-300 rounded-md bg-gray-50 focus:ring-2 focus:ring-orange-300 focus:border-orange-400 transition-all"
          :placeholder="placeholder"
          required
          v-model="search"
        />
      </div>
    </form>
  </div>
</template>
