<script setup>
defineProps({ blogContent: Object, blogCommentReply: Object });
</script>

<template>
  <div class="p-4 pl-16">
    <div class="flex items-start justify-between">
      <div class="flex items-start mb-2">
        <img
          :src="blogCommentReply.user?.avatar"
          :alt="blogCommentReply.user.name"
          class="w-10 h-10 object-cover rounded-full ring-2 ring-orange-200 mr-2"
        />

        <div class="flex flex-col items-start">
          <h3 class="font-bold text-gray-600">
            {{ blogCommentReply.user?.name }}
          </h3>

          <span
            v-if="blogCommentReply.user_id !== blogContent.user_id"
            class="text-xs font-medium text-gray-400"
          >
            Reply from user
          </span>

          <span v-else class="text-xs font-medium text-orange-500">
            Reply from author
          </span>
        </div>
      </div>

      <p class="text-gray-500 text-sm font-bold">
        {{ blogCommentReply.created_at }}
      </p>
    </div>

    <div class="pl-12">
      <p class="text-sm text-gray-600 font-medium">
        {{ blogCommentReply.reply }}
      </p>
    </div>
  </div>
</template>
