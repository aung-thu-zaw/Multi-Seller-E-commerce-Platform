<script setup>
import UserDashboardLayout from '@/Layouts/UserDashboardLayout.vue'
import FollowedStoreCard from '@/Components/Cards/Stores/FollowedStoreCard.vue'
import { Head } from '@inertiajs/vue3'

defineProps({ followedStores: Object })
</script>

<template>
  <Head :title="__('Followed Stores')" />
  <UserDashboardLayout>
    <h1 class="font-bold text-md text-gray-700 mb-5 pb-5 border-b">
      <i class="fa-solid fa-store"></i>
      {{ __('Followed Stores') }} ({{ followedStores.length }})
    </h1>

    <div class="px-8 py-10 border border-gray-200 bg-white rounded-md">
      <div v-if="followedStores.length" class="space-y-5">
        <!-- card -->
        <FollowedStoreCard
          v-for="followedStore in followedStores"
          :key="followedStore.id"
          :store="followedStore?.followable"
        />
      </div>

      <div v-else class="py-20">
        <h2 class="font-semibold text-md text-center text-gray-600">
          <i class="fas fa-shop"></i>

          You didn't follow any shop.
        </h2>
      </div>
    </div>
  </UserDashboardLayout>
</template>
