<script setup>
import { Link } from "@inertiajs/vue3";
defineProps({
  data: {
    type: Object,
  },
});
</script>

<template>
  <div
    v-if="data.data.length !== 0"
    class="flex flex-col items-center justify-center py-2"
  >
    <p class="font-bold text-gray-600 text-xs mb-3">
      Showing {{ data.from }} - {{ data.to }} of
      {{ data.total }}
    </p>

    <!-- Pagination -->

    <div class="flex items-center justify-center">
      <div v-if="data.links.length > 3">
        <div class="flex flex-wrap -mb-1">
          <template v-for="(link, p) in data.links" :key="p">
            <div
              v-if="link.url === null"
              class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-blueGray-500 border border-blueGray-400 rounded"
              v-html="link.label"
            />

            <div v-else class="flex items-center">
              <Link
                v-if="$page.props.ziggy.query.tab"
                class="mr-1 px-4 py-3 text-sm leading-4 border border-blueGray-400 rounded hover:bg-white hover:text-blue-500 hover:border-blue-500 focus:border-blue-500 focus:text-blue-500"
                :class="{ 'bg-blue-600 text-white': link.active }"
                :href="link.url"
                :data="{ tab: $page.props.ziggy.query.tab }"
              >
                <span v-html="link.label"></span>
              </Link>
              <Link
                v-else
                class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border border-blueGray-400 rounded hover:bg-white hover:text-blue-500 hover:border-blue-500 focus:border-blue-500 focus:text-blue-500"
                :class="{ 'bg-blue-600 text-white': link.active }"
                :href="link.url"
              >
                <span v-html="link.label"></span>
              </Link>
            </div>
          </template>
        </div>
      </div>
    </div>
  </div>
</template>


