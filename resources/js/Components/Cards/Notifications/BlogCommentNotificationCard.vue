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
        router.get(route('blogs.show', { blog_content: props.notification.data?.blog }))
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
        :src="notification.data?.user?.avatar"
        :alt="notification.data?.user?.name"
      />
      <div
        class="absolute flex items-center justify-center w-5 h-5 ms-6 -mt-5 bg-gray-700 border border-white rounded-full"
      >
        <svg
          class="w-2.5 h-2.5"
          xmlns="http://www.w3.org/2000/svg"
          x="0px"
          y="0px"
          width="100"
          height="100"
          viewBox="0,0,256,256"
        >
          <g
            fill="#ffffff"
            fill-rule="nonzero"
            stroke="none"
            stroke-width="1"
            stroke-linecap="butt"
            stroke-linejoin="miter"
            stroke-miterlimit="10"
            stroke-dasharray=""
            stroke-dashoffset="0"
            font-family="none"
            font-weight="none"
            font-size="none"
            text-anchor="none"
            style="mix-blend-mode: normal"
          >
            <g transform="scale(8.53333,8.53333)">
              <path
                d="M15,3c-7.18,0 -13,4.925 -13,11c0,3.368 1.79333,6.37848 4.61133,8.39648c0.07195,1.53598 -0.16605,3.6569 -2.28516,4.63477c-0.0013,0.00065 -0.00261,0.0013 -0.00391,0.00195c-0.19383,0.07371 -0.32204,0.25942 -0.32227,0.4668c0,0.27614 0.22386,0.5 0.5,0.5c0.01194,0 0.02324,-0.00189 0.03516,-0.00195c0.0026,0.00002 0.00521,0.00002 0.00781,0c2.43403,-0.0156 4.5003,-1.33101 5.92578,-2.7207c0.452,-0.441 1.08212,-0.65802 1.70313,-0.54102c0.91,0.173 1.85613,0.26367 2.82813,0.26367c7.18,0 13,-4.925 13,-11c0,-6.075 -5.82,-11 -13,-11z"
              ></path>
            </g>
          </g>
        </svg>
      </div>
    </div>
    <div class="w-full ps-3">
      <div class="text-gray-600 font-medium text-sm mb-1.5 w-full line-clamp-2">
        {{ __('New blog comment from :label', { label: notification.data?.user?.name }) }}
        <!-- <span class="font-semibold text-gray-700 inline">
          {{ notification.data?.user?.name }}
        </span> -->
        : "{{ notification.data?.comment }}"
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
