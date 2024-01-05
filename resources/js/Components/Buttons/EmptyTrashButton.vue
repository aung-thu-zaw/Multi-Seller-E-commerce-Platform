<script setup></script>

<template>
  <button
    class="rounded-sm px-2 py-1 transition-all hover:animate-pulse"
    :class="{
      'text-blue-500 hover:bg-blue-200 hover:text-blue-600': $page.url.startsWith('/seller'),
      'text-orange-500 hover:bg-orange-200 hover:text-orange-600': !$page.url.startsWith('/seller')
    }"
  >
    {{ __('Empty The Trash Now') }}
  </button>
</template>
