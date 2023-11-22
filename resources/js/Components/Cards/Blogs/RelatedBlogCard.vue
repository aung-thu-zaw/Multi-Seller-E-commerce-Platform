<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({ blog: Object });
</script>

<template>
  <Link
    :href="route('blogs.show', blog.slug)"
    class="flex items-center pl-3 py-5 hover:bg-gray-200 transition-all border-b border-gray-300 w-full"
  >
    <img
      class="w-16 h-16 object-cover object-center rounded-md"
      :src="blog.thumbnail"
      :alt="blog.title"
    />

    <div class="px-3 w-full">
      <h4 class="line-clamp-2 text-sm font-semibold text-gray-700 mb-1">
        {{ blog.title }}
      </h4>

      <div class="flex items-center justify-between">
        <span class="font-bold text-slate-500 text-[.7rem]">
          <i class="fa-solid fa-user"></i>
          {{ blog.author?.name }}
        </span>
        <span class="font-bold text-slate-500 text-[.7rem]">
          <i class="fa-solid fa-clock"></i>
          {{ blog.published_at }}
        </span>
      </div>
    </div>
  </Link>
</template>
