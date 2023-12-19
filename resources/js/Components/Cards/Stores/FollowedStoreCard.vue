<script setup>
import StarRating from '@/Components/Ratings/StarRating.vue'
import { Link } from '@inertiajs/vue3'
import { router, usePage } from '@inertiajs/vue3'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'
import { computed, inject } from 'vue'

const props = defineProps({ store: Object })

const swal = inject('$swal')

const handleStoreUnFollow = async () => {
  const result = await swal({
    icon: 'question',
    title: 'Are you sure you want unfollow this store?',
    text: "If you unfollow selected store, you won't be able to view the latest arrival and sales from them anymore.",
    showCancelButton: true,
    confirmButtonText: 'Yes, Unfollow!',
    confirmButtonColor: '#2562c4',
    cancelButtonColor: '#626262',
    timer: 20000,
    timerProgressBar: true,
    reverseButtons: true
  })

  if (result.isConfirmed) {
    router.post(
      route('stores.unfollow', { store: props.store?.slug }),
      {},
      {
        preserveScroll: true,
        onSuccess: () => {
          if (usePage().props.flash.success) {
            toast.success(usePage().props.flash.success, {
              autoClose: 2000
            })
          }
        }
      }
    )
  }
}

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
  <div class="border border-gray-200 rounded-md flex items-center justify-between space-x-5 p-5">
    <div class="flex items-center">
      <div class="min-w-[100px] overflow-hidden">
        <img :src="store?.avatar" alt="store-avatar" class="w-20 h-20 object-cover rounded-md" />
      </div>
      <div class="space-y-2 max-w-[500px]">
        <div class="flex items-center space-x-2">
          <h3 class="font-semibold text-md text-gray-700">
            {{ store?.store_name }}
          </h3>

          <span
            v-show="store?.store_type === 'business'"
            class="shadow px-3 rounded-full py-1 font-bold uppercase text-[0.6rem] text-white bg-orange-600 inline-block border border-orange-400 space-x-2"
          >
            <i class="fas fa-crown"></i>
            Official
          </span>
        </div>

        <div class="flex items-center space-x-3 my-5">
          <StarRating :rating="avgRating" />

          <p class="font-bold text-gray-600 text-xs">{{ avgRating ?? 0 }} out of 5</p>
        </div>
      </div>
    </div>

    <div class="space-x-5">
      <button
        @click="handleStoreUnFollow"
        class="text-sm font-semibold text-blue-600 hover:text-blue-700"
      >
        <i class="fa-solid fa-check"></i>
        Following
      </button>

      <span class="border border-gray-500"></span>

      <Link
        as="button"
        :href="route('stores.show', { store: store?.slug })"
        :data="{ tab: 'home' }"
        class="text-sm font-semibold text-orange-600 hover:text-orange-500"
      >
        <i class="fa-solid fa-store"></i>
        Visit Store
      </Link>
    </div>
  </div>
</template>
