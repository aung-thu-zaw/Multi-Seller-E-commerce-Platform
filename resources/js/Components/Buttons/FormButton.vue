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
    class="w-full text-sm text-white ring-2 capitalize font-bold focus:ring-2 py-3 rounded-md active:animate-press"
    :class="{
      ' bg-blue-600 ring-blue-300 hover:bg-blue-700 focus:ring-blue-200':
        $page.url.startsWith('/seller'),
      ' bg-orange-600 ring-orange-300 hover:bg-orange-700 focus:ring-orange-200':
        !$page.url.startsWith('/seller')
    }"
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
