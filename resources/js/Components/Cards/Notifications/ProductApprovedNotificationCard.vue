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
        router.get(route('products.show', { product: props.notification.data?.product?.slug }))
      }
    }
  )
}
</script>

<template>
  <div
    @click="handleNotificationReadAt"
    class="flex px-4 py-3 w-full overflow-hidden border-b border-gray-200 cursor-pointer"
    :class="{
      'bg-gray-100 ': notification.read_at,
      'hover:bg-gray-50 ': !notification.read_at
    }"
  >
    <div class="flex-shrink-0">
      <img
        class="rounded-full object-cover w-11 h-11"
        src="https://static.vecteezy.com/system/resources/previews/002/002/403/original/man-with-beard-avatar-character-isolated-icon-free-vector.jpg"
        alt="admin"
      />
      <div
        class="absolute flex items-center justify-center w-5 h-5 ms-6 -mt-5 bg-green-700 border border-white rounded-full"
      >
        <svg
          class="w-2.5 h-2.5 text-white"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          fill="currentColor"
          viewBox="0 0 20 20"
        >
          <path
            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"
          />
        </svg>
      </div>
    </div>
    <div class="w-full ps-3">
      <div class="text-gray-600 font-medium text-sm mb-1.5 w-full line-clamp-2">
        {{ __('Your product has been approved by admin.') }}
        {{ __('Product') }} : "{{ notification.data?.product?.name }}"
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
