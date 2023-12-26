<script setup>
import { usePage } from '@inertiajs/vue3'
import { computed, onMounted, ref } from 'vue'

const props = defineProps({ conversation: Object })

const conversationMessages = ref(props.conversation ? props.conversation.conversation_messages : [])

const isCustomer = computed(() => {
  return usePage().props.auth?.user?.id === props.conversation.customer_id
})

const lastMessage = computed(() => {
  return conversationMessages.value
    ? conversationMessages.value[conversationMessages.value?.length - 1]
    : null
})

const unreadMessageCountForStore = computed(() => {
  const messages = conversationMessages.value.length
    ? conversationMessages.value.filter((message) => {
        return message.is_read_by_store === 0
      })
    : []

  return messages ? messages.length : null
})

const unreadMessageCountForCustomer = computed(() => {
  const messages = conversationMessages.value.length
    ? conversationMessages.value.filter((message) => {
        return message.is_read_by_customer === 0
      })
    : []

  return messages ? messages.length : null
})

onMounted(() => {
  Echo.leave(`conversation.${props.conversation.id}`)
  Echo.private(`conversation.${props.conversation.id}`)
    .listen('ConversationMessageSent', (message) => {
      conversationMessages.value.push(message.message)
    })
    .listenForWhisper('typing', (e) => {
      console.log('Typing:', e)
    })
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

          <div
            v-show="lastMessage"
            class="text-[.7rem] text-gray-500 font-medium line-clamp-1 flex items-center"
          >
            <div class="max-w-[100px] line-clamp-1">
              <span
                v-if="$page.url.startsWith('/seller/chat-inbox')"
                class="w-auto mr-1"
                :class="{
                  'text-blue-600': $page.url.startsWith('/seller/chat-inbox'),
                  'text-orange-600': !$page.url.startsWith('/seller/chat-inbox')
                }"
              >
                {{
                  lastMessage?.store_id === $page.props.auth.store?.id
                    ? 'You'
                    : lastMessage?.customer?.name
                }}
                :
              </span>
              <span
                v-else
                class="w-auto mr-1"
                :class="{
                  'text-blue-600': $page.url.startsWith('/seller/chat-inbox'),
                  'text-orange-600': !$page.url.startsWith('/seller/chat-inbox')
                }"
              >
                {{
                  lastMessage?.customer_id === $page.props.auth.user?.id
                    ? 'You'
                    : lastMessage?.store?.store_name
                }}
                :
              </span>
            </div>

            <span class="text-gray-600 line-clamp-1 w-auto">
              <!-- {{ lastMessage.message ? lastMessage?.message : 'Send ' + 3 + ' File(s)' }} -->

              {{ lastMessage?.message }}
            </span>
          </div>
        </div>
        <div class="flex flex-col items-end justify-between">
          <span class="font-medium text-xs text-gray-600 mb-1">{{ lastMessage?.created_at }}</span>
          <span
            v-if="$page.url.startsWith('/seller/chat-inbox') && unreadMessageCountForStore"
            class="font-medium text-[.6rem] w-3 h-3 text-white flex items-center justify-center rounded-full p-2 bg-blue-600"
          >
            {{ unreadMessageCountForStore }}
          </span>
          <span
            v-else-if="!$page.url.startsWith('/seller/chat-inbox') && unreadMessageCountForCustomer"
            class="font-medium text-[.6rem] w-3 h-3 text-white flex items-center justify-center rounded-full p-2 bg-orange-600"
          >
            {{ unreadMessageCountForCustomer }}
          </span>
        </div>
      </div>
    </div>
  </div>
</template>
