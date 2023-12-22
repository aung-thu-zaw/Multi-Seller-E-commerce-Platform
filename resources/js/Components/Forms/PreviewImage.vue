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
  <div class="h-32 overflow-hidden">
    <img v-if="src" :src="src" :alt="src" class="w-full h-full object-contain" />
    <img v-else :src="image" :alt="src" class="w-full h-full object-contain" />
  </div>
</template>
