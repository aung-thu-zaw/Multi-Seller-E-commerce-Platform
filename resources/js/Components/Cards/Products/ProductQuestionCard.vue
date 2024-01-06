<script setup>
import QuestionAnswerForm from '@/Components/Forms/TextareaForms/ProductQuestionAnswerForm.vue'
import { ref } from 'vue'

defineProps({ product: Object, productQuestion: Object })

const isAnswerBoxOpened = ref(false)
</script>

<template>
  <div class="p-4">
    <div class="flex items-start justify-between">
      <div class="flex items-center mb-2">
        <img
          :src="productQuestion.user?.avatar"
          alt="user-image"
          class="w-10 h-10 object-cover rounded-full ring-2 ring-orange-200 mr-2"
        />

        <div class="flex flex-col items-start">
          <h3 class="font-bold text-gray-600">{{ productQuestion.user?.name }}</h3>
          <span class="text-xs font-medium text-gray-400"> {{ __('Question from user') }} </span>
        </div>
      </div>

      <p class="text-gray-500 text-sm font-bold">
        {{ productQuestion.created_at }}
      </p>
    </div>

    <div class="pl-12">
      <p class="text-sm text-gray-600 font-medium">
        {{ productQuestion.question }}
      </p>
    </div>

    <div
      v-show="
        product.store_id === $page.props.auth.store?.id && !productQuestion.product_question_answer
      "
      class="flex items-center justify-end mt-3"
    >
      <button
        v-if="!isAnswerBoxOpened"
        @click="isAnswerBoxOpened = !isAnswerBoxOpened"
        class="font-medium text-xs text-gray-600 hover:text-orange-500"
      >
        <i class="fa-solid fa-comment-dots"></i>
        {{ __('Reply') }}
      </button>
      <button
        v-else
        @click="isAnswerBoxOpened = false"
        class="font-medium text-xs text-red-600 hover:text-red-500"
      >
        <i class="fa-solid fa-circle-xmark"></i>

        {{ __('Cancel') }}
      </button>
    </div>

    <!-- Reply Form -->
    <div v-show="isAnswerBoxOpened && !productQuestion.product_question_answer">
      <QuestionAnswerForm
        :product="product"
        :productQuestion="productQuestion"
        @updateAnswerBox="isAnswerBoxOpened = false"
      />
    </div>
  </div>
</template>
