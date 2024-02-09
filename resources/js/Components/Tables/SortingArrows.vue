<script setup>
defineProps({
  params: {
    type: Object,
    required: true
  },
  sort: {
    type: String,
    default: 'desc'
  }
})
</script>

<template>
  <i
    class="fa-solid fa-arrow-up text-[.6rem] cursor-pointer"
    :class="{
      'text-blue-600': params?.direction === 'asc' && params?.sort === sort,
      'visually-hidden':
        params?.direction !== '' && params?.direction !== 'asc' && params?.sort === sort
    }"
  ></i>
  <i
    class="fa-solid fa-arrow-down text-[.6rem] cursor-pointer"
    :class="{
      'text-blue-600': params?.direction === 'desc' && params?.sort === sort,
      'visually-hidden':
        params?.direction !== '' && params?.direction !== 'desc' && params?.sort === sort
    }"
  ></i>
</template>
