<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import HelpCenterQuestionSearchBox from '@/Components/Forms/SearchBoxs/HelpCenterQuestionSearchBox.vue'
import Pagination from '@/Components/Paginations/Pagination.vue'
import { Head, Link } from '@inertiajs/vue3'

defineProps({ faqContents: Object })
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

      <div class="w-[1200px] mx-auto border bg-white p-10 rounded-md shadow-lg my-10">
        <!-- Question Search Text -->
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
    </section>
  </AppLayout>
</template>
