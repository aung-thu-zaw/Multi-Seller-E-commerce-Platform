<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import HelpCenterQuestionSearchBox from '@/Components/Forms/SearchBoxs/HelpCenterQuestionSearchBox.vue'
import QuestionCategoryCard from '@/Components/Cards/HelpCenter/QuestionCategoryCard.vue'
import SelfServiceTools from '@/Components/Cards/HelpCenter/SelfServiceTools.vue'
import { Head, Link } from '@inertiajs/vue3'

defineProps({ topQuestions: Object, faqSubcategories: Object })
</script>

<template>
  <Head :title="__('Help Center')" />

  <AppLayout>
    <section id="help-center" class="py-5">
      <div class="container mx-auto">
        <div class="flex items-center justify-between mb-5">
          <h1 class="font-bold text-2xl">E-commerce {{ __('Help Center') }}</h1>

          <Link
            :href="route('faqs.index')"
            class="font-bold text-sm text-orange-500 hover:text-orange-600"
          >
            <i class="fa-solid fa-circle-question"></i>
            {{ __('Find More Questions') }}
          </Link>
        </div>

        <div class="flex flex-col items-center justify-center py-5">
          <img src="../../../assets/images/faq.png" class="h-48 object-contain object-center" />
          <h1 class="font-bold text-dark mb-5 text-3xl">
            {{ __('Hi, How can we help ?') }}
          </h1>
        </div>

        <!-- Search Input -->
        <HelpCenterQuestionSearchBox />
      </div>

      <!-- Top Questions -->
      <div class="px-32">
        <div class="flex flex-col items-center my-16 justify-center">
          <h1 class="font-bold text-gray-600 text-xl py-2 mb-5">
            <i class="fa-solid fa-award"></i>
            {{ __('Top Questions') }}
          </h1>

          <div class="grid grid-cols-3 gap-5 w-full">
            <div v-for="topQuestion in topQuestions" :key="topQuestion.id">
              <Link
                :href="route('faqs.show', topQuestion.slug)"
                class="line-clamp-2 text-sm font-medium hover:text-orange-600 transition-all flex items-center justify-start"
              >
                <i class="fa-solid fa-circle mr-2 text-[.3rem]"></i>

                <span class="hover:text-orange-700 hover:underline font-medium">
                  {{ topQuestion.question }}
                </span>
              </Link>
            </div>
          </div>
        </div>
      </div>

      <!-- Questions Categories -->
      <div class="px-32">
        <div class="flex flex-col items-center my-16 justify-center">
          <h1 class="font-bold text-gray-600 text-xl py-2 mb-5">
            <i class="fa-solid fa-clipboard-question"></i>
            {{ __('Question Categories') }}
          </h1>

          <div class="grid grid-cols-4 gap-3 w-full">
            <QuestionCategoryCard
              v-for="faqSubcategory in faqSubcategories"
              :key="faqSubcategory.id"
              :faqSubcategory="faqSubcategory"
            />
          </div>
        </div>
      </div>

      <!-- Self Service Tools -->
      <div class="px-32">
        <div class="flex flex-col items-center my-16 justify-center">
          <h1 class="font-bold text-gray-600 text-xl py-2 mb-5">
            <i class="fa-solid fa-screwdriver-wrench"></i>
            {{ __('Self Service Tools') }}
          </h1>

          <SelfServiceTools />
        </div>
      </div>

      <!-- Buttons -->

      <!-- Self Service Tools -->
      <div class="px-32">
        <!-- <p class="text-sm font-bold text-gray-600 text-center">
          {{
            __(
              "Still looking for answers? Chat with us by clicking 'Chat Now' or clicking 'Contact Us'. You can contact us at :label from 8:00 AM to 09:30 PM (Monday to Sunday).",
              { label: $page.props.generalSetting?.support_phone }
            )
          }}
        </p> -->
        <div class="flex items-center my-5 justify-center space-x-20">
          <!-- <button
            class="border font-bold text-md text-white p-5 w-72 bg-orange-600 shadow-md rounded-md hover:scale-110 transition-all"
          >
            <i class="fa-solid fa-comments mr-2"></i>
            {{ __('Live Chat Now') }}
          </button> -->
          <Link
            as="button"
            :href="route('contact-us.index')"
            class="border font-bold text-md text-orange-600 p-5 w-72 bg-white shadow-md rounded-md hover:scale-110 transition-all"
          >
            <i class="fa-solid fa-envelope mr-2"></i>
            {{ __('Contact us') }}
          </Link>
        </div>
      </div>
    </section>
  </AppLayout>
</template>
