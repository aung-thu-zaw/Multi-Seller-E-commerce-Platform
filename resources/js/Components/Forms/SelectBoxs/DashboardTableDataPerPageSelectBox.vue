<script setup>
import { router, usePage } from "@inertiajs/vue3";
import { watch, ref } from "vue";

const props = defineProps({
  to: {
    type: String,
    required: true,
  },
});

const per_page = ref(usePage().props.ziggy.query?.per_page);

watch(
  () => per_page.value,
  () => {
    router.get(
      route(props.to),
      {
        search: usePage().props.ziggy.query?.search,
        page: usePage().props.ziggy.query?.page,
        per_page: per_page.value,
        sort: usePage().props.ziggy.query?.sort,
        direction: usePage().props.ziggy.query?.direction,
        created_from: usePage().props.ziggy.query?.created_from,
        created_until: usePage().props.ziggy.query?.created_until,
        deleted_from: usePage().props.ziggy.query?.deleted_from,
        deleted_until: usePage().props.ziggy.query?.deleted_until,
        filter_by_status: usePage().props.ziggy.query?.filter_by_status,
      },
      {
        replace: true,
        preserveState: true,
      }
    );
  }
);
</script>

<template>
  <select
    id="countries"
    class="p-3 py-3.5 font-medium text-xs text-gray-500 border border-gray-300 rounded-lg bg-gray-50 focus:ring-2 focus:ring-orange-300 focus:border-orange-400"
    v-model="per_page"
  >
    <option selected disabled>{{ __("Per Page") }}</option>
    <option value="5">5</option>
    <option value="10">10</option>
    <option value="25">25</option>
    <option value="75">75</option>
    <option value="100">100</option>
    <option value="150">150</option>
    <option value="200">200</option>
  </select>
</template>
