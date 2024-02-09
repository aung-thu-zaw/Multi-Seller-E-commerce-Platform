<script setup>
import UserDashboardLayout from '@/Layouts/UserDashboardLayout.vue'
import { Head, usePage } from '@inertiajs/vue3'
import { __ } from '@/Services/translations-inside-setup.js'
import { computed } from 'vue'

const user = computed(() => usePage().props.auth?.user)
</script>

<template>
  <Head :title="user?.name + '\'s ' + __('Dashboard')" />

  <UserDashboardLayout>
    <h1 class="font-bold text-md text-gray-700 mb-5 pb-5 border-b">
      <i class="fa-solid fa-lock"></i>
      {{ __('Dashboard') }}
    </h1>

    <div class="p-10 border border-gray-200 bg-white rounded-md">
      <h1>This is my dashboard</h1>
    </div>
  </UserDashboardLayout>
</template>
