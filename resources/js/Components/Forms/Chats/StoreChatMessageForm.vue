<script setup>
import EmojiPicker from 'vue3-emoji-picker'
import 'vue3-emoji-picker/css'
import { usePage } from '@inertiajs/vue3'
import { reactive, ref } from 'vue'
import axios from 'axios'

const props = defineProps({ conversation: Object })

const isOpenedEmojiBox = ref(false)

const onSelectEmoji = (emoji) => {
  form.message += emoji.i
}

const form = reactive({
  customer_id: null,
  store_id: usePage().props.auth.store ? usePage().props.auth.store.id : null,
  message: '',
  reply_to_message_id: null,
  files: [],
  captcha_token: null
})

const handleSendMessage = () => {
  axios
    .post(route('conversation.messages.store', { conversation: props.conversation?.id }), {
      customer_id: form.customer_id,
      store_id: form.store_id,
      message: form.message,
      reply_to_message_id: form.reply_to_message_id,
      files: form.files
    })
    .then(() => {
      form.message = ''
    })
    .catch((error) => {
      console.error(error)
    })
}
</script>

<template>
  <div class="relative border-t w-full p-5 bg-gray-50">
    <div v-show="isOpenedEmojiBox" class="absolute z-10 -top-[19rem]">
      <EmojiPicker @select="onSelectEmoji" />
    </div>

    <form @submit.prevent="handleSendMessage">
      <div class="relative w-full">
        <input
          type="text"
          class="w-full focus:ring-0 border border-gray-400 rounded-full p-4 pl-[70px] pr-[60px] text-sm font-medium text-gray-600 focus:border-gray-400"
          placeholder="Type a message ..."
          v-model="form.message"
          @focus="isOpenedEmojiBox = false"
        />

        <div class="absolute top-1/3 left-4 text-sm flex items-center space-x-3 text-gray-500">
          <!-- File Attachment -->
          <label for="input-file">
            <div class="hover:text-orange-500 cursor-pointer">
              <i class="fa-solid fa-image"></i>
            </div>
            <input id="input-file" type="file" class="hidden" multiple />
          </label>

          <span
            @click="isOpenedEmojiBox = !isOpenedEmojiBox"
            class="hover:text-orange-500 cursor-pointer"
          >
            <i class="fa-solid fa-face-smile"></i>
          </span>
        </div>

        <button
          type="submit"
          class="absolute top-1/3 right-5 text-md flex items-center space-x-3 text-gray-300"
          :class="{ 'text-gray-500': form.message }"
        >
          <i class="fa-solid fa-paper-plane"></i>
        </button>
      </div>
    </form>
  </div>
</template>
