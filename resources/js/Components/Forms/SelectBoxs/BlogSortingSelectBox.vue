<script setup>
import { router, usePage } from "@inertiajs/vue3";
import { ref, watch } from "vue";

const direction = ref(usePage().props.ziggy.query?.direction);

watch(
  () => direction.value,
  () => {
    router.get(
      route("blogs.index"),
      {
        search_blog: usePage().props.ziggy.query?.search_blog,
        sort: usePage().props.ziggy.query?.sort,
        direction: direction.value,
        page: usePage().props.ziggy.query?.page,
        blog_category: usePage().props.ziggy.query?.blog_category,
        view: usePage().props.ziggy.query?.view,
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
  <div>
    <label for="sort-by" class="font-bold text-sm text-gray-600">
      Sort By :
    </label>
    <select
      id="blog-sort-by"
      class="w-[100px] p-3.5 font-medium text-sm text-gray-500 border border-gray-300 rounded-lg bg-gray-50 focus:ring-2 focus:ring-orange-300 focus:border-orange-400"
      v-model="direction"
    >
      <option
        value="desc"
        :selected="direction === 'desc' || direction === null"
      >
        {{ __("Latest") }}
      </option>
      <option value="asc" :selected="direction === 'asc'">
        {{ __("Newest") }}
      </option>
    </select>
  </div>
</template>
