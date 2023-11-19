<script setup>
import EcommerceNavbar from "@/Components/Navbars/EcommerceNavbar.vue";
import EcommerceFooter from "@/Components/Footers/EcommerceFooter.vue";
import EcommerceChatWidget from "@/Components/Chats/EcommerceChatWidget.vue";
</script>

<template>
  <div class="min-w-[1440px] max-w-full min-h-screen font-roboto bg-gray-50">
    <EcommerceChatWidget />

    <EcommerceNavbar />

    <slot />

    <EcommerceFooter />
  </div>
</template>
