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
        router.get(route('products.show', { product: props.notification.data?.product }), {
          tab: 'questions-and-answers'
        })
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
        :src="notification.data?.store?.avatar"
        :alt="notification.data?.store?.store_name"
      />
      <div
        class="absolute flex items-center justify-center w-5 h-5 ms-6 -mt-5 bg-orange-700 border border-white rounded-full"
      >
        <svg
          class="w-2.5 h-2.5 text-white"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          fill="currentColor"
          viewBox="0 0 20 18"
        >
          <path
            d="M18 0H2a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h3.546l3.2 3.659a1 1 0 0 0 1.506 0L13.454 14H18a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-8 10H5a1 1 0 0 1 0-2h5a1 1 0 1 1 0 2Zm5-4H5a1 1 0 0 1 0-2h10a1 1 0 1 1 0 2Z"
          />
        </svg>
      </div>
    </div>
    <div class="w-full ps-3">
      <div class="text-gray-600 font-medium text-sm mb-1.5 w-full line-clamp-2">
        {{
          __('Your product question has been replied to by :label', {
            label: notification.data?.store?.store_name
          })
        }}
        : "{{ notification.data?.answer }}"
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
