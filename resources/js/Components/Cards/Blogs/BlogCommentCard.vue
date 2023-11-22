<script setup>
import BlogReplyForm from "@/Components/Forms/TextareaForms/BlogReplyForm.vue";
import { ref } from "vue";

const isReplyBoxOpened = ref(false);
</script>

<template>
  <div class="p-4">
    <div class="flex items-center justify-between">
      <div class="flex items-center mb-2">
        <img
          src="https://images.unsplash.com/photo-1579865346865-9223701ba92e?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NTR8fGltYWdlfGVufDB8fDB8fHww"
          alt=""
          class="w-10 h-10 object-cover rounded-full ring-2 ring-orange-200 mr-2"
        />

        <div class="flex flex-col items-start">
          <h3 class="font-bold text-gray-600">Aung Thu Zaw</h3>
          <span class="text-xs font-medium text-gray-400">
            Comment from user
          </span>
        </div>
      </div>

      <p class="text-gray-500 text-sm font-bold">12/September/2023 12:30 PM</p>
    </div>

    <div class="pl-12">
      <p class="text-sm text-gray-600 font-medium">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam dolore
        cumque nisi ipsum error in facere fugit maiores dicta optio! Laborum
        totam fugit quia, incidunt tempore beatae minima reiciendis eos.
      </p>
    </div>

    <div class="flex items-center justify-end mt-3">
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
      <BlogReplyForm />
    </div>
  </div>
</template>
