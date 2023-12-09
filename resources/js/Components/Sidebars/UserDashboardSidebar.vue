<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <div class="w-[300px]">
    <h1 class="font-bold text-md text-orange-600 mb-5 px-5 pb-5 border-b">
      {{ __('Welcome') }}, {{ $page.props.auth?.user?.name }}
    </h1>
    <nav
      class="flex flex-col space-y-3"
      aria-label="Tabs"
      role="tablist"
      data-hs-tabs-vertical="true"
    >
      <Link
        :href="route('user.dashboard')"
        as="button"
        class="py-1 pe-4 inline-flex items-center gap-x-2 px-5 text-sm whitespace-nowrap font-semibold"
        :class="{
          'text-orange-600 hover:text-orange-500 border-s-[3px] border-orange-600':
            $page.url === '/user/dashboard',
          'text-slate-600 hover:text-slate-500 border-transparent': $page.url !== '/user/dashboard'
        }"
      >
        <i class="fa-solid fa-tv"></i>
        {{ __('Dashboard') }}
      </Link>

      <Link
        :href="route('user.my-account.edit')"
        as="button"
        class="py-1 pe-4 inline-flex items-center gap-x-2 px-5 text-sm whitespace-nowrap font-semibold"
        :class="{
          'text-orange-600 hover:text-orange-500 border-s-[3px] border-orange-600':
            $page.url === '/user/my-account',
          'text-slate-600 hover:text-slate-500 border-transparent': $page.url !== '/user/my-account'
        }"
      >
        <i class="fa-regular fa-id-card"></i>
        {{ __('My Account') }}
      </Link>

      <Link
        href="#"
        as="button"
        class="py-1 pe-4 inline-flex items-center gap-x-2 px-5 text-sm whitespace-nowrap font-semibold"
      >
        <i class="fa-solid fa-lock"></i>
        {{ __('Change Password') }}
      </Link>

      <Link
        href="#"
        as="button"
        class="py-1 pe-4 inline-flex items-center gap-x-2 px-5 text-sm whitespace-nowrap font-semibold"
      >
        <i class="fa-solid fa-ban"></i>
        {{ __('Delete Account') }}
      </Link>

      <Link
        href="#"
        as="button"
        class="py-1 pe-4 inline-flex items-center gap-x-2 px-5 text-sm whitespace-nowrap font-semibold"
      >
        <i class="fa-solid fa-gear"></i>
        {{ __('Notification Settings') }}
      </Link>

      <Link
        href="#"
        as="button"
        class="py-1 pe-4 inline-flex items-center gap-x-2 px-5 text-sm whitespace-nowrap font-semibold"
      >
        <i class="fa-solid fa-boxes-packing"></i>
        {{ __('My Orders') }}
      </Link>

      <Link
        href="#"
        as="button"
        class="py-1 pe-4 inline-flex items-center gap-x-2 px-5 text-sm whitespace-nowrap font-semibold"
      >
        <i class="fa-solid fa-heart"></i>
        {{ __('My Wishlists') }}
      </Link>

      <Link
        href="#"
        as="button"
        class="py-1 pe-4 inline-flex items-center gap-x-2 px-5 text-sm whitespace-nowrap font-semibold"
      >
        <i class="fa-solid fa-address-book"></i>
        {{ __('Address Book') }}
      </Link>

      <Link
        href="#"
        as="button"
        class="py-1 pe-4 inline-flex items-center gap-x-2 px-5 text-sm whitespace-nowrap font-semibold"
      >
        <i class="fa-solid fa-store"></i>
        {{ __('Followed Stores') }}
      </Link>

      <Link
        href="#"
        as="button"
        class="py-1 pe-4 inline-flex items-center gap-x-2 px-5 text-sm whitespace-nowrap font-semibold"
      >
        <i class="fa-solid fa-star"></i>
        {{ __('My Reviews') }}
      </Link>

      <Link
        href="#"
        as="button"
        class="py-1 pe-4 inline-flex items-center gap-x-2 px-5 text-sm whitespace-nowrap font-semibold"
      >
        <i class="fa-solid fa-rotate-left"></i>
        {{ __('My Returns & Cancellations') }}
      </Link>

      <Link
        href="#"
        as="button"
        class="py-1 pe-4 inline-flex items-center gap-x-2 px-5 text-sm whitespace-nowrap font-semibold"
      >
        <i class="fa-solid fa-user-check"></i>
        {{ __('Become a Seller') }}
      </Link>

      <Link
        href="#"
        as="button"
        class="py-1 pe-4 inline-flex items-center gap-x-2 px-5 text-sm whitespace-nowrap font-semibold"
      >
        <i class="fa-solid fa-ticket"></i>
        {{ __('Vouchers') }}
      </Link>
    </nav>
  </div>
</template>
