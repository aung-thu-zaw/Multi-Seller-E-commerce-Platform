<script setup>
defineProps({ faqSubCategory: Object })
</script>

<template>
  <div
    class="border font-bold text-sm text-gray-700 p-5 rounded-md bg-white hover:shadow-lg hover:scale-105 transition-all"
  >
    <a href="#" class="flex flex-col items-center justify-center space-y-3">
      <span
        class="border bg-orange-600 text-white w-10 h-10 p-5 flex items-center justify-center rounded-full ring-1 ring-orange-300 shadow"
      >
        <i v-html="faqSubCategory?.icon"></i>
      </span>

      <p class="text-center">{{ faqSubCategory?.name }}</p>
    </a>
  </div>
</template>
