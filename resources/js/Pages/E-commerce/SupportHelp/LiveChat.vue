<script setup>
import { Head } from "@inertiajs/vue3";
import OrangeBadge from "@/Components/Badges/OrangeBadge.vue";
import NormalButton from "@/Components/Buttons/NormalButton.vue";
import SenderMessageBubble from "@/Components/Cards/Chats/SenderMessageBubble.vue";
import ReceiverMessageBubble from "@/Components/Cards/Chats/ReceiverMessageBubble.vue";
import EcommerceSenderMessageForm from "@/Components/Forms/Chats/EcommerceSenderMessageForm.vue";
</script>


<template>
  <Head title="Support Live Chat : E-commerce Online Shopping" />

  <section id="live-chat" class="background">
    <div
      class="min-h-screen w-full py-16 px-40 flex items-center justify-center"
    >
      <div
        class="container mx-auto border border-gray-400 shadow-sm rounded-md overflow-hidden"
      >
        <nav
          class="py-5 px-10 border-b flex items-center justify-between bg-gray-50"
        >
          <div class="flex items-center space-x-3">
            <img
              src="https://img.freepik.com/free-psd/3d-illustration-person-with-sunglasses_23-2149436188.jpg?size=626&ext=jpg&ga=GA1.1.952580598.1700452342&semt=ais"
              alt=""
              class="w-10 h-10 rounded-full ring-2 ring-orange-200 object-cover"
            />
            <div class="flex items-center space-x-2">
              <h3 class="font-bold text-gray-700 text-md">Aung Thu Zaw</h3>
              <OrangeBadge>
                <i class="fa-solid fa-headset"></i>
                Support Agent
              </OrangeBadge>
            </div>
          </div>

          <NormalButton
            class="text-white bg-red-600 ring-2 ring-red-300 hover:bg-red-700"
          >
            End Chat
          </NormalButton>
        </nav>

        <div class="bg-white">
          <div class="h-[650px] flex items-center justify-center w-full">
            <div class="flex flex-col items-center w-full h-full">
              <div class="h-full overflow-scroll py-5 px-6 w-full">
                <!-- Chat Bubble -->
                <ul class="space-y-5">
                  <ReceiverMessageBubble />

                  <SenderMessageBubble />

                  <ReceiverMessageBubble />

                  <ReceiverMessageBubble />

                  <ReceiverMessageBubble />

                  <SenderMessageBubble />

                  <SenderMessageBubble />

                  <Review/>
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
  </section>
</template>


<style>
.background {
  background-image: url("https://png.pngtree.com/background/20220718/original/pngtree-3d-smartphone-with-floating-chat-bubble-app-online-shopping-bag-picture-image_1661411.jpg");
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
  background-color: rgba(0, 0, 0, 0.159);
  background-blend-mode: overlay;
}

.scrollbar {
  scrollbar-width: thin;
  scrollbar-color: #999 #f0f0f0;
}

.scrollbar::-webkit-scrollbar {
  width: 6px;
}

.scrollbar::-webkit-scrollbar-track {
  background-color: #f0f0f0;
}

.scrollbar::-webkit-scrollbar-thumb {
  background-color: #999;
  border-radius: 3px;
}
</style>
