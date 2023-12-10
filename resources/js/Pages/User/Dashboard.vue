<!-- <script setup>
import UserDashboardLayout from '@/Layouts/UserDashboardLayout.vue'
import { Head, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

defineProps({ mustVerifyEmail: Boolean, status: String })

const user = computed(() => usePage().props.auth?.user)
</script>

<template>
  <Head :title="user?.name + '\'s ' + __('Dashboard')" />

  <UserDashboardLayout>
    <div class="ms-6 w-full pt-10">this is my dashboard</div>
  </UserDashboardLayout>
</template> -->


<script setup>
import UserDashboardLayout from '@/Layouts/UserDashboardLayout.vue'
import NormalButton from '@/Components/Buttons/NormalButton.vue'
import { Head } from '@inertiajs/vue3'
</script>

<template>
  <Head :title="__('My Wishlists')" />
</template>
