<script setup>
import AvgRating from '@/Components/Ratings/AvgRating.vue'
import { router, usePage } from '@inertiajs/vue3'
import { computed, inject } from 'vue'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'

const props = defineProps({ store: Object })

const swal = inject('$swal')

const avgRating = computed(() => {
  const rawAvgRating = props.store?.store_reviews_avg_rating

  const avgRatingValue = parseFloat(rawAvgRating)

  if (!Number.isNaN(avgRatingValue)) {
    return avgRatingValue.toFixed(1)
  }

  return null
})

const isFollowed = computed(() => {
  return props.store?.followers.find((follower) => {
    return follower.pivot.user_id === usePage().props.auth.user?.id
  })
})

const handleStoreFollowing = async () => {
  if (isFollowed.value) {
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
  } else {
    router.post(
      route('stores.follow', { store: props.store?.slug }),
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
</script>

<template>
  <div
    class="w-full h-[300px] mb-10 shadow-md rounded-md overflow-hidden flex items-end px-10 py-6 seller-background"
    :style="{ 'background-image': `url('${store.cover}')` }"
  >
    <div class="flex items-center justify-between w-full">
      <div class="flex items-center space-x-5">
        <img :src="store?.avatar" alt="store-avatar" class="w-36 h-36 rounded-md" />
        <div class="font-semibold text-white space-y-3">
          <div
            v-show="store?.store_type === 'business'"
            class="shadow px-3 rounded-sm py-1 font-bold uppercase text-[0.6rem] text-white bg-orange-600 inline-block border border-orange-400 space-x-2"
          >
            <span>
              <i class="fas fa-crown"></i>
              Official Store
            </span>
          </div>
          <h3 class="text-2xl">{{ store?.store_name }}</h3>

          <p class="text-sm text-white mt-2">{{ store?.followers.length }} Followers</p>

          <div v-show="avgRating > 0">
            <!-- Rating -->
            <AvgRating :avgRating="avgRating" />
            <!-- End Rating -->
          </div>
        </div>
      </div>

      <div class="space-x-5 self-end">
        <button
          class="font-bold bg-white text-gray-700 hover:bg-gray-200 duration-200 px-5 py-2.5 rounded-md text-sm"
        >
          <i class="fa-solid fa-message"></i>
          Chat Now
        </button>
        <button
          @click="handleStoreFollowing"
          class="font-bold text-white bg-orange-600 hover:bg-orange-700 duration-200 px-5 py-2.5 rounded-md text-sm"
        >
          <span v-if="isFollowed">
            <i class="fa-solid fa-check"></i>
            Following
          </span>
          <span v-else>
            <i class="fa-solid fa-store"></i>
            Follow Store
          </span>
        </button>
      </div>
    </div>
  </div>
</template>
<!-- background-image: url('https://media.licdn.com/dms/image/C4E12AQGlzsYoKqxHkA/article-cover_image-shrink_600_2000/0/1634130038864?e=2147483647&v=beta&t=cmCQHpCHmQQfxEya-gVJGNUQe7E6ruQ3xxs-841Jd6c'); -->

<style>
.seller-background {
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
  background-color: rgba(0, 0, 0, 0.5);
  background-blend-mode: overlay;
}

.badge-gradient {
  background: rgb(234, 88, 11);
  background: linear-gradient(
    100deg,
    rgba(234, 88, 11, 1) 0%,
    rgba(234, 88, 11, 0.9430365896358543) 53%,
    rgba(255, 255, 255, 1) 53%
  );
}
</style>
