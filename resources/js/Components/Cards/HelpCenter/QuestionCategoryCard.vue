<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({ faqSubcategory: Object })
</script>

<template>
  <div
    class="border font-bold text-sm text-gray-700 p-5 rounded-md bg-white hover:shadow-lg hover:scale-105 transition-all w-full"
  >
    <Link
      as="button"
      :href="route('faqs.index')"
      :data="{
        category: faqSubcategory.slug
      }"
      class="flex flex-col items-center justify-center space-y-3 w-full"
    >
      <span
        class="border bg-orange-600 text-white w-10 h-10 p-5 flex items-center justify-center rounded-full ring-1 ring-orange-300 shadow"
      >
        <i v-html="faqSubcategory?.icon"></i>
      </span>

      <p class="text-center">{{ faqSubcategory?.name }}</p>
    </Link>
  </div>
</template>
