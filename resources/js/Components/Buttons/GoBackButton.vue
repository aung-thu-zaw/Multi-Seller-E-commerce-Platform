<script setup>
import { computed } from 'vue'

const props = defineProps({
  class: {
    type: String,
    default: 'text-white bg-blue-600 ring-2 ring-blue-300 hover:bg-blue-700'
  }
})

const computedClasses = computed(() => props.class)

const navigateBack = () => {
  window.history.back()
}
</script>

<template>
  <button
    type="button"
    class="text-xs px-4 shadow-md py-3 font-bold rounded-[4px] active:animate-press"
    @click="navigateBack"
    :class="computedClasses"
  >
    <i class="fa-solid fa-left-long"></i>
    {{ __('Go Back') }}
  </button>
</template>
