<script setup>
import { router } from '@inertiajs/vue3'
import dayjs from 'dayjs'
import relativeTime from 'dayjs/plugin/relativeTime'
dayjs.extend(relativeTime)

const props = defineProps({ notification: Object })

const handleNotificationReadAt = () => {
  router.post(
    route('notifications.mark-as-read', props.notification.id),
    {},
    {
      onSuccess: () => {
        router.get(
          route('admin.claims-as-a-seller.show', {
            seller_request: props.notification.data?.seller_request
          })
        )
      }
    }
  )
}
</script>

<template>
  <div
    @click="handleNotificationReadAt"
    class="flex px-4 py-3 w-full overflow-hidden border-b border-gray-200"
    :class="{
      'bg-gray-100 ': notification.read_at,
      'hover:bg-gray-50 ': !notification.read_at
    }"
  >
    <div class="flex-shrink-0">
      <img
        class="rounded-full object-cover w-11 h-11"
        :src="notification.data?.user?.avatar"
        :alt="notification.data?.user?.name"
      />
      <div
        class="absolute flex items-center justify-center w-5 h-5 ms-6 -mt-5 bg-amber-700 border border-white text-white rounded-full"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 24 24"
          fill="currentColor"
          class="w-2.5 h-2.5 text-white"
        >
          <path
            d="M5.223 2.25c-.497 0-.974.198-1.325.55l-1.3 1.298A3.75 3.75 0 007.5 9.75c.627.47 1.406.75 2.25.75.844 0 1.624-.28 2.25-.75.626.47 1.406.75 2.25.75.844 0 1.623-.28 2.25-.75a3.75 3.75 0 004.902-5.652l-1.3-1.299a1.875 1.875 0 00-1.325-.549H5.223z"
          />
          <path
            fill-rule="evenodd"
            d="M3 20.25v-8.755c1.42.674 3.08.673 4.5 0A5.234 5.234 0 009.75 12c.804 0 1.568-.182 2.25-.506a5.234 5.234 0 002.25.506c.804 0 1.567-.182 2.25-.506 1.42.674 3.08.675 4.5.001v8.755h.75a.75.75 0 010 1.5H2.25a.75.75 0 010-1.5H3zm3-6a.75.75 0 01.75-.75h3a.75.75 0 01.75.75v3a.75.75 0 01-.75.75h-3a.75.75 0 01-.75-.75v-3zm8.25-.75a.75.75 0 00-.75.75v5.25c0 .414.336.75.75.75h3a.75.75 0 00.75-.75v-5.25a.75.75 0 00-.75-.75h-3z"
            clip-rule="evenodd"
          />
        </svg>
      </div>
    </div>
    <div class="w-full ps-3">
      <div class="text-gray-600 font-medium text-sm mb-1.5 w-full line-clamp-2">
        {{
          __('You have a new seller request from :label', { label: notification.data?.user?.name })
        }}
      </div>
      <div
        class="text-xs font-semibold text-gray-500"
        :class="{ 'text-orange-600': !notification.read_at }"
      >
        {{ dayjs(notification.created_at).fromNow() }}
      </div>
    </div>
  </div>
</template>
