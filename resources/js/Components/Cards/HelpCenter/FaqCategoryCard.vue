<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({ faqCategories: Object, faqSubcategory: Object })
</script>

<template>
  <div
    class="hs-overlay hs-overlay-open:translate-x-0 transition-all duration-300 transform w-full bg-white overflow-y-auto block translate-x-0 end-auto bottom-0 [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300"
  >
    <div class="bg-orange-600 text-white py-3 w-full">
      <h3 class="flex-none text-center text-lg font-semibold">
        <span class="text-sm">
          <i class="fa-solid fa-list"></i>
        </span>
        {{ __('Categories') }}
      </h3>
    </div>
    <nav
      class="hs-accordion-group p-6 w-full flex flex-col flex-wrap"
      data-hs-accordion-always-open
    >
      <ul class="space-y-1.5">
        <li
          v-for="faqCategory in faqCategories"
          :key="faqCategory.id"
          class="hs-accordion"
          :id="faqCategory.name + '-accordion'"
        >
          <button
            type="button"
            class="hs-accordion-toggle hs-accordion-active:hover:bg-transparent w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-md font-semibold text-gray-700 rounded-lg"
          >
            {{ faqCategory.name }}
            <svg
              class="hs-accordion-active:block ms-auto hidden w-4 h-4 text-gray-600 group-hover:text-gray-500"
              xmlns="http://www.w3.org/2000/svg"
              width="20"
              height="20"
              viewBox="0 0 20 20"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <path d="m18 15-6-6-6 6" />
            </svg>

            <svg
              class="hs-accordion-active:hidden ms-auto block w-4 h-4 text-gray-600 group-hover:text-gray-500"
              width="20"
              height="20"
              viewBox="0 0 20 20"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M2 5L8.16086 10.6869C8.35239 10.8637 8.64761 10.8637 8.83914 10.6869L15 5"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
              ></path>
            </svg>
          </button>

          <div
            :id="faqCategory.name + '-accordion'"
            class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300"
            :class="{
              block: faqSubcategory?.faq_category_id === faqCategory?.id,
              hidden: faqSubcategory?.faq_category_id !== faqCategory?.id
            }"
          >
            <ul class="pt-2 ps-2">
              <li v-for="faqSubcategory in faqCategory.faq_subcategories" :key="faqSubcategory.id">
                <Link
                  :href="route('faqs.index')"
                  :data="{
                    search_question: $page.props.ziggy.query.search_question,
                    category: faqSubcategory.slug
                  }"
                  class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg font-semibold hover:bg-gray-100"
                  :class="{
                    'text-orange-600': $page.props.ziggy.query.category === faqSubcategory.slug,

                    'text-gray-700': $page.props.ziggy.query.category !== faqSubcategory.slug
                  }"
                >
                  {{ faqSubcategory.name }}
                </Link>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </nav>
  </div>
</template>
