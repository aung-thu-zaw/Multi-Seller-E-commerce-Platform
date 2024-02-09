<script setup>
import ConversationCard from '@/Components/Cards/Chats/ConversationCard.vue'
import SenderMessageBubble from '@/Components/Cards/Chats/SenderMessageBubble.vue'
import ReceiverMessageBubble from '@/Components/Cards/Chats/ReceiverMessageBubble.vue'
import EcommerceSenderMessageForm from '@/Components/Forms/Chats/EcommerceSenderMessageForm.vue'
import { computed, onUpdated, ref } from 'vue'
import { useStore } from 'vuex'
import { usePage } from '@inertiajs/vue3'

const store = useStore()

const isWidgetOpened = computed(() => store.state.isWidgetOpened)

const conversations = computed(() => usePage().props.auth?.conversations)

const selectedConversation = ref(null)

const messageScroll = ref(null)

const scrollToBottom = () => {
  if (messageScroll.value) {
    const scrollHeight = messageScroll.value.scrollHeight
    const scrollTop = messageScroll.value.scrollTop
    const clientHeight = messageScroll.value.clientHeight
    const targetScrollTop = scrollHeight - clientHeight

    const animation = () => {
      const distance = targetScrollTop - scrollTop
      const step = distance / 15

      if (Math.abs(distance) > 1) {
        messageScroll.value.scrollTop += step
        requestAnimationFrame(animation)
      } else {
        messageScroll.value.scrollTop = targetScrollTop
      }
    }

    requestAnimationFrame(animation)
  }
}

onUpdated(() => {
  scrollToBottom()
})

const handleSelectConversation = (conversationId) => {
  selectedConversation.value = conversations.value.find(
    (conversation) => conversation.id === conversationId
  )
}

const messages = computed(() => {
  return selectedConversation.value?.conversation_messages || []
})
</script>

<template>
  <div v-show="$page.props.auth?.user" class="relative">
    <div
      v-show="isWidgetOpened"
      class="fixed bottom-24 right-12 rounded-md w-[1000px] h-[600px] bg-white z-[60] overflow-hidden border border-gray-400"
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
            <div class="h-[525px] overflow-scroll message-container pb-3">
              <!-- Conversation Card -->
              <ConversationCard
                v-for="conversation in conversations"
                :key="conversation.id"
                :conversation="conversation"
                @click="handleSelectConversation(conversation.id)"
                :class="{ 'bg-gray-200': conversation.id === selectedConversation?.id }"
              />
            </div>
          </div>
        </div>
        <div class="col-span-2">
          <div class="border-b py-4 px-5">
            <p class="font-bold text-gray-600 text-lg">E-commerce Platform ( Chat Box )</p>
          </div>

          <div class="h-[540px] flex items-center justify-center w-full">
            <div v-if="selectedConversation" class="flex flex-col items-center w-full h-full">
              <div
                ref="messageScroll"
                class="h-full overflow-scroll py-3 px-2.5 w-full message-container"
              >
                <!-- Chat Bubble -->
                <ul class="space-y-5">
                  <li v-for="message in messages" :key="message.id">
                    <div v-if="message.customer_id === $page.props.auth.user?.id">
                      <SenderMessageBubble :message="message" />
                    </div>
                    <div v-else>
                      <ReceiverMessageBubble :message="message" />
                    </div>
                  </li>
                </ul>
                <!-- End Chat Bubble -->
              </div>

              <!-- Message Input Box -->
              <EcommerceSenderMessageForm :conversation="selectedConversation" />
            </div>
            <div v-else>
              <div class="text-gray-600 text-3xl flex items-center justify-center mb-5">
                <i class="fa-solid fa-message"></i>
              </div>

              <p class="font-semibold text-gray-700 text-sm">
                Once you start a new conversation, you’ll see it listed here.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Chat Button -->
    <button
      @click="store.commit('toggleWidget')"
      type="button"
      class="fixed bottom-10 right-8 z-30 bg-orange-600 text-white w-12 h-12 flex items-center justify-center rounded-full text-lg ring-2 ring-orange-200 shadow-lg"
    >
      <div v-if="!isWidgetOpened" class="relative">
        <i class="fa-solid fa-message"></i>

        <!-- <span
          class="w-4 h-4 absolute -top-1 -right-2 font-bold text-[.7rem] bg-white rounded-full text-orange-500 flex items-center justify-center border border-orange-300 z-10"
        >
          3
        </span> -->
      </div>

      <span v-else>
        <i class="fa-solid fa-xmark"></i>
      </span>
    </button>
  </div>
</template>

<style>
.message-container::-webkit-scrollbar {
  display: none;
}
</style>
