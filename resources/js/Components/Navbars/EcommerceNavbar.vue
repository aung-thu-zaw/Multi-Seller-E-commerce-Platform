<script setup>
import InertiaLinkButton from '@/Components/Buttons/InertiaLinkButton.vue'
import NormalButton from '@/Components/Buttons/NormalButton.vue'
import EcommerceCategoryDropdown from '@/Components/Dropdowns/EcommerceCategoryDropdown.vue'
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
          <Link :href="route('home')">E-commerce Platform</Link>
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

        <li v-show="!$page.props.auth.store">
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
        <Link :href="route('home')" class="text-xl text-slate-600 font-bold w-auto max-w-[350px]">
          E-commerce Platform
        </Link>
        <!-- Search -->
        <div class="relative">
          <div class="min-w-[600px]">
            <form class="flex items-center">
              <div class="relative w-full mr-2">
                <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none">
                  <svg
                    class="w-4 h-4 text-gray-500"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 20 20"
                  >
                    <path
                      stroke="currentColor"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                    />
                  </svg>
                </div>

                <input
                  type="text"
                  id="default-search"
                  class="block w-full p-4 pl-10 text-xs text-gray-900 border border-gray-300 rounded-md bg-gray-50 font-semibold focus:ring-2 focus:ring-orange-300 focus:border-orange-400 transition-all"
                  :placeholder="__('What are you looking for ?')"
                />
              </div>

              <button
                type="submit"
                class="bg-orange-600 p-4 rounded-md focus:ring-2 focus:ring-orange-300"
              >
                <svg
                  class="w-4 h-4 text-white font-bold"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 20 20"
                >
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                  />
                </svg>
              </button>
            </form>
          </div>

          <!-- Search History -->
          <!-- <div
            class="border border-slate-300 shadow-lg absolute bg-white mt-3 rounded-md text-gray-600 py-3 h-auto w-full max-h-[500px] overflow-auto"
          >
            <ul class="text-xs font-medium">
              <li class="px-5 py-3">
                <h3 class="font-bold text-slate-600">
                  <i class="fa-solid fa-clock mr-3"></i>
                  Your Search History
                </h3>
              </li>
              <li
                class="hover:bg-orange-100 px-5 py-3 flex items-center justify-between"
              >
                <span>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                  Dolor, nihil?
                </span>
                <span
                  class="w-5 h-5 rounded-full flex items-center justify-center text-sm hover:text-orange-500 hover:bg-orange-200 transition-all cursor-pointer"
                >
                  <i class="fa-solid fa-xmark"></i>
                </span>
              </li>
              <li
                class="hover:bg-orange-100 px-5 py-3 flex items-center justify-between"
              >
                <span>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                  Dolor, nihil?
                </span>
                <span
                  class="w-5 h-5 rounded-full flex items-center justify-center text-sm hover:text-orange-500 hover:bg-orange-200 transition-all cursor-pointer"
                >
                  <i class="fa-solid fa-xmark"></i>
                </span>
              </li>
              <li
                class="hover:bg-orange-100 px-5 py-3 flex items-center justify-between"
              >
                <span>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                  Dolor, nihil?
                </span>
                <span
                  class="w-5 h-5 rounded-full flex items-center justify-center text-sm hover:text-orange-500 hover:bg-orange-200 transition-all cursor-pointer"
                >
                  <i class="fa-solid fa-xmark"></i>
                </span>
              </li>

              <li class="px-5 py-3">
                <hr />
              </li>
              <li class="px-5 py-3">
                <h3 class="font-bold text-main-orange">
                  <i class="fa-solid fa-lightbulb mr-3"></i>
                  Suggest Search
                </h3>
              </li>

              <li class="hover:bg-orange-50 px-5 py-3">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor,
                nihil?
              </li>
              <li class="hover:bg-orange-50 px-5 py-3">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor,
                nihil?
              </li>
              <li class="hover:bg-orange-50 px-5 py-3">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor,
                nihil?
              </li>
              <li class="hover:bg-orange-50 px-5 py-3">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor,
                nihil?
              </li>
              <li class="hover:bg-orange-50 px-5 py-3">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor,
                nihil?
              </li>
              <li class="hover:bg-orange-50 px-5 py-3">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor,
                nihil?
              </li>
            </ul>
          </div> -->
        </div>

        <div v-if="$page.props.auth?.user" class="flex items-center space-x-8">
          <NotificationDropdownForUser />

          <UserDropdown />
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
