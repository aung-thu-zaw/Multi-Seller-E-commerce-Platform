<script setup>
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'

const props = defineProps({
  to: String,

  class: {
    type: String,
    default: 'text-white bg-blue-600 ring-2 ring-blue-300 hover:bg-blue-700'
  },

  method: {
    type: String,
    default: 'get'
  },

  targetIdentifier: {
    type: [String, Number, Object],
    default: null
  },

  data: {
    type: Object,
    default: {}
  },

  preserveState: {
    type: Boolean,
    default: false
  },

  preserveScroll: {
    type: Boolean,
    default: false
  },

  replace: {
    type: Boolean,
    default: false
  }
})

const computedClasses = computed(() => props.class)
</script>

<template>
  <Link
    as="button"
    :method="method"
    :href="route(to, targetIdentifier)"
    :data="data"
    class="text-xs px-4 shadow-md py-3 font-bold rounded-[4px] active:animate-press"
    :class="computedClasses"
    :preserve-state="preserveState"
    :preserve-scroll="preserveScroll"
  >
    <slot />
  </Link>
</template>
