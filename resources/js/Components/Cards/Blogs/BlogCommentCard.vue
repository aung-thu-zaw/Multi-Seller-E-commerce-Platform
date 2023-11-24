<script setup>
import BlogReplyForm from "@/Components/Forms/TextareaForms/BlogCommentReplyForm.vue";
import { ref } from "vue";

defineProps({ blogContent: Object, blogComment: Object });

const isReplyBoxOpened = ref(false);
</script>

<template>
  <div class="p-4">
    <div class="flex items-start justify-between">
      <div class="flex items-center mb-2">
        <img
          :src="blogComment.user?.avatar"
          alt=""
          class="w-10 h-10 object-cover rounded-full ring-2 ring-orange-200 mr-2"
        />

        <div class="flex flex-col items-start">
          <h3 class="font-bold text-gray-600">{{ blogComment.user?.name }}</h3>
          <span class="text-xs font-medium text-gray-400">
            Comment from user
          </span>
        </div>
      </div>

      <p class="text-gray-500 text-sm font-bold">
        {{ blogComment.created_at }}
      </p>
    </div>

    <div class="pl-12">
      <p class="text-sm text-gray-600 font-medium">
        {{ blogComment.comment }}
      </p>
    </div>

    <div
      v-show="blogContent.author_id === $page.props.auth.user?.id"
      class="flex items-center justify-end mt-3"
    >
      <button
        v-if="!isReplyBoxOpened"
        @click="isReplyBoxOpened = !isReplyBoxOpened"
        class="font-medium text-xs text-gray-600 hover:text-orange-500"
      >
        <i class="fa-solid fa-comment-dots"></i>
        Reply
      </button>
      <button
        v-else
        @click="isReplyBoxOpened = false"
        class="font-medium text-xs text-red-600 hover:text-red-500"
      >
        <i class="fa-solid fa-circle-xmark"></i>
        Cancel
      </button>
    </div>

    <!-- Reply Form -->
    <div v-show="isReplyBoxOpened">
      <BlogReplyForm
        :blogContent="blogContent"
        :blogComment="blogComment"
        @updateReplyBox="isReplyBoxOpened = false"
      />
    </div>
  </div>
</template>
