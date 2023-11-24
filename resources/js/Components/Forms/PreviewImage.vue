<script setup>
import image from '@/assets/images/no-image.jpeg'

defineProps({
  src: {
    type: String,
    default: image
  }
})
</script>

<template>
  <div
    class="w-28 h-28 border border-slate-300 overflow-hidden rounded-md shadow-md ring-1 ring-slate-200"
  >
    <img v-if="src" :src="src" :alt="src" class="w-full h-full object-cover" />
    <img v-else :src="image" :alt="src" class="w-full h-full object-cover" />
  </div>
</template>
