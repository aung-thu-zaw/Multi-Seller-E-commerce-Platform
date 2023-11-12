<script setup>
const props = defineProps({
  label: {
    type: String,
    required: true,
  },
});
</script>

<template>
  <th scope="col" class="px-6 py-3">
    <span class="line-clamp-1">
      {{ label }}
    </span>
  </th>
</template>
