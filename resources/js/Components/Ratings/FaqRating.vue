<script setup>
import { router } from '@inertiajs/vue3'

const props = defineProps({ faqContent: Object, faqFeedback: Object })

const handleFaqFeedback = (isHelpful) => {
  router.post(
    route('faqs.feedbacks', { faq_content: props.faqContent?.slug }),
    {
      is_helpful: isHelpful
    },
    { preserveScroll: true }
  )
}
</script>

<template>
  <div class="my-10">
    <!-- Rating -->
    <div class="mt-2 flex flex-col justify-center items-center gap-x-2">
      <h3 class="text-gray-800 font-semibold">Was this question helpful?</h3>

      <div class="space-x-5 mt-3">
        <button
          type="button"
          @click="handleFaqFeedback(1)"
          class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-300 bg-white shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
          :class="{
            'text-orange-600 border-orange-600': faqFeedback?.is_helpful === 1,
            'text-gray-800': faqFeedback?.is_helpful === 0
          }"
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
          @click="handleFaqFeedback(0)"
          class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-300 bg-white shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
          :class="{
            'text-orange-600 border-orange-600': faqFeedback?.is_helpful === 0,
            'text-gray-800': faqFeedback?.is_helpful === 1
          }"
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
      <p v-show="$page.props.flash?.success" class="text-green-600 text-xs font-semibold my-5">
        {{ __($page.props.flash.success) }}
      </p>
    </div>
    <!-- End Rating -->
  </div>
</template>
