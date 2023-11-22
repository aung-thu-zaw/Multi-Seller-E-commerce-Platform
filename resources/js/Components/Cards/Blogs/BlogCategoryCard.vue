<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({ category: Object });
</script>

<template>
  <Link
    as="button"
    :href="route('blogs.index')"
    :data="{
      search_blog: $page.props.ziggy.query?.search_blog,
      blog_category: category?.slug,
      sort: $page.props.ziggy.query.sort ?? 'id',
      direction: $page.props.ziggy.query.direction ?? 'desc',
      view: $page.props.ziggy.query.view ?? 'grid',
    }"
    class="border border-gray-300 flex items-center px-3 py-3 rounded-md hover:bg-gray-100 text-gray-600 hover:scale-105 transition-all w-full"
    :class="{
      'text-orange-600':
        $page.props.ziggy.query?.blog_category === category?.slug,
    }"
  >
    <img
      :src="category.image"
      :alt="category.name"
      class="w-10 h-10 object-cover rounded-full mr-3 ring-2 ring-gray-300"
    />

    <h5 class="font-bold text-md">
      {{ category.name }}
    </h5>
  </Link>
</template>
