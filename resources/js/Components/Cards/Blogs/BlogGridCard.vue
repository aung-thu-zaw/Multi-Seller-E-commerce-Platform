<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({ blog: Object })
</script>

<template>
  <Link
    class="group rounded-xl overflow-hidden focus:outline-none"
    :href="route('blogs.show', { blog_content: blog.slug })"
  >
    <div class="relative pt-[70%] rounded-xl overflow-hidden">
      <img
        class="w-full h-full absolute top-0 start-0 object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out rounded-xl"
        :src="blog.thumbnail"
        :alt="blog.title"
      />
    </div>

    <div class="mt-7">
      <div class="flex items-center justify-between mb-3">
        <span class="font-bold text-slate-500 text-[.7rem]">
          <i class="fa-solid fa-user"></i>
          {{ blog.author?.name }}
        </span>
        <span class="font-bold text-slate-500 text-[.7rem]">
          <i class="fa-solid fa-clock"></i>
          {{ blog.published_at }}
        </span>
      </div>

      <h3 class="text-md font-semibold text-gray-800 group-hover:text-gray-600 line-clamp-2">
        {{ blog.title }}
      </h3>
      <p v-html="blog.content" class="text-xs mt-3 text-gray-800 line-clamp-3"></p>
      <p
        class="mt-5 text-sm inline-flex items-center gap-x-1 text-orange-600 decoration-2 group-hover:underline font-medium"
      >
        Read more
        <svg
          class="flex-shrink-0 w-4 h-4"
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        >
          <path d="m9 18 6-6-6-6" />
        </svg>
      </p>
    </div>
  </Link>
</template>
