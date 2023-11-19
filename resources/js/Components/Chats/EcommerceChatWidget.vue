<script setup>
import ConversationCard from "@/Components/Cards/Chats/ConversationCard.vue";
import SenderMessageBubble from "@/Components/Cards/Chats/SenderMessageBubble.vue";
import ReceiverMessageBubble from "@/Components/Cards/Chats/ReceiverMessageBubble.vue";
import EcommerceSenderMessageForm from "@/Components/Forms/Chats/EcommerceSenderMessageForm.vue";
import { ref } from "vue";

const isWidgetOpened = ref(false);
</script>

<template>
  <div class="relative">
    <div
      v-show="isWidgetOpened"
      class="fixed bottom-24 shadow-lg shadow-gray-400 right-12 rounded-md w-[900px] h-[600px] bg-white z-[60] overflow-hidden border border-gray-400"
    >
      <div class="grid grid-cols-3 h-full">
        <div class="col-span-1 h-full">
          <div class="border-b border-r py-4 px-5">
            <p class="font-bold text-gray-600 text-lg text-center">
              <i class="fa-solid fa-comments"></i>
              Conversations
            </p>
          </div>

          <div class="border-r h-full">
            <div class="h-[525px] overflow-scroll pb-3">
              <!-- Conversation Card -->
              <ConversationCard />
            </div>
          </div>
        </div>
        <div class="col-span-2">
          <div class="border-b py-4 px-5">
            <p class="font-bold text-gray-600 text-lg">
              E-commerce Platform ( Chat Box )
            </p>
          </div>

          <div class="h-[540px] flex items-center justify-center w-full">
            <div class="flex flex-col items-center w-full h-full">
              <div class="h-full overflow-scroll py-3 px-2.5 w-full">
                <!-- Chat Bubble -->
                <ul class="space-y-5">
                  <ReceiverMessageBubble />

                  <SenderMessageBubble />

                  <ReceiverMessageBubble />
                </ul>
                <!-- End Chat Bubble -->
              </div>

              <!-- Message Input Box -->
              <EcommerceSenderMessageForm />
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Chat Button -->
    <button
      @click="isWidgetOpened = !isWidgetOpened"
      type="button"
      class="fixed bottom-10 right-8 z-30 bg-orange-600 text-white w-12 h-12 flex items-center justify-center rounded-full text-lg ring-2 ring-orange-200 shadow-lg"
    >
      <div v-if="!isWidgetOpened" class="relative">
        <i class="fa-solid fa-message"></i>

        <span
          class="w-4 h-4 absolute -top-1 -right-2 font-bold text-[.7rem] bg-white rounded-full text-orange-500 flex items-center justify-center border border-orange-300 z-10"
        >
          3
        </span>
      </div>

      <span v-else>
        <i class="fa-solid fa-xmark"></i>
      </span>
    </button>
  </div>
</template>
