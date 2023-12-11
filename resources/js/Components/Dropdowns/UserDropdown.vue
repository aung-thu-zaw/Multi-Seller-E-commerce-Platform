<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'
import defaultUserImage from '@/assets/images/anonymous-user.jpg'

const user = computed(() => usePage().props.auth?.user)
</script>

<template>
  <div class="hs-dropdown relative inline-flex">
    <button
      id="hs-dropdown-with-icons"
      type="button"
      class="hs-dropdown-toggle inline-flex items-center"
    >
      <div class="items-center flex">
        <span
          class="w-12 h-12 text-sm text-white bg-slate-200 inline-flex items-center justify-center rounded-full ring-2"
        >
          <img
            alt="user-photo"
            class="w-full h-full object-cover rounded-full align-middle border-none shadow-lg ring-2 ring-orange-300"
            :src="user?.avatar ?? defaultUserImage"
          />
        </span>

        <span
          v-if="$page.url.startsWith('/admin') || $page.url.startsWith('/seller')"
          class="font-bold ml-2 hidden md:block"
          :class="{
            'text-slate-600 md:text-white':
              $page.url === '/admin/dashboard' || $page.url === '/seller/dashboard',

            'text-slate-600 md:text-white':
              $page.url !== '/admin/dashboard' || $page.url !== '/seller/dashboard'
          }"
        >
          {{ user?.name }}
        </span>
        <span v-else class="font-bold ml-2 text-slate-600 hidden md:block">{{ user?.name }} </span>
      </div>
    </button>

    <div
      class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-[15rem] bg-white shadow-md rounded-lg p-2 mt-2 divide-y divide-gray-200 border border-gray-300"
      aria-labelledby="hs-dropdown-with-icons"
    >
      <div class="py-2 first:pt-0 last:pb-0">
        <div
          class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
        >
          <Link
            as="button"
            :href="route('user.my-account.edit')"
            class="text-left text-sm font-semibold block w-full whitespace-nowrap bg-transparent text-slate-700"
          >
            <i class="fa-regular fa-id-card mr-1.5"></i>
            {{ __('My Account') }}
          </Link>
        </div>

        <div
          class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
        >
          <Link
            as="button"
            href="#"
            class="text-left text-sm font-semibold block w-full whitespace-nowrap bg-transparent text-slate-700"
          >
            <i class="fa-solid fa-boxes-packing mr-1.5"></i>
            {{ __('My Orders') }}
          </Link>
        </div>

        <div
          class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
        >
          <Link
            as="button"
            href="#"
            class="text-left text-sm font-semibold block w-full whitespace-nowrap bg-transparent text-slate-700"
          >
            <i class="fa-solid fa-heart mr-1.5"></i>
            {{ __('My Wishlists') }}
          </Link>
        </div>

        <div
          class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
        >
          <Link
            as="button"
            href="#"
            class="text-left text-sm font-semibold block w-full whitespace-nowrap bg-transparent text-slate-700"
          >
            <i class="fa-solid fa-star mr-1.5"></i>
            {{ __('My Reviews') }}
          </Link>
        </div>

        <div
          class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
        >
          <Link
            as="button"
            href="#"
            class="text-left text-sm font-semibold block w-full whitespace-nowrap bg-transparent text-slate-700"
          >
            <i class="fa-solid fa-rotate-left mr-1.5"></i>
            {{ __('My Returns & Cancellations') }}
          </Link>
        </div>
      </div>

      <div class="py-2 first:pt-0 last:pb-0">
        <div
          class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
        >
          <Link
            as="button"
            method="post"
            :href="route('logout')"
            class="text-left text-sm font-semibold block w-full whitespace-nowrap bg-transparent text-slate-700"
          >
            <i class="fa-solid fa-right-from-bracket mr-1.5"></i>

            {{ __('Logout') }}
          </Link>
        </div>
      </div>
    </div>
  </div>
</template>
