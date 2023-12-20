<script setup>
defineProps({ product: Object, productQuestionAnswer: Object })
</script>

<template>
  <div class="p-4 pl-16">
    <div class="flex items-start justify-between">
      <div class="flex items-start mb-2">
        <img
          :src="productQuestionAnswer?.store?.avatar"
          :alt="productQuestionAnswer?.store?.store_name"
          class="w-10 h-10 object-cover rounded-full ring-2 ring-orange-200 mr-2"
        />

        <div class="flex flex-col items-start">
          <h3 class="font-bold text-gray-600">
            {{ productQuestionAnswer?.store?.store_name }}
          </h3>

          <span
            v-if="productQuestionAnswer?.store_id === product.store_id"
            class="text-xs font-medium text-orange-500"
          >
            {{ __('Answer from store') }}
          </span>
        </div>
      </div>

      <p class="text-gray-500 text-sm font-bold">
        {{ productQuestionAnswer?.created_at }}
      </p>
    </div>

    <div class="pl-12">
      <p class="text-sm text-gray-600 font-medium">
        {{ productQuestionAnswer?.answer }}
      </p>
    </div>
  </div>
</template>
