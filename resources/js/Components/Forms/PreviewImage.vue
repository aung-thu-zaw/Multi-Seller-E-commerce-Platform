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
  <div class="w-32 h-32 overflow-hidden">
    <img v-if="src" :src="src" :alt="src" class="w-full h-full object-cover border rounded-md" />
    <img v-else :src="image" :alt="src" class="w-full h-full object-cover border rounded-md" />
  </div>
</template>
