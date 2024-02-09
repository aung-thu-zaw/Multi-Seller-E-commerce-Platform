<script setup>
defineProps({ product: Object })
</script>

<template>
  <div class="px-5 py-10 border border-gray-200 bg-white rounded-md space-y-5">
    <p v-html="product?.description" class="text-sm font-medium text-gray-700"></p>
  </div>
</template>
