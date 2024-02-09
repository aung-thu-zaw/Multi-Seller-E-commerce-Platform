<script setup>
import { computed } from 'vue'

const emit = defineEmits(['update:checked'])

const props = defineProps({
  checked: {
    type: [Boolean, Array],
    default: false
  },

  value: {
    default: null
  }
})

const proxyChecked = computed({
  get() {
    return props.checked
  },

  set(val) {
    emit('update:checked', val)
  }
})
</script>

<template>
  <input
    type="checkbox"
    :value="value"
    v-model="proxyChecked"
    class="rounded border-gray-300 shadow-sm"
    :class="{
      'text-blue-600 focus:ring-blue-500': $page.url.startsWith('/seller'),
      'text-orange-600 focus:ring-orange-500': !$page.url.startsWith('/seller')
    }"
  />
</template>
