<script setup>
import { Link } from '@inertiajs/vue3'
defineProps({
  links: Array
})
</script>

<template>
  <div class="flex items-center justify-center">
    <div v-if="links.length > 3">
      <div class="flex flex-wrap -mb-1">
        <template v-for="(link, p) in links" :key="p">
          <div
            v-if="link.url === null"
            class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border border-gray-300 rounded-full"
            v-html="link.label"
          />

          <div v-else class="flex items-center">
            <!-- <Link
              v-if="$page.props.ziggy.query.tab"
              class="mr-1 px-4 py-3 text-sm leading-4 border border-gray-300 rounded-full hover:bg-white hover:text-orange-500 hover:border-orange-500 focus:border-orange-500 focus:text-orange-500"
              :class="{ 'bg-orange-600 text-white': link.active }"
              :href="link.url"
            >
              <span v-html="link.label"></span>
            </Link> -->
            <Link
              class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border border-gray-300 rounded-full hover:bg-white hover:text-orange-500 hover:border-orange-500 focus:border-orange-500 focus:text-orange-500"
              :class="{ 'bg-orange-600 text-white': link.active }"
              :href="link.url"
            >
              <span v-html="link.label"></span>
            </Link>
          </div>
        </template>
      </div>
    </div>
  </div>
</template>
