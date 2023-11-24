<script setup>
defineProps({
  disabled: {
    type: Boolean,
    default: false
  },

  processing: {
    type: Boolean,
    default: false
  }
})
</script>

<template>
  <button
    type="submit"
    class="w-full text-sm bg-orange-600 text-white ring-2 ring-orange-300 hover:bg-orange-700 capitalize font-bold focus:ring-2 focus:ring-orange-200 py-3 rounded-md active:animate-press"
    :disabled="disabled"
  >
    <div v-if="processing" class="flex items-center justify-center">
      <div
        class="animate-spin inline-block w-5 h-5 border-[3px] border-current border-t-transparent text-white rounded-full mr-2"
        role="status"
        aria-label="loading"
      >
        <span class="sr-only">Loading...</span>
      </div>
      <span>{{ __('Processing') }}...</span>
    </div>
    <div v-else>
      <slot />
    </div>
  </button>
</template>
