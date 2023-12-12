<script setup>
import BlogCommentReplyNotificationCard from '@/Components/Cards/Notifications/BlogCommentReplyNotificationCard.vue'
import { router, usePage } from '@inertiajs/vue3'
import { computed, onMounted, ref } from 'vue'

const notifications = ref([])

const totalUnreadNotifications = computed(() =>
  notifications.value.filter((notification) => !notification.read_at)
)

onMounted(() => {
  notifications.value = usePage().props.auth?.notifications

  Echo.private(`App.Models.User.${usePage().props.auth.user?.id}`).notification((notification) => {
    if (notification.type === 'App\\Notifications\\Blogs\\BlogCommentReplyNotification') {
      notifications.value.unshift({
        id: notification.id,
        type: notification.type,
        data: {
          blog: notification.blog,
          reply: notification.reply,
          user: notification.user
        }
      })
    }
  })
})

const sortedNotifications = computed(() => {
  const notificationsCopy = [...notifications.value]

  return notificationsCopy.sort((a, b) => {
    const aReadAt = a.read_at ? new Date(a.read_at) : null
    const bReadAt = b.read_at ? new Date(b.read_at) : null
    const aCreatedAt = new Date(a.created_at)
    const bCreatedAt = new Date(b.created_at)

    // First, sort by read_at date, with null (unread) values first
    if (aReadAt === null && bReadAt !== null) return -1
    if (aReadAt !== null && bReadAt === null) return 1

    // Then, sort by read_at date in ascending order (oldest first)
    if (aReadAt !== null && bReadAt !== null) {
      if (aReadAt > bReadAt) return 1
      if (aReadAt < bReadAt) return -1
    }

    // If both are unread or have the same read_at date, sort by created_at date in ascending order (oldest first)
    if (aCreatedAt > bCreatedAt) return -1
    if (aCreatedAt < bCreatedAt) return 1

    return 0 // Return 0 if both read_at and created_at dates are the same
  })
})

const handleMarkAllAsRead = () => {
  router.post(
    route('notifications.mark-all-as-read'),
    {},
    {
      onSuccess: () => {
        window.location.reload()
      }
    }
  )
}
</script>

<template>
  <div class="hs-dropdown relative inline-flex [--trigger:hover] [--placement:bottom-right]">
    <button
      id="hs-dropdown-hover-event"
      type="button"
      class="relative hs-dropdown-toggle text-md text-gray-700 font-normal disabled:opacity-50 disabled:pointer-events-none hover:text-orange-500"
    >
      <i class="fa-regular fa-bell"></i>

      <div
        v-show="totalUnreadNotifications.length"
        class="absolute -top-1 -right-2 bg-orange-600 flex items-center justify-center w-3.5 h-3.5 rounded-full"
      >
        <span class="font-bold text-white text-[.6rem]">
          {{ totalUnreadNotifications.length }}
        </span>
      </div>
    </button>

    <div
      class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden w-[25rem] h-auto max-h-[40rem] overflow-auto bg-white shadow-md rounded-lg mt-2 border border-gray-300 divide-gray-500 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full"
      aria-labelledby="hs-dropdown-hover-event"
    >
      <div class="px-4 py-3 bg-gray-100 flex items-center justify-between border-b w-full">
        <span class="text-gray-700 font-semibold text-md"> {{ __('Notifications') }} </span>
        <button
          @click="handleMarkAllAsRead"
          type="button"
          class="text-orange-600 hover:text-orange-500 text-sm font-bold"
        >
          {{ __('Mark all as read') }}
        </button>
      </div>

      <div v-if="notifications.length" class="w-full">
        <div
          v-for="notification in sortedNotifications"
          :key="notification.id"
          class="divide-y divide-gray-300 w-full"
        >
          <!-- Notification Cards -->
          <BlogCommentReplyNotificationCard
            v-show="notification.type === 'App\\Notifications\\Blogs\\BlogCommentReplyNotification'"
            :notification="notification"
          />
        </div>
      </div>
      <!-- No notification -->
      <div v-else class="py-5">
        <p class="font-bold text-sm text-gray-600 text-center">
          {{ __('There are no notifications.') }}
        </p>
      </div>
    </div>
  </div>
</template>
