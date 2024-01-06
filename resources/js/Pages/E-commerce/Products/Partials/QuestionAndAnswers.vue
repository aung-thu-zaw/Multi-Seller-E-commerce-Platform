<script setup>
import ProductQuestionCard from '@/Components/Cards/Products/ProductQuestionCard.vue'
import ProductAnswerCard from '@/Components/Cards/Products/ProductAnswerCard.vue'
import ProductQuestionForm from '@/Components/Forms/TextareaForms/ProductQuestionForm.vue'
import Pagination from '@/Components/Paginations/Pagination.vue'
import { Link } from '@inertiajs/vue3'

defineProps({ product: Object, productQuestions: Object })
</script>

<template>
  <div class="py-10 border border-gray-200 bg-white rounded-md space-y-5">
    <div class="px-5">
      <div class="mb-5 flex items-center justify-between">
        <h3 class="font-bold text-md text-gray-800">
          Total Questions ({{ productQuestions.total }})
        </h3>
        <div class="space-x-5">
          <!-- <ReviewSortDropdown :product="product" />

          <ReviewFilterDropdown :product="product" /> -->
        </div>
      </div>

      <!-- Questions -->
      <div v-if="productQuestions.data.length" class="space-y-5">
        <div
          v-for="productQuestion in productQuestions.data"
          :key="productQuestion.id"
          class="py-3 rounded-md border border-gray-300"
        >
          <!-- Question Card -->
          <ProductQuestionCard :product="product" :productQuestion="productQuestion" />

          <!-- Reply Card -->
          <div v-show="productQuestion.product_question_answer">
            <ProductAnswerCard
              :product="product"
              :productQuestionAnswer="productQuestion.product_question_answer"
            />
          </div>
        </div>

        <!-- Question Pagination -->
        <div>
          <Pagination :links="productQuestions.links" />
        </div>
      </div>

      <div v-else class="py-5">
        <p class="text-center font-bold text-gray-700 text-md">
          <i class="fa-solid fa-comment-slash"></i>
          {{ __('Questions Not Yet') }}
        </p>
      </div>
    </div>

    <!-- Question Form -->
    <div v-show="$page.props.auth?.user && $page.props.auth?.store?.id !== product?.store_id">
      <ProductQuestionForm :product="product" />
    </div>
    <div v-show="!$page.props.auth.user" class="py-5">
      <p class="text-center text-sm font-medium text-gray-600">
        {{ __('If you want to ask question you need to login first. Here') }}
        <Link href="#" class="font-bold text-orange-600 hover:underline"> Sign In </Link>
        Or
        <Link href="#" class="font-bold text-orange-600 hover:underline"> Sign Up </Link>
      </p>
    </div>
  </div>
</template>
