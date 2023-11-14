<script setup>
import { useFormatFunctions } from "@/Composables/useFormatFunctions";
import { router, usePage } from "@inertiajs/vue3";

const props = defineProps({
  to: String,

  filterKey: String,

  label: String,
});

const { formatToTitleCase } = useFormatFunctions();

const removeFiltered = (queryStringKey) => {
  router.get(
    route(props.to),
    {
      search: usePage().props.ziggy.query?.search,
      per_page: usePage().props.ziggy.query?.per_page,
      sort: usePage().props.ziggy.query?.sort,
      direction: usePage().props.ziggy.query?.direction,
      created_from:
        queryStringKey === "created_from"
          ? undefined
          : usePage().props.ziggy.query?.created_from,
      created_until:
        queryStringKey === "created_until"
          ? undefined
          : usePage().props.ziggy.query?.created_until,
      deleted_from:
        queryStringKey === "deleted_from"
          ? undefined
          : usePage().props.ziggy.query?.deleted_from,
      deleted_until:
        queryStringKey === "deleted_until"
          ? undefined
          : usePage().props.ziggy.query?.deleted_until,
      filter_by_status:
        queryStringKey === "filter_by_status"
          ? undefined
          : usePage().props.ziggy.query?.filter_by_status,
    },
    {
      replace: true,
      preserveState: true,
    }
  );
};
</script>

<template>
  <div
    class="inline-flex flex-nowrap items-center bg-white border border-gray-200 rounded-full px-2 py-1.5"
  >
    <div class="whitespace-nowrap text-xs font-bold text-gray-800">
      {{ label }}
    </div>
    <div
      @click="removeFiltered(filterKey)"
      class="ms-2.5 inline-flex justify-center items-center h-2 w-2 rounded-full text-gray-600 text-xs hover:text-red-600 transition-all cursor-pointer"
    >
      <i class="fa-solid fa-circle-xmark"></i>
    </div>
  </div>
</template>
