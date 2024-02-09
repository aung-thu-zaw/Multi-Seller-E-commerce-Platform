<script setup>
import { computed } from 'vue'

const props = defineProps({
  class: {
    type: String,
    default: 'text-white bg-blue-600 ring-2 ring-blue-300 hover:bg-blue-700'
  },

  type: {
    type: String,
    default: 'button'
  }
})

const computedClasses = computed(() => props.class)
</script>

<template>
  <button
    :type="type"
    class="text-xs px-4 shadow-md py-3 font-bold rounded-[4px] active:animate-press"
    :class="computedClasses"
  >
    <slot />
  </button>
</template>
