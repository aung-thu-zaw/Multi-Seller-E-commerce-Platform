<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
  to: String,

  targetIdentifier: {
    type: [String, Number, Object],
    default: null
  },

  label: {
    type: String,
    required: true
  },

  data: {
    type: Object
  }
})
</script>

<template>
  <li>
    <div class="flex items-center">
      <i class="fa-solid fa-angle-right text-gray-400"></i>
      <Link
        :href="route(to, targetIdentifier)"
        :data="
          $page.url.startsWith('/admin') || $page.url.startsWith('/seller')
            ? dashboardQueryStringParams
            : data
        "
        class="inline-flex items-center text-sm font-bold text-blueGray-600"
        :class="{
          'hover:text-orange-600': $page.url.startsWith('/admin') || $page.url.startsWith('/'),
          'hover:text-blue-600': $page.url.startsWith('/seller')
        }"
      >
        <span class="mr-2.5">
          <i class="fa-solid" :class="icon"></i>
        </span>
        {{ __(label) }}
      </Link>
    </div>
  </li>
</template>
