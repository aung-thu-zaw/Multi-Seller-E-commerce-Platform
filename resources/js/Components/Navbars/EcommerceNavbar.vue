<script setup>
import InertiaLinkButton from '@/Components/Buttons/InertiaLinkButton.vue'
import EcommerceCategoryDropdown from '@/Components/Dropdowns/EcommerceCategoryDropdown.vue'
import EcommerceMainSearchBox from '@/Components/Forms/SearchBoxs/EcommerceMainSearchBox.vue'
import TrackMyOrderForm from "@/Components/Forms/TrackMyOrderForm.vue"
import UserDropdown from '@/Components/Dropdowns/UserDropdown.vue'
import LanguageDropdown from '@/Components/Dropdowns/LanguageDropdown.vue'
import NotificationDropdownForUser from '@/Components/Dropdowns/Notifications/NotificationDropdownForUser.vue'
import { Link, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

const totalItems = computed(() => {
  if (usePage().props.auth.cart?.cart_items) {
    return usePage().props.auth.cart?.cart_items.reduce((acc, item) => acc + item.qty, 0)
  }
  return ''
})
</script>

<template>
  <!-- Navbar -->
  <nav class="sticky top-0 z-50">
    <div class="bg-orange-600 text-white px-6 py-3 flex items-center justify-between">
      <div>
        <h4 class="font-bold text-md">
          <Link :href="route('home')">{{ $page.props.generalSetting?.site_name }}</Link>
        </h4>
      </div>
      <ul class="font-bold text-sm flex items-centers space-x-4">
        <li>
          <Link :href="route('help-center')">
            <i class="fa-solid fa-circle-info mr-1"></i>
            {{ __('Help & Support') }}
          </Link>
        </li>

        <li>
          <span class="border"></span>
        </li>

        <li>
          <Link :href="route('become-a-seller.register')">
            <i class="fa-solid fa-store mr-1"></i>
            {{ __('Become a Seller') }}
          </Link>
        </li>

        <li>
          <span class="border"></span>
        </li>

        <li>
          <TrackMyOrderForm />
        </li>

        <li>
          <span class="border"></span>
        </li>

        <li>
          <LanguageDropdown />
        </li>
      </ul>
    </div>

    <!-- Middle Navbar -->
    <div class="bg-white">
      <div class="w-[1280px] mx-auto px-10 py-4 flex items-center justify-between">
        <!-- Brand -->
        <Link :href="route('home')" class="text-xl text-slate-600 font-bold w-auto max-w-[200px]">
          <!-- E-commerce Platform -->
          <img :src="$page.props.generalSetting?.header_logo" alt="header-logo" />
        </Link>
        <!-- Search -->
        <EcommerceMainSearchBox />

        <div v-if="$page.props.auth?.user" class="flex items-center space-x-8">
          <NotificationDropdownForUser />

          <UserDropdown />

          <Link
            as="button"
            :href="route('my-cart.index')"
            class="relative text-white px-4 py-2.5 bg-orange-600 rounded-[4px] duration-150 hover:bg-orange-700"
          >
            <span class="text-sm font-semibold">
              <i class="fa-solid fa-shopping-cart"></i>
              {{ __('My Cart') }}
            </span>
            <span
              v-show="totalItems"
              class="bg-red-500 text-[.7rem] absolute -top-2 -right-2 w-5 h-5 p-2 rounded-full flex items-center justify-center border border-white"
            >
              {{ totalItems }}
            </span>
          </Link>
        </div>

        <div v-else class="flex items-center space-x-3">
          <InertiaLinkButton to="register" class="bg-orange-600 text-white">
            <i class="fa-solid fa-user-plus"></i>
            {{ __('Sign Up') }}
          </InertiaLinkButton>
          <InertiaLinkButton
            to="login"
            class="bg-transparent text-orange-600 border border-orange-600"
          >
            <i class="fa-solid fa-right-to-bracket"></i>
            {{ __('Login') }}
          </InertiaLinkButton>
        </div>
      </div>
    </div>

    <!-- Category Navbar -->
    <div class="bg-gray-200 text-gray-800 px-6 py-3 flex items-center justify-between">
      <div class="w-[1280px] mx-auto px-4 text-sm">
        <ul class="flex items-center space-x-6">
          <!-- Shop by categories -->
          <EcommerceCategoryDropdown />

          <!-- Our seller stores -->
          <li>
            <Link
              :href="route('stores.index')"
              class="flex items-center text-gray-700 hover:text-gray-500 font-semibold"
            >
              <i class="fa-solid fa-shop mr-1 text-xs"></i>
              {{ __('Our Seller Stores') }}
            </Link>
          </li>

          <!-- Our Blogs -->
          <li>
            <Link
              :href="route('blogs.index')"
              :data="{
                view: 'grid',
                sort: 'id',
                direction: 'desc'
              }"
              class="flex items-center text-gray-700 hover:text-gray-500 font-semibold"
              :class="{
                'text-orange-600': $page.component.startsWith('E-commerce/OurBlogs')
              }"
            >
              <i class="fa-solid fa-newspaper mr-1 text-xs"></i>
              {{ __('Our Blogs') }}
            </Link>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>
