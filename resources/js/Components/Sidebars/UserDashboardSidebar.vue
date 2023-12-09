<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <div class="w-[300px]">
    <h1 class="font-bold text-md text-orange-600 mb-5 px-5">
      Welcome, {{ $page.props.auth?.user?.name }}
    </h1>
    <nav
      class="flex flex-col space-y-2"
      aria-label="Tabs"
      role="tablist"
      data-hs-tabs-vertical="true"
    >
      <Link
        :href="route('user.dashboard')"
        as="button"
        class="hs-tab-active:border-orange-500 hs-tab-active:text-orange-600 py-1 pe-4 inline-flex items-center gap-x-2 border-s-2 px-5 border-transparent text-sm whitespace-nowrap font-semibold text-gray-600 hover:text-orange-600 focus:outline-none focus:text-orange-600 disabled:opacity-50 disabled:pointer-events-none"
      >
        <i class="fa-solid fa-tv"></i>
        Dashboard
      </Link>

      <Link
        href="#"
        as="button"
        class="hs-tab-active:border-orange-500 hs-tab-active:text-orange-600 py-1 pe-4 inline-flex items-center gap-x-2 border-s-2 px-5 border-transparent text-sm whitespace-nowrap font-semibold text-gray-600 hover:text-orange-600 focus:outline-none focus:text-orange-600 disabled:opacity-50 disabled:pointer-events-none active"
      >
        <i class="fa-regular fa-id-card"></i>
        My Account
      </Link>

      <Link
        href="#"
        as="button"
        class="hs-tab-active:border-orange-500 hs-tab-active:text-orange-600 py-1 pe-4 inline-flex items-center gap-x-2 border-s-2 px-5 border-transparent text-sm whitespace-nowrap font-semibold text-gray-600 hover:text-orange-600 focus:outline-none focus:text-orange-600 disabled:opacity-50 disabled:pointer-events-none active"
      >
        <i class="fa-solid fa-lock"></i>
        Change Password
      </Link>

      <Link
        href="#"
        as="button"
        class="hs-tab-active:border-orange-500 hs-tab-active:text-orange-600 py-1 pe-4 inline-flex items-center gap-x-2 border-s-2 px-5 border-transparent text-sm whitespace-nowrap font-semibold text-gray-600 hover:text-orange-600 focus:outline-none focus:text-orange-600 disabled:opacity-50 disabled:pointer-events-none active"
      >
        <i class="fa-solid fa-ban"></i>
        Delete Account
      </Link>

      <Link
        href="#"
        as="button"
        class="hs-tab-active:border-orange-500 hs-tab-active:text-orange-600 py-1 pe-4 inline-flex items-center gap-x-2 border-s-2 px-5 border-transparent text-sm whitespace-nowrap font-semibold text-gray-600 hover:text-orange-600 focus:outline-none focus:text-orange-600 disabled:opacity-50 disabled:pointer-events-none active"
      >
        <i class="fa-solid fa-gear"></i>
        Notification Settings
      </Link>

      <Link
        href="#"
        as="button"
        class="hs-tab-active:border-orange-500 hs-tab-active:text-orange-600 py-1 pe-4 inline-flex items-center gap-x-2 border-s-2 px-5 border-transparent text-sm whitespace-nowrap font-semibold text-gray-600 hover:text-orange-600 focus:outline-none focus:text-orange-600 disabled:opacity-50 disabled:pointer-events-none"
      >
        <i class="fa-solid fa-boxes-packing"></i>
        My Orders
      </Link>

      <Link
        href="#"
        as="button"
        class="hs-tab-active:border-orange-500 hs-tab-active:text-orange-600 py-1 pe-4 inline-flex items-center gap-x-2 border-s-2 px-5 border-transparent text-sm whitespace-nowrap font-semibold text-gray-600 hover:text-orange-600 focus:outline-none focus:text-orange-600 disabled:opacity-50 disabled:pointer-events-none"
      >
        <i class="fa-solid fa-heart"></i>
        My Wishlists
      </Link>

      <Link
        href="#"
        as="button"
        class="hs-tab-active:border-orange-500 hs-tab-active:text-orange-600 py-1 pe-4 inline-flex items-center gap-x-2 border-s-2 px-5 border-transparent text-sm whitespace-nowrap font-semibold text-gray-600 hover:text-orange-600 focus:outline-none focus:text-orange-600 disabled:opacity-50 disabled:pointer-events-none"
      >
        <i class="fa-solid fa-address-book"></i>
        Address Book
      </Link>

      <Link
        href="#"
        as="button"
        class="hs-tab-active:border-orange-500 hs-tab-active:text-orange-600 py-1 pe-4 inline-flex items-center gap-x-2 border-s-2 px-5 border-transparent text-sm whitespace-nowrap font-semibold text-gray-600 hover:text-orange-600 focus:outline-none focus:text-orange-600 disabled:opacity-50 disabled:pointer-events-none"
      >
        <i class="fa-solid fa-store"></i>
        Followed Stores
      </Link>

      <Link
        href="#"
        as="button"
        class="hs-tab-active:border-orange-500 hs-tab-active:text-orange-600 py-1 pe-4 inline-flex items-center gap-x-2 border-s-2 px-5 border-transparent text-sm whitespace-nowrap font-semibold text-gray-600 hover:text-orange-600 focus:outline-none focus:text-orange-600 disabled:opacity-50 disabled:pointer-events-none"
      >
        <i class="fa-solid fa-star"></i>
        My Reviews
      </Link>

      <Link
        href="#"
        as="button"
        class="hs-tab-active:border-orange-500 hs-tab-active:text-orange-600 py-1 pe-4 inline-flex items-center gap-x-2 border-s-2 px-5 border-transparent text-sm whitespace-nowrap font-semibold text-gray-600 hover:text-orange-600 focus:outline-none focus:text-orange-600 disabled:opacity-50 disabled:pointer-events-none"
      >
        <i class="fa-solid fa-rotate-left"></i>
        My Returns & Cancellations
      </Link>

      <Link
        href="#"
        as="button"
        class="hs-tab-active:border-orange-500 hs-tab-active:text-orange-600 py-1 pe-4 inline-flex items-center gap-x-2 border-s-2 px-5 border-transparent text-sm whitespace-nowrap font-semibold text-gray-600 hover:text-orange-600 focus:outline-none focus:text-orange-600 disabled:opacity-50 disabled:pointer-events-none"
      >
        <i class="fa-solid fa-user-check"></i>
        Become A Seller
      </Link>

      <Link
        href="#"
        as="button"
        class="hs-tab-active:border-orange-500 hs-tab-active:text-orange-600 py-1 pe-4 inline-flex items-center gap-x-2 border-s-2 px-5 border-transparent text-sm whitespace-nowrap font-semibold text-gray-600 hover:text-orange-600 focus:outline-none focus:text-orange-600 disabled:opacity-50 disabled:pointer-events-none"
      >
        <i class="fa-solid fa-ticket"></i>
        Vouchers
      </Link>
    </nav>
  </div>
</template>
