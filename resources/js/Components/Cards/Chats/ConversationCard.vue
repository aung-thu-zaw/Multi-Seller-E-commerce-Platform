<script setup>
import { usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

const props = defineProps({ conversation: Object })

const isCustomer = computed(() => {
  return usePage().props.auth?.user?.id === props.conversation.customer_id
})
</script>

<template>
  <div class="p-3 border-b border-gray-300 hover:bg-gray-100 transition-all cursor-pointer">
    <div class="flex items-center space-x-2">
      <img
        :src="isCustomer ? conversation?.store?.avatar : conversation?.customer?.avatar"
        class="w-10 h-10 rounded-full object-cover ring-2 ring-gray-300 shadow-md"
      />

      <div class="flex items-start justify-between w-full">
        <div class="">
          <h3 class="font-semibold text-sm text-gray-700 line-clamp-1">
            {{ isCustomer ? conversation?.store?.store_name : conversation?.customer?.name }}
          </h3>

          <p class="text-xs text-gray-500 font-medium line-clamp-1">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Mollitia temporibus rem
            blanditiis voluptates suscipit illo, inventore aspernatur error tempora possimus qui
            sunt quaerat, iusto iste in explicabo quisquam impedit reprehenderit.
          </p>
        </div>
        <div class="flex flex-col items-center justify-between">
          <span class="font-medium text-xs text-gray-600 mb-1">25/10</span>
          <span
            class="font-medium text-[.6rem] bg-orange-500 w-3 h-3 text-white flex items-center justify-center rounded-full p-2"
            >2</span
          >
        </div>
      </div>
    </div>
  </div>
</template>
