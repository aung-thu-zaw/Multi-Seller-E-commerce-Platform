<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import Breadcrumb from '@/Components/Breadcrumbs/Breadcrumb.vue'
import BreadcrumbItem from '@/Components/Breadcrumbs/BreadcrumbItem.vue'
import FaqCategoryCard from '@/Components/Cards/HelpCenter/FaqCategoryCard.vue'
import FaqSearchBox from '@/Components/Forms/SearchBoxs/FaqSearchBox.vue'
import { Head, Link } from '@inertiajs/vue3'

defineProps({
  faqContent: Object,
  faqCategories: Object,
  relatedFaqContents: Object
})
</script>

<template>
  <Head :title="__(faqContent.question)" />

  <AppLayout>
    <section id="faq-content" class="py-10">
      <div class="w-[1280px] mx-auto">
        <h1 class="font-bold text-2xl w-full mb-10">
          {{ __('Frequently Ask Questions') }}
        </h1>

        <div class="flex items-start justify-between space-x-10">
          <div class="min-w-[300px] border border-gray-200 rounded-md overflow-hidden shadow-sm">
            <!-- Faq Categories -->
            <FaqCategoryCard
              :faqCategories="faqCategories"
              :faqSubcategory="faqContent.faq_subcategory"
            />
          </div>

          <div class="w-full">
            <!-- Question Search Input -->
            <FaqSearchBox />

            <!-- Result -->
            <div class="border border-gray-300 p-6 bg-white w-full rounded-md shadow-md">
              <!-- Faq Breadcrumb Start -->
              <div class="mb-6">
                <Breadcrumb
                  to="faqs.index"
                  :data="{ search_question: $page.props.ziggy.query?.search_question }"
                  icon="fa-list"
                  label="Categories"
                >
                  <BreadcrumbItem :label="faqContent?.faq_subcategory?.faq_category?.name ?? ''" />
                  <BreadcrumbItem :label="faqContent?.faq_subcategory?.name ?? ''" />
                  <BreadcrumbItem :label="faqContent?.question" />
                </Breadcrumb>
              </div>
              <!-- Faq Breadcrumb End -->

              <div v-show="faqContent" class="w-full">
                <h1 class="font-bold text-md text-gray-700 mb-5">
                  {{ faqContent.question }}
                </h1>

                <p v-html="faqContent.answer" class="text-[.9rem] text-gray-600"></p>

                <div class="my-10">
                  <!-- Rating -->
                  <div class="mt-2 flex flex-col justify-center items-center gap-x-2">
                    <h3 class="text-gray-800 font-semibold">Was this question helpful?</h3>

                    <div class="space-x-5 mt-3">
                      <button
                        type="button"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                      >
                        <svg
                          class="flex-shrink-0 w-4 h-4"
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
                          <path d="M7 10v12" />
                          <path
                            d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h2.76a2 2 0 0 0 1.79-1.11L12 2h0a3.13 3.13 0 0 1 3 3.88Z"
                          />
                        </svg>
                        Yes
                      </button>
                      <button
                        type="button"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                      >
                        <svg
                          class="flex-shrink-0 w-4 h-4"
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
                          <path d="M17 14V2" />
                          <path
                            d="M9 18.12 10 14H4.17a2 2 0 0 1-1.92-2.56l2.33-8A2 2 0 0 1 6.5 2H20a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-2.76a2 2 0 0 0-1.79 1.11L12 22h0a3.13 3.13 0 0 1-3-3.88Z"
                          />
                        </svg>
                        No
                      </button>
                    </div>
                  </div>
                  <!-- End Rating -->
                </div>

                <div class="mt-10">
                  <h3 class="font-bold text-gray-700 text-md mb-3">
                    {{ __('Related Questions') }} :
                  </h3>

                  <ul class="list-disc space-y-3 pl-3">
                    <li
                      v-for="relatedFaqContent in relatedFaqContents"
                      :key="relatedFaqContent.id"
                      class="hover:text-orange-600 hover:underline text-[.8rem] font-semibold text-gray-600"
                    >
                      <Link :href="route('faqs.show', relatedFaqContent.slug)">
                        {{ relatedFaqContent.question }}
                      </Link>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </AppLayout>
</template>
