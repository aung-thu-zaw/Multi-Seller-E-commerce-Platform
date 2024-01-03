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
      <!-- Dashboard -->
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

      <!-- My Account -->
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

      <!-- Address Book -->
      <Link
        :href="route('user.address-book.index')"
        as="button"
        class="py-1 pe-4 inline-flex items-center gap-x-2 px-5 text-sm whitespace-nowrap font-semibold"
        :class="{
          'text-orange-600 hover:text-orange-500 border-s-[3px] border-orange-600':
            $page.url === '/user/address-book',
          'text-slate-600 hover:text-slate-500 border-transparent':
            $page.url !== '/user/address-book'
        }"
      >
        <i class="fa-solid fa-address-book"></i>
        {{ __('Address Book') }}
      </Link>

      <!-- Vouchers -->
      <Link
        href="#"
        as="button"
        class="py-1 pe-4 inline-flex items-center gap-x-2 px-5 text-sm whitespace-nowrap font-semibold"
        :class="{
          'text-orange-600 hover:text-orange-500 border-s-[3px] border-orange-600':
            $page.url === '/user/vouchers',
          'text-slate-600 hover:text-slate-500 border-transparent': $page.url !== '/user/vouchers'
        }"
      >
        <i class="fa-solid fa-ticket"></i>
        {{ __('My Vouchers') }}
      </Link>

      <!-- My Orders -->
      <Link
        :href="route('user.my-orders.index')"
        :data="{
          tab: 'all'
        }"
        as="button"
        class="py-1 pe-4 inline-flex items-center gap-x-2 px-5 text-sm whitespace-nowrap font-semibold"
        :class="{
          'text-orange-600 hover:text-orange-500 border-s-[3px] border-orange-600':
            $page.url.startsWith('/user/my-orders'),
          'text-slate-600 hover:text-slate-500 border-transparent':
            !$page.url.startsWith('/user/my-orders')
        }"
      >
        <i class="fa-solid fa-boxes-packing"></i>
        {{ __('My Orders') }}
      </Link>

      <!-- My Returns & Cancellations -->
      <Link
        href="#"
        as="button"
        class="py-1 pe-4 inline-flex items-center gap-x-2 px-5 text-sm whitespace-nowrap font-semibold"
        :class="{
          'text-orange-600 hover:text-orange-500 border-s-[3px] border-orange-600':
            $page.url === '/user/my-returns-and-cancellations',
          'text-slate-600 hover:text-slate-500 border-transparent':
            $page.url !== '/user/my-returns-and-cancellations'
        }"
      >
        <i class="fa-solid fa-rotate-left"></i>
        {{ __('My Returns & Cancellations') }}
      </Link>

      <!-- My Wishlists -->
      <Link
        :href="route('user.my-wishlists.index')"
        as="button"
        class="py-1 pe-4 inline-flex items-center gap-x-2 px-5 text-sm whitespace-nowrap font-semibold"
        :class="{
          'text-orange-600 hover:text-orange-500 border-s-[3px] border-orange-600':
            $page.url === '/user/my-wishlists',
          'text-slate-600 hover:text-slate-500 border-transparent':
            $page.url !== '/user/my-wishlists'
        }"
      >
        <i class="fa-solid fa-heart"></i>
        {{ __('My Wishlists') }}
      </Link>

      <!-- My Reviews -->
      <Link
        as="button"
        :href="route('user.my-reviews.index')"
        :data="{
          tab: 'to-review'
        }"
        class="py-1 pe-4 inline-flex items-center gap-x-2 px-5 text-sm whitespace-nowrap font-semibold"
        :class="{
          'text-orange-600 hover:text-orange-500 border-s-[3px] border-orange-600':
            $page.url.startsWith('/user/my-reviews'),
          'text-slate-600 hover:text-slate-500 border-transparent':
            !$page.url.startsWith('/user/my-reviews')
        }"
      >
        <i class="fa-solid fa-star"></i>
        {{ __('My Reviews') }}
      </Link>

      <!-- Followed Stores -->
      <Link
        :href="route('user.followed-stores')"
        as="button"
        class="py-1 pe-4 inline-flex items-center gap-x-2 px-5 text-sm whitespace-nowrap font-semibold"
        :class="{
          'text-orange-600 hover:text-orange-500 border-s-[3px] border-orange-600':
            $page.url === '/user/followed-stores',
          'text-slate-600 hover:text-slate-500 border-transparent':
            $page.url !== '/user/followed-stores'
        }"
      >
        <i class="fa-solid fa-store"></i>
        {{ __('Followed Stores') }}
      </Link>

      <!-- Notification Settings -->
      <Link
        href="#"
        as="button"
        class="py-1 pe-4 inline-flex items-center gap-x-2 px-5 text-sm whitespace-nowrap font-semibold"
        :class="{
          'text-orange-600 hover:text-orange-500 border-s-[3px] border-orange-600':
            $page.url === '/user/notification-settings',
          'text-slate-600 hover:text-slate-500 border-transparent':
            $page.url !== '/user/notification-settings'
        }"
      >
        <i class="fa-solid fa-gear"></i>
        {{ __('Notification Settings') }}
      </Link>

      <!-- Change Password -->
      <Link
        :href="route('user.change-password')"
        as="button"
        class="py-1 pe-4 inline-flex items-center gap-x-2 px-5 text-sm whitespace-nowrap font-semibold"
        :class="{
          'text-orange-600 hover:text-orange-500 border-s-[3px] border-orange-600':
            $page.url === '/user/change-password',
          'text-slate-600 hover:text-slate-500 border-transparent':
            $page.url !== '/user/change-password'
        }"
      >
        <i class="fa-solid fa-lock"></i>
        {{ __('Change Password') }}
      </Link>

      <!-- Delete Account -->
      <Link
        :href="route('user.delete-account')"
        as="button"
        class="py-1 pe-4 inline-flex items-center gap-x-2 px-5 text-sm whitespace-nowrap font-semibold"
        :class="{
          'text-orange-600 hover:text-orange-500 border-s-[3px] border-orange-600':
            $page.url === '/user/delete-account',
          'text-slate-600 hover:text-slate-500 border-transparent':
            $page.url !== '/user/delete-account'
        }"
      >
        <i class="fa-solid fa-ban"></i>
        {{ __('Delete Account') }}
      </Link>
    </nav>
  </div>
</template>
