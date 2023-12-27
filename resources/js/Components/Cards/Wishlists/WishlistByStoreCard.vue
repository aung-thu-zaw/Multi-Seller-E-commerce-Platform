<script setup>
import { Link } from '@inertiajs/vue3'
import WishlistItemCard from './WishlistItemCard.vue'

defineProps({ wishlistGroup: Object })
</script>

<template>
  <div class="px-5">
    <div class="mb-5 flex items-center justify-between">
      <h3 class="font-bold text-md text-gray-800">
        Item(s) from
        <span class="text-orange-600">
          {{ wishlistGroup[0].store?.store_name }}
        </span>
      </h3>
      <Link
        as="button"
        :href="route('stores.show', { store: wishlistGroup[0].store?.slug })"
        :data="{ tab: 'home' }"
        class="font-bold text-sm text-orange-600 hover:text-orange-700"
      >
        <i class="fa-solid fa-store"></i>
        Go To Store
        <i class="fa-solid fa-arrow-right ml-2"></i>
      </Link>
    </div>

    <div class="">
      <WishlistItemCard v-for="wishlist in wishlistGroup" :key="wishlist.id" :wishlist="wishlist" />
    </div>
  </div>
</template>
