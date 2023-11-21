<script setup>
defineProps({ tags: Array });

const removeTag = (removeTag) => {
  form.tags = form.tags.filter((tag) => {
    return tag !== removeTag;
  });
};
</script>

<template>
  <div
    v-for="(tag, index) in tags"
    :key="index"
    class="space-x-3 bg-orange-600 inline-block px-2.5 text-xs font-bold py-1.5 rounded-sm text-white my-3"
  >
    <span>{{ tag }}</span>
    <span @click="removeTag(tag)" class="cursor-pointer hover:text-orange-200">
      <i class="fa-solid fa-circle-xmark"></i>
    </span>
  </div>
</template>
