<script setup>
import { router, usePage } from '@inertiajs/vue3'
import { computed, reactive, ref, watch } from 'vue'

// Define Veriables
const searchedKeyword = ref('')
const visibleHistory = ref(false)
const searchHistories = ref(usePage().props.searchHistories)

// Query String Parameter
const params = reactive({
  search: usePage().props.ziggy.query?.search,
  sort: usePage().props.ziggy.query.sort ? usePage().props.ziggy.query.sort : 'id',
  direction: usePage().props.ziggy.query.direction ? usePage().props.ziggy.query.direction : 'desc',
  view: usePage().props.ziggy.query.view ? usePage().props.ziggy.query.view : 'grid'
})

// Watch Search Input
watch(
  () => params.search,
  () => {
    searchedKeyword.value = params.search
  }
)

// Handle Search Box
const handleSearch = () => {
  if (params.search || searchedKeyword.value) {
    params.search = params.search ? params.search : searchedKeyword.value
    router.get(route('products.search'), {
      search: params.search,
      sort: params.sort,
      direction: params.direction,
      view: params.view
    })
  } else {
    router.get(route('home'))
  }
}

const handleUpdateSearchHistory = (historyId) => {
  router.patch(route('search-histories.update', { search_history: historyId }))
}

// Global Ecommerce Suggestion Search
const searchSuggestions = computed(() => {
  if (params.search?.length >= 1) {
    const lowerCaseSearch = params.search.toLowerCase()
    return searchHistories.value
      .filter(
        (history) =>
          history.keyword.toLowerCase().includes(lowerCaseSearch) &&
          history.user_id !== usePage().props.auth.user?.id
      )
      .slice(0, 20)
  } else {
    return []
  }
})

// Filtered User Search Histories
const filteredUserSearchHistories = computed(() => {
  const searchQuery = params.search?.toLowerCase()

  if (usePage().props.auth.user) {
    return params.search === ''
      ? searchHistories.value
          .filter((history) => history.user_id === usePage().props.auth.user.id)
          .slice(0, 10)
      : searchHistories.value
          .filter(
            (history) =>
              history.user_id === usePage().props.auth.user.id &&
              history.keyword.toLowerCase().includes(searchQuery)
          )
          .slice(0, 10)
  } else {
    return []
  }
})

// Handle Search Input
const handleSearchInputKeyword = (keyword) => {
  params.search = keyword

  handleSearch()
}

const highlightKeyword = (text) => {
  const keyword = searchedKeyword.value

  if (keyword && text.toLowerCase().includes(keyword.toLowerCase())) {
    const regex = new RegExp(keyword, 'gi')
    return text.replace(regex, (match) => `<span class="font-bold text-gray-800">${match}</span>`)
  }

  return text
}

// Remove User Search History
const handleRemoveSearchHistory = (index, historyId) => {
  const updatedSearchHistories = [...filteredUserSearchHistories.value]
  updatedSearchHistories.splice(index, 1)
  searchHistories.value = updatedSearchHistories
  handleUpdateSearchHistory(historyId)
}

const handleSearchHistoryBoxVisible = () => {
  visibleHistory.value = searchedKeyword.value || !visibleHistory.value ? true : false
}
</script>

<template>
  <div class="relative">
    <div
      v-if="visibleHistory"
      @click="visibleHistory = false"
      class="fixed top-0 bottom-0 left-0 right-0"
    ></div>

    <div class="min-w-[600px]">
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

          <input
            @focus="handleSearchHistoryBoxVisible"
            type="text"
            id="default-search"
            class="block w-full p-4 pl-10 text-xs text-gray-900 border border-gray-300 rounded-md bg-gray-50 font-semibold focus:ring-2 focus:ring-orange-300 focus:border-orange-400 transition-all"
            :placeholder="__('What are you looking for ?')"
            v-model="params.search"
            autocomplete="off"
          />
        </div>

        <button
          type="submit"
          class="bg-orange-600 p-4 rounded-md focus:ring-2 focus:ring-orange-300"
        >
          <svg
            class="w-4 h-4 text-white font-bold"
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

    <!-- Search History -->
    <div
      v-if="
        visibleHistory &&
        (searchSuggestions?.length || filteredUserSearchHistories?.length) &&
        searchedKeyword?.length > 0
      "
      class="border border-slate-300 shadow-lg absolute bg-white mt-3 rounded-md text-gray-600 py-3 h-auto w-full max-h-[500px] overflow-auto"
    >
      <ul class="text-xs font-medium">
        <li v-if="filteredUserSearchHistories?.length !== 0">
          <ul>
            <li class="px-5 py-3">
              <h3 class="font-bold text-slate-600">
                <i class="fa-solid fa-clock mr-3"></i>
                Your Search History
              </h3>
            </li>
            <li
              v-for="(history, index) in filteredUserSearchHistories"
              :key="history.id"
              class="hover:bg-orange-100 px-5 py-3 flex items-center justify-between cursor-pointer"
            >
              <span
                v-if="history.user_id === $page.props.auth.user?.id"
                class="flex items-center justify-between w-full"
              >
                <span
                  @click="handleSearchInputKeyword(history.keyword)"
                  v-html="highlightKeyword(history.keyword)"
                  class="w-full"
                >
                </span>

                <button
                  type="button"
                  @click="handleRemoveSearchHistory(index, history.id)"
                  class="w-2.5 h-2.5 rounded-full flex items-center justify-center text-sm hover:text-orange-500 hover:bg-orange-100 transition-all cursor-pointer"
                >
                  <i class="fa-solid fa-xmark"></i>
                </button>
              </span>
            </li>
          </ul>
        </li>

        <li
          v-show="filteredUserSearchHistories?.length && searchSuggestions?.length"
          class="px-5 py-3"
        >
          <hr />
        </li>

        <li v-if="params.search?.length >= 1 && searchSuggestions?.length !== 0">
          <ul>
            <li class="px-5 py-3">
              <h3 class="font-bold text-main-orange">
                <i class="fa-solid fa-lightbulb mr-3"></i>
                Suggest Search
              </h3>
            </li>

            <li
              v-for="history in searchSuggestions"
              :key="history.id"
              class="hover:bg-orange-100 px-5 py-3 cursor-pointer"
            >
              <p
                @click="handleSearchInputKeyword(history.keyword)"
                v-html="highlightKeyword(history.keyword)"
                class="w-full"
              ></p>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</template>
