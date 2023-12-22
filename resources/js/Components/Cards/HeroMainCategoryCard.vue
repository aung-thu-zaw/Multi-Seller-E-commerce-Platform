<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import { computed, reactive, ref } from 'vue'

const params = reactive({
  sort: usePage().props.ziggy.query.sort ? usePage().props.ziggy.query.sort : 'id',
  direction: usePage().props.ziggy.query.direction ? usePage().props.ziggy.query.direction : 'desc',
  view: usePage().props.ziggy.query.view ? usePage().props.ziggy.query.view : 'grid'
})

const filteredMainCategories = computed(() =>
  usePage()
    .props?.parentCategory.filter((category) => category.parent_id === null)
    .slice(0, 8)
)

const hoveredCategory = ref(null)
const timeoutId = ref(null)

const setHoveredCategory = (category) => {
  hoveredCategory.value = category
  clearTimeout(timeoutId.value)
}

const clearHoveredCategory = () => {
  timeoutId.value = setTimeout(() => {
    hoveredCategory.value = null
  }, 200)
}

const isCategoryHovered = (category) => {
  return category === hoveredCategory.value
}
</script>

<template>
  <aside class="w-1/4 p-3 pt-1 rounded-md bg-white border border-gray-200 z-30">
    <div
      v-for="category in filteredMainCategories"
      :key="category.id"
      class="flex items-center justify-center rounded-sm space-y-3"
      @mouseover="setHoveredCategory(category)"
      @mouseleave="clearHoveredCategory"
    >
      <!-- First Category -->
      <div
        class="flex items-center justify-center w-[35px] h-[35px] rounded-full shadow bg-gray-100 mr-2 overflow-hidden border mt-2"
      >
        <img :src="category.image" class="h-full object-cover" />
      </div>
      <Link
        href="#"
        :data="{
          sort: params.sort,
          direction: params.direction,
          view: params.view
        }"
        id="dropdownHoverButton"
        :data-dropdown-toggle="'dropdownHover' + category.id"
        data-dropdown-trigger="hover"
        data-dropdown-placement="right-end"
        class="w-[80%] font-medium text-sm text-center inline-flex items-center py-2 hover:text-orange-600"
        type="button"
      >
        {{ category.name }}
        <svg
          class="w-4 h-4 ml-auto"
          aria-hidden="true"
          fill="currentColor"
          viewBox="0 0 20 20"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            fill-rule="evenodd"
            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
            clip-rule="evenodd"
          ></path>
        </svg>
      </Link>

      <!-- Second Category -->
      <div
        v-show="isCategoryHovered(category)"
        class="z-30 border border-gray-200 bg-white divide-y divide-gray-100 rounded-lg p-5 w-[920px] h-[400px] scrollbar overflow-auto fixed left-[22.7rem] top-[11.45rem]"
      >
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
          <div
            v-for="secondChildCategory in category.children"
            :key="secondChildCategory.id"
            class="p-3 mb-3"
          >
            <div class="flex items-center">
              <div
                class="flex items-center justify-center w-[35px] h-[35px] rounded-full bg-gray-100 mr-2 shadow overflow-hidden"
              >
                <img :src="secondChildCategory.image" class="h-full object-cover" />
              </div>
              <Link
                href="#"
                :data="{
                  sort: params.sort,
                  direction: params.direction,
                  view: params.view
                }"
                class="font-bold text-gray-700 text-sm hover:text-orange-500 hover:underline cursor-pointer"
              >
                {{ secondChildCategory.name }}
              </Link>
            </div>

            <ul class="list-disc pl-14">
              <li
                v-for="thirdChildCategory in secondChildCategory.children"
                :key="thirdChildCategory"
                class=""
              >
                <Link
                  href="#"
                  :data="{
                    sort: params.sort,
                    direction: params.direction,
                    view: params.view
                  }"
                  class="font-medium text-[.85rem] text-gray-700 hover:underline hover:text-orange-500 transition-all"
                >
                  {{ thirdChildCategory.name }}
                </Link>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </aside>
</template>
