<script setup>
import admin from '@/assets/images/admin-login.jpg'
import seller from '@/assets/images/seller-login.jpg'
import user from '@/assets/images/user-login.jpg'
</script>

<template>
  <div class="container mx-auto p-5 md:p-10 flex items-center justify-center">
    <div
      class="relative flex flex-col items-center md:min-h-[500px] justify-between px-10 py-10 bg-white border rounded-sm shadow-md md:flex-row md:px-5 md:w-[1000px]"
    >
      <img
        v-show="$page.url === '/login' || $page.url === '/register'"
        :src="user"
        alt="user-login"
        class="w-full md:w-1/2"
      />
      <img
        v-show="$page.url === '/seller/login' || $page.url === '/seller/register'"
        :src="seller"
        alt="seller-login"
        class="w-full md:w-1/2"
      />
      <img
        v-show="$page.url === '/admin/login'"
        :src="admin"
        alt="admin-login"
        class="w-full md:w-1/2"
      />
      <div class="flex flex-col items-center bg-white w-full md:px-5 md:w-1/2">
        <slot />
      </div>
    </div>
  </div>
</template>
