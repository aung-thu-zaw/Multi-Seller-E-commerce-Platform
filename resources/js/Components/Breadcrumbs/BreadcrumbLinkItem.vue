<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
  label: {
    type: String,
    required: true
  },

  to: {
    type: String,
    required: true
  },

  targetIdentifier: {
    type: [String, Number, Object],
    default: null
  }
})
</script>

<template>
  <li>
    <div class="flex items-center">
      <i class="fa-solid fa-angle-right text-gray-400"></i>
      <Link
        :href="route(to, targetIdentifier)"
        :data="{
          page: 1,
          per_page: 5,
          sort: 'id',
          direction: 'desc'
        }"
        class="ml-1 text-sm font-semibold text-blueGray-600 hover:text-blue-600 md:ml-2"
      >
        {{ __(label) }}
      </Link>
    </div>
  </li>
</template>
