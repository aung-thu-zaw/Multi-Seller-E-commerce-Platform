<script setup>
import StarRating from '@/Components/Ratings/StarRating.vue'
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'

const props = defineProps({ store: Object })

const avgRating = computed(() => {
  const rawAvgRating = props.store?.store_reviews_avg_rating

  const avgRatingValue = parseFloat(rawAvgRating)

  if (!Number.isNaN(avgRatingValue)) {
    return avgRatingValue.toFixed(1)
  }

  return null
})
</script>

<template>
  <div class="shadow-md bg-white rounded-md flex items-center h-[180px] border border-gray-300">
    <div
      class="flex flex-col items-center justify-center w-[300px] h-full border-r border-r-slate-300 p-2"
    >
      <img :src="store.avatar" alt="store-avatar" class="rounded-md w-12 h-12 object-cover" />

      <div class="mt-3 flex flex-col items-center justify-between">
        <h1 class="font-bold text-sm text-slate-600 text-center line-clamp-2">
          {{ store.store_name }}
        </h1>

        <div v-show="avgRating > 0" class="space-y-2 mt-5">
          <!-- Rating -->
          <StarRating :rating="avgRating" />
          <!-- End Rating -->

          <p class="font-bold text-gray-600 text-xs text-center">{{ avgRating }} out of 5</p>
        </div>
      </div>
    </div>
    <div class="w-full h-full px-3 py-5 flex flex-col items-center justify-between">
      <div class="flex items-start justify-between w-full">
        <div>
          <p class="text-md text-gray-600 font-semibold border-b border-b-slate-400 mb-2">
            Products
          </p>
          <p class="text-sm text-gray-500 text-center">{{ store?.products_count }}</p>
        </div>
        <div>
          <p class="text-md text-gray-600 font-semibold border-b border-b-slate-400 mb-2">
            Followers
          </p>
          <p class="text-sm text-gray-500 text-center">{{ store?.followers_count }}</p>
        </div>
      </div>

      <Link
        as="button"
        :href="route('stores.show', { store: store?.slug })"
        :data="{ tab: 'home' }"
        class="border border-orange-600 px-2 py-2 text-orange-600 text-xs font-bold rounded-sm shadow hover:bg-orange-600 hover:text-white transition-all"
      >
        <i class="fa-solid fa-store"></i>
        {{ __('Visit Store') }}
      </Link>
    </div>
  </div>
</template>
