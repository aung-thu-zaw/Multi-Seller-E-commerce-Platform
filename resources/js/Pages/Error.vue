<script setup>
import { Head, Link } from '@inertiajs/vue3'
import { computed } from 'vue'

const props = defineProps({ status: Number })
const title = computed(() => {
  return {
    503: '503: Service Unavailable',
    500: '500: Server Error',
    429: '429: Too Many Requests',
    404: '404: Page Not Found',
    403: '403: Forbidden',
    401: '401: Unauthorized',
    400: '400: Bad Request'
  }[props.status]
})

const description = computed(() => {
  return {
    503: 'Sorry, we are doing some maintenance. Please check back soon.',
    500: 'Whoops, something went wrong on our servers.',
    429: 'Too many requests were made from your IP address. Please wait a bit before trying again.',
    404: 'Sorry, the page you are looking for could not be found.',
    403: 'Sorry, you are forbidden from accessing this page.',
    401: 'You are not authorized to access this resource.',
    400: 'Oops, there was a problem with your request. Please check the provided data and try again.'
  }[props.status]
})
</script>

<template>
  <Head :title="title" />
  <div>
    <div class="container mx-auto flex items-center justify-center min-h-screen">
      <div class="flex flex-col items-center">
        <img v-if="status === 503" src="../assets/images/503.jpg" class="h-[500px]" />
        <img v-if="status === 500" src="../assets/images/500.jpg" class="h-[500px]" />
        <img v-if="status === 429" src="../assets/images/429.jpg" class="h-[500px]" />
        <img v-if="status === 404" src="../assets/images/404.jpg" class="h-[500px]" />
        <img v-if="status === 403" src="../assets/images/403.jpg" class="h-[500px]" />
        <img v-if="status === 401" src="../assets/images/401.jpg" class="h-[500px]" />
        <img v-if="status === 400" src="../assets/images/400.jpg" class="h-[500px]" />
        <p class="text-3xl font-bold text-gray-700 mb-10">
          {{ description }}
        </p>

        <Link
          as="button"
          :href="route('home')"
          class="text-xs font-bold px-5 py-3 rounded-sm border border-orange-600 text-orange-600 hover:text-white hover:bg-orange-700 transition-all"
        >
          <i class="fa-solid fa-arrow-left"></i>
          Go Back To Home
        </Link>
      </div>
    </div>
  </div>
</template>
