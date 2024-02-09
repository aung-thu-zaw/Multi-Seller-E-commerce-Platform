<script setup>
import SellerDashboardLayout from '@/Layouts/SellerDashboardLayout.vue'
import { Head } from '@inertiajs/vue3'
import { __ } from '@/Services/translations-inside-setup.js'
import ConversationCard from '@/Components/Cards/Chats/ConversationCard.vue'
import SenderMessageBubble from '@/Components/Cards/Chats/SenderMessageBubble.vue'
import ReceiverMessageBubble from '@/Components/Cards/Chats/ReceiverMessageBubble.vue'
import StoreChatMessageForm from '@/Components/Forms/Chats/StoreChatMessageForm.vue'
import { computed, onUpdated, ref } from 'vue'

const props = defineProps({ conversations: Object })

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
  selectedConversation.value = props.conversations.find(
    (conversation) => conversation.id === conversationId
  )
}

const messages = computed(() => {
  return selectedConversation.value?.conversation_messages ?? []
})
</script>

<template>
  <Head :title="__('Chats')" />

  <SellerDashboardLayout>
    <!-- Breadcrumb And Trash Button  -->
    <div class="py-10 min-h-screen font-poppins">
      <div class="flex items-center justify-between border border-gray-200 bg-white rounded-md">
        <div class="grid grid-cols-3 h-full w-full">
          <div class="col-span-1 h-full">
            <div class="border-b border-r py-4 px-5">
              <p class="font-bold text-gray-600 text-lg text-center">
                <i class="fa-solid fa-comments"></i>
                Conversations
              </p>
            </div>

            <div class="border-r h-[600px]">
              <div class="overflow-scroll pb-3 w-full min-w-[300px] message-container">
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

            <div class="flex items-center justify-center w-full h-[600px]">
              <div v-if="selectedConversation" class="flex flex-col items-center w-full h-full">
                <div
                  ref="messageScroll"
                  class="h-[505px] overflow-scroll message-container py-3 px-2.5 w-full"
                >
                  <!-- Chat Bubble -->
                  <ul class="space-y-5">
                    <li v-for="message in messages" :key="message.id">
                      <div v-if="message.store_id === $page.props.auth.store?.id">
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
                <StoreChatMessageForm :conversation="selectedConversation" />
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
    </div>
  </SellerDashboardLayout>
</template>

<style>
.message-container::-webkit-scrollbar {
  display: none;
}
</style>
