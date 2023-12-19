<script setup>
import UserDashboardLayout from '@/Layouts/UserDashboardLayout.vue'
import WishlistByStoreCard from '@/Components/Cards/Wishlists/WishlistByStoreCard.vue'
import { Head } from '@inertiajs/vue3'
import { computed } from 'vue'

const props = defineProps({ myWishlists: Object })

const groupByStore = computed(() => {
  const grouped = {}
  for (const wishlist of props.myWishlists) {
    const storeId = wishlist.product?.store_id
    if (storeId) {
      if (!grouped[storeId]) {
        grouped[storeId] = []
      }
      grouped[storeId].push(wishlist)
    }
  }
  return Object.values(grouped)
})
</script>

<template>
  <Head :title="__('My Wishlists')" />

  <UserDashboardLayout>
    <h1 class="font-bold text-md text-gray-700 mb-5 pb-5 border-b">
      <i class="fa-solid fa-heart"></i>
      {{ __('My Wishlists') }} ({{ myWishlists?.length }})
    </h1>

    <div class="py-5 border border-gray-200 bg-white rounded-md">
      <div v-if="myWishlists.length">
        <div
          v-for="(wishlistGroup, index) in groupByStore"
          :key="index"
          :class="{ 'border-b border-gray-200': index < groupByStore.length - 1 }"
          class="py-5"
        >
          <WishlistByStoreCard :wishlistGroup="wishlistGroup" />
        </div>
      </div>
      <div v-else>
        <h2 class="font-semibold text-md text-center text-gray-600">
          <i class="fas fa-heart"></i>
          <br />

          There are no favorites yet.
          <br />

          Add your favorites to wishlists and they will show here.
        </h2>
      </div>
    </div>
  </UserDashboardLayout>
</template>
