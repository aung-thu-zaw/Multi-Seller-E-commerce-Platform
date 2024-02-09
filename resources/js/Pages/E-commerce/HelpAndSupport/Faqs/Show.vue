<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import Breadcrumb from '@/Components/Breadcrumbs/Breadcrumb.vue'
import BreadcrumbItem from '@/Components/Breadcrumbs/BreadcrumbItem.vue'
import FaqCategoryCard from '@/Components/Cards/HelpCenter/FaqCategoryCard.vue'
import FaqSearchBox from '@/Components/Forms/SearchBoxs/FaqSearchBox.vue'
import FaqRating from '@/Components/Ratings/FaqRating.vue'
import { Head, Link } from '@inertiajs/vue3'

defineProps({
  faqContent: Object,
  faqFeedback: Object,
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

                <FaqRating :faqContent="faqContent" :faqFeedback="faqFeedback" />

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
