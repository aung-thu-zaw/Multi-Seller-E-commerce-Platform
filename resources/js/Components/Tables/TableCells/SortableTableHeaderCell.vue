<script setup>
import SortingArrow from "../SortingArrows.vue";
import { useSorting } from "@/Composables/useSorting";

const props = defineProps({
  label: {
    type: String,
    required: true,
  },
  to: {
    type: String,
    required: true,
  },
  sort: {
    type: String,
    default: "desc",
  },
});

const { params, updateSorting } = useSorting(props.to);
</script>

<template>
  <th scope="col" class="px-6 py-3" @click="updateSorting(props.sort)">
    {{ label }}
    <SortingArrow :params="params" :sort="sort" />
  </th>
</template>
