<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import Pagination from '@/Components/Paginations/Pagination.vue'
import Breadcrumb from '@/Components/Breadcrumbs/Breadcrumb.vue'
import BreadcrumbItem from '@/Components/Breadcrumbs/BreadcrumbItem.vue'
import FaqCategoryCard from '@/Components/Cards/HelpCenter/FaqCategoryCard.vue'
import FaqSearchBox from '@/Components/Forms/SearchBoxs/FaqSearchBox.vue'
import { Head, Link } from '@inertiajs/vue3'

defineProps({
  faqCategories: Object,
  faqSubcategory: Object,
  faqContents: Object
})
</script>

<template>
  <Head :title="__('FAQs')" />

  <AppLayout>
    <section id="faq-content" class="py-10">
      <div class="w-[1280px] mx-auto">
        <h1 class="font-bold text-2xl w-full mb-10">
          {{ __('Frequently Ask Questions') }}
        </h1>

        <div class="flex items-start justify-between space-x-10">
          <div class="min-w-[300px] border border-gray-200 rounded-md overflow-hidden shadow-sm">
            <!-- Faq Categories -->
            <FaqCategoryCard :faqCategories="faqCategories" :faqSubcategory="faqSubcategory" />
          </div>

          <div class="w-full">
            <!-- Question Search Input -->
            <FaqSearchBox />

            <p
              v-show="$page.props.ziggy.query?.search_question"
              class="text-sm font-medium text-gray-700 ml-auto my-5"
            >
              {{
                __(':total question(s) found for search result :result', {
                  total: faqContents.total,
                  result: '"' + $page.props.ziggy.query?.search_question + '"'
                })
              }}
            </p>

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
                  <BreadcrumbItem
                    v-show="faqSubcategory?.faq_category ?? ''"
                    :label="faqSubcategory?.faq_category.name ?? ''"
                  />
                  <BreadcrumbItem v-show="faqSubcategory" :label="faqSubcategory?.name ?? ''" />
                  <BreadcrumbItem
                    :label="
                      $page.props.ziggy.query.search_question ? __('Search Results') : __('All')
                    "
                  />
                </Breadcrumb>
              </div>
              <!-- Faq Breadcrumb End -->

              <div v-if="faqContents.data.length" class="w-full">
                <!-- Faq Questions -->
                <ul class="list-disc list-inside space-y-4 text-gray-700">
                  <li
                    v-for="faqContent in faqContents.data"
                    :key="faqContent.id"
                    class="hover:text-orange-600 text-sm font-medium"
                  >
                    <Link :href="route('faqs.show', faqContent.slug)">
                      {{ faqContent.question }}
                    </Link>
                  </li>
                </ul>

                <!-- Question Pagination -->
                <div class="my-5 py-5">
                  <Pagination :links="faqContents.links" />
                </div>
              </div>

              <div v-else class="py-20">
                <p class="text-center font-bold text-md text-red-600">
                  <i class="fa-solid fa-file-circle-xmark"></i>
                  {{ __("We're sorry we can't find any matches for your filter term.") }}
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </AppLayout>
</template>
