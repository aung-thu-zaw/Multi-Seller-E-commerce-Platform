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
import { Head, Link } from '@inertiajs/vue3'
</script>

<template>
  <Head :title="__('Followed Stores')" />
  <UserDashboardLayout>
    <h1 class="font-bold text-md text-gray-700 mb-5 pb-5 border-b">
      <i class="fa-solid fa-store"></i>
      {{ __('Followed Stores') }}
    </h1>

    <div class="px-8 py-10 border border-gray-200 bg-white rounded-md space-y-5">
  

      <!-- <h2 class="font-semibold text-md text-center text-gray-600">
        <i class="fas fa-shop"></i>

        You didn't follow any shop.
      </h2> -->
    </div>
  </UserDashboardLayout>
</template>
