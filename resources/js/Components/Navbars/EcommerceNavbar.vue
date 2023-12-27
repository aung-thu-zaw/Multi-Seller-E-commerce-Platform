<script setup>
import InertiaLinkButton from '@/Components/Buttons/InertiaLinkButton.vue'
import NormalButton from '@/Components/Buttons/NormalButton.vue'
import EcommerceCategoryDropdown from '@/Components/Dropdowns/EcommerceCategoryDropdown.vue'
import EcommerceMainSearchBox from '@/Components/Forms/SearchBoxs/EcommerceMainSearchBox.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import English from '@/assets/images/united-state.png'
import Myanmar from '@/assets/images/myanmar.png'
import UserDropdown from '@/Components/Dropdowns/UserDropdown.vue'
import NotificationDropdownForUser from '@/Components/Dropdowns/Notifications/NotificationDropdownForUser.vue'
import { Link } from '@inertiajs/vue3'
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
          <div class="hs-dropdown relative inline-flex [--auto-close:inside]">
            <button
              id="hs-dropdown-hover-event"
              type="button"
              class="hs-dropdown-toggle flex items-center whitespace-nowrap text-sm font-bold leading-normal text-white"
            >
              <i class="fa-solid fa-location-crosshairs mr-1"></i>
              {{ __('Track My Order') }}
            </button>

            <div
              class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden bg-white shadow-md rounded-lg p-5 mt-2 z-30 w-[350px]"
              aria-labelledby="hs-dropdown-custom-icon-trigger"
            >
              <form action="#">
                <div class="mb-3">
                  <InputLabel :label="__('Enter your order number')" required />

                  <InputField
                    type="text"
                    name="order-no"
                    placeholder="# E-commerce454232"
                    autofocus
                    required
                  />
                </div>

                <div class="flex items-center justify-end">
                  <NormalButton class="bg-orange-600">
                    <i class="fa-solid fa-location-crosshairs mr-1"></i>
                    {{ __('Track') }}
                  </NormalButton>
                </div>
              </form>
            </div>
          </div>
        </li>

        <li>
          <span class="border"></span>
        </li>

        <li>
          <div class="hs-dropdown relative inline-flex">
            <button
              id="hs-dropdown-custom-icon-trigger"
              type="button"
              class="hs-dropdown-toggle flex items-center whitespace-nowrap text-sm font-bold leading-normal text-white"
            >
              <i class="fa-solid fa-globe mr-1"></i>
              {{ __('Language') }}

              <svg
                class="hs-dropdown-open:rotate-180 w-4 h-4"
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              >
                <path d="m6 9 6 6 6-6" />
              </svg>
            </button>

            <div
              class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden bg-white shadow-md rounded-lg p-2 mt-2"
              aria-labelledby="hs-dropdown-custom-icon-trigger"
            >
              <div>
                <div
                  class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                >
                  <div class="flex items-center justify-between">
                    <div class="flex items-center">
                      <img :src="English" alt="English" class="w-5 mr-2" />

                      English
                      <i class="fa-solid fa-circle-check ml-2"></i>
                    </div>
                  </div>
                </div>
                <div
                  class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                >
                  <div class="flex items-center justify-between">
                    <div class="flex items-center">
                      <img :src="Myanmar" alt="Myanmar" class="w-5 mr-2" />

                      Myanmar
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
              class="bg-red-500 text-[.7rem] absolute -top-2 -right-2 w-5 h-5 p-2 rounded-full flex items-center justify-center border border-white"
            >
              5
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
