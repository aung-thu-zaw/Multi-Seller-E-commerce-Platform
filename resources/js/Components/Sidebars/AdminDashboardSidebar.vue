<script setup>
import UserDropdown from '@/Components/Dropdowns/UserDropdown.vue'
import { Link } from '@inertiajs/vue3'
import { ref } from 'vue'
import logo from '@/assets/images/website-logo-color.png'

const collapseShow = ref('hidden')

const toggleCollapseShow = (classes) => {
  collapseShow.value = classes
}
</script>

<template>
  <nav
    class="md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden shadow-xl bg-white flex flex-wrap items-center justify-between relative md:w-64 z-10 py-4 px-6"
  >
    <div
      class="md:flex-col md:items-stretch md:min-h-full md:flex-nowrap px-0 flex flex-wrap items-center md:justify-between w-full mx-auto"
    >
      <!-- Toggler -->
      <button
        class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
        type="button"
        v-on:click="toggleCollapseShow('bg-white m-2 py-3 px-6')"
      >
        <i class="fas fa-bars"></i>
      </button>
      <!-- Brand -->
      <Link
        :href="route('home')"
        class="md:block text-left text-blueGray-600 mr-0 inline-block whitespace-nowrap text-sm font-bold px-0"
      >
        <img :src="logo" alt="logo" class="w-auto h-4 md:h-12 object-contain" />
      </Link>
      <!-- User -->
      <ul class="md:hidden items-center flex flex-wrap list-none ml-auto">
        <li class="inline-block relative">
          <!-- <DashboardNotificationDropdown /> -->
        </li>
        <li class="inline-block relative">
          <UserDropdown />
        </li>
      </ul>
      <!-- Collapse -->
      <div
        class="hs-accordion-group md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded border border-accent-light md:border-none"
        v-bind:class="collapseShow"
      >
        <!-- Collapse header -->
        <div
          class="md:min-w-full md:hidden block pb-4 mb-4 border-b border-solid border-blueGray-200"
        >
          <div class="flex flex-wrap">
            <div class="w-6/12">
              <Link
                :href="route('home')"
                class="md:block text-left md:pb-2 text-blueGray-600 mr-0 inline-block whitespace-nowrap text-sm font-bold p-4 px-0"
              >
                <img :src="logo" alt="logo" class="w-auto h-12 object-contain" />
              </Link>
            </div>
            <div class="w-6/12 flex justify-end">
              <button
                type="button"
                class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                v-on:click="toggleCollapseShow('hidden')"
              >
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
        </div>
        <!-- Form -->
        <form class="mt-6 mb-4 md:hidden">
          <div class="mb-3 pt-0">
            <input
              type="text"
              placeholder="Search"
              class="px-3 py-2 h-12 border border-solid border-blueGray-500 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-base leading-snug shadow-none outline-none focus:outline-none w-full font-normal"
            />
          </div>
        </form>

        <!-- Divider -->
        <hr class="my-4 md:min-w-full" />
        <!-- Heading -->
        <h6 class="md:min-w-full text-blueGray-500 text-xs font-bold block pt-1 pb-4 no-underline">
          {{ __('E-commerce Administration') }}
        </h6>
        <!-- Navigation -->

        <ul class="md:flex-col md:min-w-full flex flex-col list-none">
          <!-- Dashboard -->
          <li class="items-center">
            <Link :href="route('admin.dashboard')">
              <div
                class="text-xs py-3 font-bold block"
                :class="{
                  'text-blue-600 hover:text-blue-500': $page.url === '/admin/dashboard',
                  'text-slate-600 hover:text-slate-500': $page.url !== '/admin/dashboard'
                }"
              >
                <i class="fas fa-tv mr-2"></i>
                {{ __('Dashboard') }}
              </div>
            </Link>
          </li>

          <!-- Categories -->
          <li v-show="can('categories.view')" class="items-center">
            <Link
              :href="route('admin.categories.index')"
              :data="{
                page: 1,
                per_page: 5,
                sort: 'id',
                direction: 'desc'
              }"
              class="text-xs py-3 font-bold block"
              :class="{
                'text-orange-600 hover:text-orange-500': $page.url.startsWith('/admin/categories'),
                'text-slate-600 hover:text-slate-500': !$page.url.startsWith('/admin/categories')
              }"
            >
              <i class="fa-solid fa-list mr-2"></i>
              {{ __('Categories') }}
            </Link>
          </li>

          <!-- Brands -->
          <li v-show="can('brands.view')" class="items-center">
            <Link
              :href="route('admin.brands.index')"
              :data="{
                page: 1,
                per_page: 5,
                sort: 'id',
                direction: 'desc'
              }"
              class="text-xs py-3 font-bold block"
              :class="{
                'text-orange-600 hover:text-orange-500': $page.url.startsWith('/admin/brands'),
                'text-slate-600 hover:text-slate-500': !$page.url.startsWith('/admin/brands')
              }"
            >
              <i class="fa-solid fa-award mr-2"></i>
              {{ __('Brands') }}
            </Link>
          </li>

          <!-- Products -->
          <li v-show="can('brands.view')" class="items-center">
            <Link
              :href="route('admin.brands.index')"
              :data="{
                page: 1,
                per_page: 5,
                sort: 'id',
                direction: 'desc'
              }"
              class="text-xs py-3 font-bold block"
              :class="{
                'text-orange-600 hover:text-orange-500': $page.url.startsWith('/admin/brands'),
                'text-slate-600 hover:text-slate-500': !$page.url.startsWith('/admin/brands')
              }"
            >
              <i class="fa-solid fa-basket-shopping mr-2"></i>
              {{ __('Products') }}
            </Link>
          </li>

          <!-- Collections -->
          <li v-show="can('brands.view')" class="items-center">
            <Link
              :href="route('admin.brands.index')"
              :data="{
                page: 1,
                per_page: 5,
                sort: 'id',
                direction: 'desc'
              }"
              class="text-xs py-3 font-bold block"
              :class="{
                'text-orange-600 hover:text-orange-500': $page.url.startsWith('/admin/brands'),
                'text-slate-600 hover:text-slate-500': !$page.url.startsWith('/admin/brands')
              }"
            >
              <i class="fa-solid fa-box mr-2"></i>
              {{ __('Collections') }}
            </Link>
          </li>

          <!-- Flash Sales -->
          <li v-show="can('brands.view')" class="items-center">
            <Link
              :href="route('admin.brands.index')"
              :data="{
                page: 1,
                per_page: 5,
                sort: 'id',
                direction: 'desc'
              }"
              class="text-xs py-3 font-bold block"
              :class="{
                'text-orange-600 hover:text-orange-500': $page.url.startsWith('/admin/brands'),
                'text-slate-600 hover:text-slate-500': !$page.url.startsWith('/admin/brands')
              }"
            >
              <i class="fa-solid fa-bolt-lightning mr-2"></i>
              {{ __('Flash Sales') }}
            </Link>
          </li>

          <!-- Banners -->
          <li
            class="hs-accordion items-center"
            :class="{
              active:
                $page.url.startsWith('/admin/slider-banners') ||
                $page.url.startsWith('/admin/campaign-banners') ||
                $page.url.startsWith('/admin/product-banners')
            }"
            id="banner-accordion"
          >
            <button
              type="button"
              class="hs-accordion-toggle text-slate-600 hover:text-slate-500 text-xs py-3 font-bold flex items-center justify-between w-full"
            >
              <span>
                <i class="fa-solid fa-ad mr-1.5"></i>
                {{ __('Banners') }}
              </span>
              <span>
                <svg
                  class="hs-accordion-active:block ms-auto hidden w-4 h-4 text-gray-600 group-hover:text-gray-500"
                  xmlns="http://www.w3.org/2000/svg"
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path d="m18 15-6-6-6 6" />
                </svg>

                <svg
                  class="hs-accordion-active:hidden ms-auto block w-4 h-4 text-gray-600 group-hover:text-gray-500"
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M2 5L8.16086 10.6869C8.35239 10.8637 8.64761 10.8637 8.83914 10.6869L15 5"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                  ></path>
                </svg>
              </span>
            </button>

            <div
              id="banner-accordion"
              class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden"
              :class="{
                block:
                  $page.url.startsWith('/admin/slider-banners') ||
                  $page.url.startsWith('/admin/campaign-banners') ||
                  $page.url.startsWith('/admin/product-banners')
              }"
            >
              <ul class="pl-8">
                <li v-show="can('categories.view')" class="items-center">
                  <Link
                    :href="route('admin.categories.index')"
                    :data="{
                      page: 1,
                      per_page: 5,
                      sort: 'id',
                      direction: 'desc'
                    }"
                    class="text-xs py-3 font-bold block"
                    :class="{
                      'text-orange-600 hover:text-orange-500':
                        $page.url.startsWith('/admin/categories'),
                      'text-slate-600 hover:text-slate-500':
                        !$page.url.startsWith('/admin/categories')
                    }"
                  >
                    {{ __('Slider Banners') }}
                  </Link>
                </li>
                <li v-show="can('categories.view')" class="items-center">
                  <Link
                    :href="route('admin.categories.index')"
                    :data="{
                      page: 1,
                      per_page: 5,
                      sort: 'id',
                      direction: 'desc'
                    }"
                    class="text-xs py-3 font-bold block"
                    :class="{
                      'text-orange-600 hover:text-orange-500':
                        $page.url.startsWith('/admin/categories'),
                      'text-slate-600 hover:text-slate-500':
                        !$page.url.startsWith('/admin/categories')
                    }"
                  >
                    {{ __('Campaign Banners') }}
                  </Link>
                </li>

                <li v-show="can('categories.view')" class="items-center">
                  <Link
                    :href="route('admin.categories.index')"
                    :data="{
                      page: 1,
                      per_page: 5,
                      sort: 'id',
                      direction: 'desc'
                    }"
                    class="text-xs py-3 font-bold block"
                    :class="{
                      'text-orange-600 hover:text-orange-500':
                        $page.url.startsWith('/admin/categories'),
                      'text-slate-600 hover:text-slate-500':
                        !$page.url.startsWith('/admin/categories')
                    }"
                  >
                    {{ __('Product Banners') }}
                  </Link>
                </li>
              </ul>
            </div>
          </li>

          <!-- Coupons -->
          <li v-show="can('brands.view')" class="items-center">
            <Link
              :href="route('admin.brands.index')"
              :data="{
                page: 1,
                per_page: 5,
                sort: 'id',
                direction: 'desc'
              }"
              class="text-xs py-3 font-bold block"
              :class="{
                'text-orange-600 hover:text-orange-500': $page.url.startsWith('/admin/brands'),
                'text-slate-600 hover:text-slate-500': !$page.url.startsWith('/admin/brands')
              }"
            >
              <i class="fa-solid fa-ticket mr-2"></i>
              {{ __('Coupons') }}
            </Link>
          </li>
        </ul>

        <!-- Divider -->
        <hr class="my-4 md:min-w-full" />
        <!-- Heading -->
        <h6 class="md:min-w-full text-blueGray-500 text-xs font-bold block pt-1 pb-4 no-underline">
          {{ __('Shipping & Order Management') }}
        </h6>
        <!-- Navigation -->

        <ul class="md:flex-col md:min-w-full flex flex-col list-none">
          <!-- Order Managements -->
          <li class="hs-accordion items-center" id="order-management-accordion">
            <button
              type="button"
              class="hs-accordion-toggle text-slate-600 hover:text-slate-500 text-xs py-3 font-bold flex items-center justify-between w-full"
            >
              <span>
                <i class="fa-solid fa-boxes-packing mr-1.5"></i>
                {{ __('Order Management') }}
              </span>
              <span>
                <svg
                  class="hs-accordion-active:block ms-auto hidden w-4 h-4 text-gray-600 group-hover:text-gray-500"
                  xmlns="http://www.w3.org/2000/svg"
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path d="m18 15-6-6-6 6" />
                </svg>

                <svg
                  class="hs-accordion-active:hidden ms-auto block w-4 h-4 text-gray-600 group-hover:text-gray-500"
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M2 5L8.16086 10.6869C8.35239 10.8637 8.64761 10.8637 8.83914 10.6869L15 5"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                  ></path>
                </svg>
              </span>
            </button>

            <div
              id="order-management-accordion"
              class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden"
            >
              <ul class="pl-8">
                <li v-show="can('categories.view')" class="items-center">
                  <Link
                    :href="route('admin.categories.index')"
                    :data="{
                      page: 1,
                      per_page: 5,
                      sort: 'id',
                      direction: 'desc'
                    }"
                    class="text-xs py-3 font-bold block"
                    :class="{
                      'text-orange-600 hover:text-orange-500':
                        $page.url.startsWith('/admin/categories'),
                      'text-slate-600 hover:text-slate-500':
                        !$page.url.startsWith('/admin/categories')
                    }"
                  >
                    {{ __('All Orders') }}
                  </Link>
                </li>
                <li v-show="can('categories.view')" class="items-center">
                  <Link
                    :href="route('admin.categories.index')"
                    :data="{
                      page: 1,
                      per_page: 5,
                      sort: 'id',
                      direction: 'desc'
                    }"
                    class="text-xs py-3 font-bold block"
                    :class="{
                      'text-orange-600 hover:text-orange-500':
                        $page.url.startsWith('/admin/categories'),
                      'text-slate-600 hover:text-slate-500':
                        !$page.url.startsWith('/admin/categories')
                    }"
                  >
                    {{ __('Return Orders') }}
                  </Link>
                </li>

                <li v-show="can('categories.view')" class="items-center">
                  <Link
                    :href="route('admin.categories.index')"
                    :data="{
                      page: 1,
                      per_page: 5,
                      sort: 'id',
                      direction: 'desc'
                    }"
                    class="text-xs py-3 font-bold block"
                    :class="{
                      'text-orange-600 hover:text-orange-500':
                        $page.url.startsWith('/admin/categories'),
                      'text-slate-600 hover:text-slate-500':
                        !$page.url.startsWith('/admin/categories')
                    }"
                  >
                    {{ __('Cancel Orders') }}
                  </Link>
                </li>
              </ul>
            </div>
          </li>

          <!-- Geographic Hierarchy -->
          <li class="hs-accordion items-center" id="geographic-hierarchy-accordion">
            <button
              type="button"
              class="hs-accordion-toggle text-slate-600 hover:text-slate-500 text-xs py-3 font-bold flex items-center justify-between w-full"
            >
              <span>
                <i class="fa-solid fa-book-atlas mr-1.5"></i>
                {{ __('Geographic Hierarchy') }}
              </span>
              <span>
                <svg
                  class="hs-accordion-active:block ms-auto hidden w-4 h-4 text-gray-600 group-hover:text-gray-500"
                  xmlns="http://www.w3.org/2000/svg"
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path d="m18 15-6-6-6 6" />
                </svg>

                <svg
                  class="hs-accordion-active:hidden ms-auto block w-4 h-4 text-gray-600 group-hover:text-gray-500"
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M2 5L8.16086 10.6869C8.35239 10.8637 8.64761 10.8637 8.83914 10.6869L15 5"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                  ></path>
                </svg>
              </span>
            </button>

            <div
              id="geographic-hierarchy-accordion"
              class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden"
            >
              <ul class="pl-8">
                <li v-show="can('categories.view')" class="items-center">
                  <Link
                    :href="route('admin.categories.index')"
                    :data="{
                      page: 1,
                      per_page: 5,
                      sort: 'id',
                      direction: 'desc'
                    }"
                    class="text-xs py-3 font-bold block"
                    :class="{
                      'text-orange-600 hover:text-orange-500':
                        $page.url.startsWith('/admin/categories'),
                      'text-slate-600 hover:text-slate-500':
                        !$page.url.startsWith('/admin/categories')
                    }"
                  >
                    {{ __('Countries') }}
                  </Link>
                </li>
                <li v-show="can('categories.view')" class="items-center">
                  <Link
                    :href="route('admin.categories.index')"
                    :data="{
                      page: 1,
                      per_page: 5,
                      sort: 'id',
                      direction: 'desc'
                    }"
                    class="text-xs py-3 font-bold block"
                    :class="{
                      'text-orange-600 hover:text-orange-500':
                        $page.url.startsWith('/admin/categories'),
                      'text-slate-600 hover:text-slate-500':
                        !$page.url.startsWith('/admin/categories')
                    }"
                  >
                    {{ __('Regions') }}
                  </Link>
                </li>

                <li v-show="can('categories.view')" class="items-center">
                  <Link
                    :href="route('admin.categories.index')"
                    :data="{
                      page: 1,
                      per_page: 5,
                      sort: 'id',
                      direction: 'desc'
                    }"
                    class="text-xs py-3 font-bold block"
                    :class="{
                      'text-orange-600 hover:text-orange-500':
                        $page.url.startsWith('/admin/categories'),
                      'text-slate-600 hover:text-slate-500':
                        !$page.url.startsWith('/admin/categories')
                    }"
                  >
                    {{ __('Cities') }}
                  </Link>
                </li>
              </ul>
            </div>
          </li>

          <!-- Shipping Areas -->
          <li v-show="can('brands.view')" class="items-center">
            <Link
              :href="route('admin.brands.index')"
              :data="{
                page: 1,
                per_page: 5,
                sort: 'id',
                direction: 'desc'
              }"
              class="text-xs py-3 font-bold block"
              :class="{
                'text-orange-600 hover:text-orange-500': $page.url.startsWith('/admin/brands'),
                'text-slate-600 hover:text-slate-500': !$page.url.startsWith('/admin/brands')
              }"
            >
              <i class="fa-solid fa-map-location-dot mr-2"></i>
              {{ __('Shipping Areas') }}
            </Link>
          </li>

          <!-- Shipping Methods -->
          <li v-show="can('brands.view')" class="items-center">
            <Link
              :href="route('admin.brands.index')"
              :data="{
                page: 1,
                per_page: 5,
                sort: 'id',
                direction: 'desc'
              }"
              class="text-xs py-3 font-bold block"
              :class="{
                'text-orange-600 hover:text-orange-500': $page.url.startsWith('/admin/brands'),
                'text-slate-600 hover:text-slate-500': !$page.url.startsWith('/admin/brands')
              }"
            >
              <i class="fa-solid fa-truck mr-2"></i>
              {{ __('Shipping Methods') }}
            </Link>
          </li>

          <!-- Shipping Rates -->
          <li v-show="can('brands.view')" class="items-center">
            <Link
              :href="route('admin.brands.index')"
              :data="{
                page: 1,
                per_page: 5,
                sort: 'id',
                direction: 'desc'
              }"
              class="text-xs py-3 font-bold block"
              :class="{
                'text-orange-600 hover:text-orange-500': $page.url.startsWith('/admin/brands'),
                'text-slate-600 hover:text-slate-500': !$page.url.startsWith('/admin/brands')
              }"
            >
              <i class="fa-solid fa-sack-dollar mr-2"></i>
              {{ __('Shipping Rates') }}
            </Link>
          </li>
        </ul>

        <!-- Divider -->
        <hr class="my-4 md:min-w-full" />
        <!-- Heading -->
        <h6 class="md:min-w-full text-blueGray-500 text-xs font-bold block pt-1 pb-4 no-underline">
          {{ __('Analytics and Reporting') }}
        </h6>
        <!-- Navigation -->

        <ul class="md:flex-col md:min-w-full flex flex-col list-none">
          <!-- Blog Managements -->
          <li
            v-show="
              can('blog-categories.view') || can('blog-contents.view') || can('blog-comments.view')
            "
            class="hs-accordion items-center"
            id="blog-management-accordion"
          >
            <button
              type="button"
              class="hs-accordion-toggle text-slate-600 hover:text-slate-500 text-xs py-3 font-bold flex items-center justify-between w-full"
            >
              <span>
                <i class="fa-solid fa-file-pen mr-1.5"></i>
                {{ __('Blog Management') }}
              </span>
              <span>
                <svg
                  class="hs-accordion-active:block ms-auto hidden w-4 h-4 text-gray-600 group-hover:text-gray-500"
                  xmlns="http://www.w3.org/2000/svg"
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path d="m18 15-6-6-6 6" />
                </svg>

                <svg
                  class="hs-accordion-active:hidden ms-auto block w-4 h-4 text-gray-600 group-hover:text-gray-500"
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M2 5L8.16086 10.6869C8.35239 10.8637 8.64761 10.8637 8.83914 10.6869L15 5"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                  ></path>
                </svg>
              </span>
            </button>

            <div
              id="blog-management-accordion"
              class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300"
              :class="{
                block:
                  $page.url.startsWith('/admin/blog-categories') ||
                  $page.url.startsWith('/admin/blog-contents') ||
                  $page.url.startsWith('/admin/blog-comments'),
                hidden: !(
                  $page.url.startsWith('/admin/blog-categories') ||
                  $page.url.startsWith('/admin/blog-contents') ||
                  $page.url.startsWith('/admin/blog-comments')
                )
              }"
            >
              <ul class="pl-8">
                <li v-show="can('blog-categories.view')" class="items-center">
                  <Link
                    :href="route('admin.blog-categories.index')"
                    :data="{
                      page: 1,
                      per_page: 5,
                      sort: 'id',
                      direction: 'desc'
                    }"
                    class="text-xs py-3 font-bold block"
                    :class="{
                      'text-orange-600 hover:text-orange-500':
                        $page.url.startsWith('/admin/blog-categories'),
                      'text-slate-600 hover:text-slate-500':
                        !$page.url.startsWith('/admin/blog-categories')
                    }"
                  >
                    {{ __('Blog Categories') }}
                  </Link>
                </li>
                <li v-show="can('blog-contents.view')" class="items-center">
                  <Link
                    :href="route('admin.blog-contents.index')"
                    :data="{
                      page: 1,
                      per_page: 5,
                      sort: 'id',
                      direction: 'desc'
                    }"
                    class="text-xs py-3 font-bold block"
                    :class="{
                      'text-orange-600 hover:text-orange-500':
                        $page.url.startsWith('/admin/blog-contents'),
                      'text-slate-600 hover:text-slate-500':
                        !$page.url.startsWith('/admin/blog-contents')
                    }"
                  >
                    {{ __('Blog Contents') }}
                  </Link>
                </li>

                <li v-show="can('blog-comments.view')" class="items-center">
                  <Link
                    :href="route('admin.blog-comments.index')"
                    :data="{
                      page: 1,
                      per_page: 5,
                      sort: 'id',
                      direction: 'desc'
                    }"
                    class="text-xs py-3 font-bold block"
                    :class="{
                      'text-orange-600 hover:text-orange-500':
                        $page.url.startsWith('/admin/blog-comments'),
                      'text-slate-600 hover:text-slate-500':
                        !$page.url.startsWith('/admin/blog-comments')
                    }"
                  >
                    {{ __('Blog Comments') }}
                  </Link>
                </li>
              </ul>
            </div>
          </li>
        </ul>

        <!-- Divider -->
        <hr class="my-4 md:min-w-full" />
        <!-- Heading -->
        <h6 class="md:min-w-full text-blueGray-500 text-xs font-bold block pt-1 pb-4 no-underline">
          {{ __('Management & Oversight') }}
        </h6>
        <!-- Navigation -->

        <ul class="md:flex-col md:min-w-full flex flex-col list-none">
          <!-- Blog Managements -->
          <li
            v-show="
              can('blog-categories.view') || can('blog-contents.view') || can('blog-comments.view')
            "
            class="hs-accordion items-center"
            id="blog-management-accordion"
          >
            <button
              type="button"
              class="hs-accordion-toggle text-slate-600 hover:text-slate-500 text-xs py-3 font-bold flex items-center justify-between w-full"
            >
              <span>
                <i class="fa-solid fa-file-pen mr-1.5"></i>
                {{ __('Blog Management') }}
              </span>
              <span>
                <svg
                  class="hs-accordion-active:block ms-auto hidden w-4 h-4 text-gray-600 group-hover:text-gray-500"
                  xmlns="http://www.w3.org/2000/svg"
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path d="m18 15-6-6-6 6" />
                </svg>

                <svg
                  class="hs-accordion-active:hidden ms-auto block w-4 h-4 text-gray-600 group-hover:text-gray-500"
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M2 5L8.16086 10.6869C8.35239 10.8637 8.64761 10.8637 8.83914 10.6869L15 5"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                  ></path>
                </svg>
              </span>
            </button>

            <div
              id="blog-management-accordion"
              class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300"
              :class="{
                block:
                  $page.url.startsWith('/admin/blog-categories') ||
                  $page.url.startsWith('/admin/blog-contents') ||
                  $page.url.startsWith('/admin/blog-comments'),
                hidden: !(
                  $page.url.startsWith('/admin/blog-categories') ||
                  $page.url.startsWith('/admin/blog-contents') ||
                  $page.url.startsWith('/admin/blog-comments')
                )
              }"
            >
              <ul class="pl-8">
                <li v-show="can('blog-categories.view')" class="items-center">
                  <Link
                    :href="route('admin.blog-categories.index')"
                    :data="{
                      page: 1,
                      per_page: 5,
                      sort: 'id',
                      direction: 'desc'
                    }"
                    class="text-xs py-3 font-bold block"
                    :class="{
                      'text-orange-600 hover:text-orange-500':
                        $page.url.startsWith('/admin/blog-categories'),
                      'text-slate-600 hover:text-slate-500':
                        !$page.url.startsWith('/admin/blog-categories')
                    }"
                  >
                    {{ __('Blog Categories') }}
                  </Link>
                </li>
                <li v-show="can('blog-contents.view')" class="items-center">
                  <Link
                    :href="route('admin.blog-contents.index')"
                    :data="{
                      page: 1,
                      per_page: 5,
                      sort: 'id',
                      direction: 'desc'
                    }"
                    class="text-xs py-3 font-bold block"
                    :class="{
                      'text-orange-600 hover:text-orange-500':
                        $page.url.startsWith('/admin/blog-contents'),
                      'text-slate-600 hover:text-slate-500':
                        !$page.url.startsWith('/admin/blog-contents')
                    }"
                  >
                    {{ __('Blog Contents') }}
                  </Link>
                </li>

                <li v-show="can('blog-comments.view')" class="items-center">
                  <Link
                    :href="route('admin.blog-comments.index')"
                    :data="{
                      page: 1,
                      per_page: 5,
                      sort: 'id',
                      direction: 'desc'
                    }"
                    class="text-xs py-3 font-bold block"
                    :class="{
                      'text-orange-600 hover:text-orange-500':
                        $page.url.startsWith('/admin/blog-comments'),
                      'text-slate-600 hover:text-slate-500':
                        !$page.url.startsWith('/admin/blog-comments')
                    }"
                  >
                    {{ __('Blog Comments') }}
                  </Link>
                </li>
              </ul>
            </div>
          </li>

          <!-- Review Managements -->
          <li class="hs-accordion items-center" id="review-management-accordion">
            <button
              type="button"
              class="hs-accordion-toggle text-slate-600 hover:text-slate-500 text-xs py-3 font-bold flex items-center justify-between w-full"
            >
              <span>
                <i class="fa-solid fa-star mr-1.5"></i>
                {{ __('Rating Management') }}
              </span>
              <span>
                <svg
                  class="hs-accordion-active:block ms-auto hidden w-4 h-4 text-gray-600 group-hover:text-gray-500"
                  xmlns="http://www.w3.org/2000/svg"
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path d="m18 15-6-6-6 6" />
                </svg>

                <svg
                  class="hs-accordion-active:hidden ms-auto block w-4 h-4 text-gray-600 group-hover:text-gray-500"
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M2 5L8.16086 10.6869C8.35239 10.8637 8.64761 10.8637 8.83914 10.6869L15 5"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                  ></path>
                </svg>
              </span>
            </button>

            <div
              id="review-management-accordion"
              class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300"
              :class="{
                block:
                  $page.url.startsWith('/admin/automated-filter-words') ||
                  $page.url.startsWith('/admin/product-review-and-ratings') ||
                  $page.url.startsWith('/admin/seller-service-rating') ||
                  $page.url.startsWith('/admin/delivery-service-rating'),
                hidden: !(
                  $page.url.startsWith('/admin/automated-filter-words') ||
                  $page.url.startsWith('/admin/product-review-and-ratings') ||
                  $page.url.startsWith('/admin/seller-service-rating') ||
                  $page.url.startsWith('/admin/delivery-service-rating')
                )
              }"
            >
              <ul class="pl-8">
                <li v-show="can('automated-filter-words.view')" class="items-center">
                  <Link
                    :href="route('admin.automated-filter-words.index')"
                    :data="{
                      page: 1,
                      per_page: 5,
                      sort: 'id',
                      direction: 'desc'
                    }"
                    class="text-xs py-3 font-bold block"
                    :class="{
                      'text-orange-600 hover:text-orange-500': $page.url.startsWith(
                        '/admin/automated-filter-words'
                      ),
                      'text-slate-600 hover:text-slate-500': !$page.url.startsWith(
                        '/admin/automated-filter-words'
                      )
                    }"
                  >
                    {{ __('Automated Filter Words') }}
                  </Link>
                </li>
                <li v-show="can('categories.view')" class="items-center">
                  <Link
                    :href="route('admin.categories.index')"
                    :data="{
                      page: 1,
                      per_page: 5,
                      sort: 'id',
                      direction: 'desc'
                    }"
                    class="text-xs py-3 font-bold block"
                    :class="{
                      'text-orange-600 hover:text-orange-500':
                        $page.url.startsWith('/admin/categories'),
                      'text-slate-600 hover:text-slate-500':
                        !$page.url.startsWith('/admin/categories')
                    }"
                  >
                    {{ __('Product Review & Ratings') }}
                  </Link>
                </li>
                <li v-show="can('categories.view')" class="items-center">
                  <Link
                    :href="route('admin.categories.index')"
                    :data="{
                      page: 1,
                      per_page: 5,
                      sort: 'id',
                      direction: 'desc'
                    }"
                    class="text-xs py-3 font-bold block"
                    :class="{
                      'text-orange-600 hover:text-orange-500':
                        $page.url.startsWith('/admin/categories'),
                      'text-slate-600 hover:text-slate-500':
                        !$page.url.startsWith('/admin/categories')
                    }"
                  >
                    {{ __('Seller Service Ratings') }}
                  </Link>
                </li>
                <li v-show="can('categories.view')" class="items-center">
                  <Link
                    :href="route('admin.categories.index')"
                    :data="{
                      page: 1,
                      per_page: 5,
                      sort: 'id',
                      direction: 'desc'
                    }"
                    class="text-xs py-3 font-bold block"
                    :class="{
                      'text-orange-600 hover:text-orange-500':
                        $page.url.startsWith('/admin/categories'),
                      'text-slate-600 hover:text-slate-500':
                        !$page.url.startsWith('/admin/categories')
                    }"
                  >
                    {{ __('Delivery Service Ratings') }}
                  </Link>
                </li>
              </ul>
            </div>
          </li>

          <!-- Account Managements -->
          <li
            v-show="
              can('registered-accounts.view') ||
              can('seller-manage.view') ||
              can('store-manage.view') ||
              can('admin-manage.view')
            "
            class="hs-accordion items-center"
            id="account-management-accordion"
          >
            <button
              type="button"
              class="hs-accordion-toggle text-slate-600 hover:text-slate-500 text-xs py-3 font-bold flex items-center justify-between w-full"
            >
              <span>
                <i class="fa-solid fa-user-gear mr-1.5"></i>
                {{ __('Account Management') }}
              </span>
              <span>
                <svg
                  class="hs-accordion-active:block ms-auto hidden w-4 h-4 text-gray-600 group-hover:text-gray-500"
                  xmlns="http://www.w3.org/2000/svg"
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path d="m18 15-6-6-6 6" />
                </svg>

                <svg
                  class="hs-accordion-active:hidden ms-auto block w-4 h-4 text-gray-600 group-hover:text-gray-500"
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M2 5L8.16086 10.6869C8.35239 10.8637 8.64761 10.8637 8.83914 10.6869L15 5"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                  ></path>
                </svg>
              </span>
            </button>

            <div
              id="account-management-accordion"
              class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300"
              :class="{
                block:
                  $page.url.startsWith('/admin/registered-accounts') ||
                  $page.url.startsWith('/admin/seller-manage') ||
                  $page.url.startsWith('/admin/admin-manage'),
                hidden: !(
                  $page.url.startsWith('/admin/registered-accounts') ||
                  $page.url.startsWith('/admin/seller-manage') ||
                  $page.url.startsWith('/admin/admin-manage')
                )
              }"
            >
              <ul class="pl-8">
                <li v-show="can('registered-accounts.view')" class="items-center">
                  <Link
                    :href="route('admin.registered-accounts.index')"
                    :data="{
                      page: 1,
                      per_page: 5,
                      sort: 'id',
                      direction: 'desc'
                    }"
                    class="text-xs py-3 font-bold block"
                    :class="{
                      'text-orange-600 hover:text-orange-500': $page.url.startsWith(
                        '/admin/registered-accounts'
                      ),
                      'text-slate-600 hover:text-slate-500': !$page.url.startsWith(
                        '/admin/registered-accounts'
                      )
                    }"
                  >
                    {{ __('Registered Accounts') }}
                  </Link>
                </li>
                <li v-show="can('seller-manage.view')" class="items-center">
                  <Link
                    :href="route('admin.categories.index')"
                    :data="{
                      page: 1,
                      per_page: 5,
                      sort: 'id',
                      direction: 'desc'
                    }"
                    class="text-xs py-3 font-bold block"
                    :class="{
                      'text-orange-600 hover:text-orange-500':
                        $page.url.startsWith('/admin/seller-manage'),
                      'text-slate-600 hover:text-slate-500':
                        !$page.url.startsWith('/admin/seller-manage')
                    }"
                  >
                    {{ __('Seller Manage') }}
                  </Link>
                </li>
                <!-- <li v-show="can('store-manage.view')" class="items-center">
                  <Link
                    :href="route('admin.store-manage.index')"
                    :data="{
                      page: 1,
                      per_page: 5,
                      sort: 'id',
                      direction: 'desc'
                    }"
                    class="text-xs py-3 font-bold block"
                    :class="{
                      'text-orange-600 hover:text-orange-500':
                        $page.url.startsWith('/admin/store-manage'),
                      'text-slate-600 hover:text-slate-500':
                        !$page.url.startsWith('/admin/store-manage')
                    }"
                  >
                    {{ __('Store Manage') }}
                  </Link>
                </li> -->
                <li v-show="can('admin-manage.view')" class="items-center">
                  <Link
                    :href="route('admin.admin-manage.index')"
                    :data="{
                      page: 1,
                      per_page: 5,
                      sort: 'id',
                      direction: 'desc'
                    }"
                    class="text-xs py-3 font-bold block"
                    :class="{
                      'text-orange-600 hover:text-orange-500':
                        $page.url.startsWith('/admin/admin-manage'),
                      'text-slate-600 hover:text-slate-500':
                        !$page.url.startsWith('/admin/admin-manage')
                    }"
                  >
                    {{ __('Admin Manage') }}
                  </Link>
                </li>
              </ul>
            </div>
          </li>

          <!-- Authority Managements -->
          <li
            v-show="
              can('roles.view') || can('permissions.view') || can('assign-role-permissions.view')
            "
            class="hs-accordion items-center"
            id="review-management-accordion"
          >
            <button
              type="button"
              class="hs-accordion-toggle text-slate-600 hover:text-slate-500 text-xs py-3 font-bold flex items-center justify-between w-full"
            >
              <span>
                <i class="fa-solid fa-user-shield mr-1.5"></i>
                {{ __('Authority Management') }}
              </span>
              <span>
                <svg
                  class="hs-accordion-active:block ms-auto hidden w-4 h-4 text-gray-600 group-hover:text-gray-500"
                  xmlns="http://www.w3.org/2000/svg"
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path d="m18 15-6-6-6 6" />
                </svg>

                <svg
                  class="hs-accordion-active:hidden ms-auto block w-4 h-4 text-gray-600 group-hover:text-gray-500"
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M2 5L8.16086 10.6869C8.35239 10.8637 8.64761 10.8637 8.83914 10.6869L15 5"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                  ></path>
                </svg>
              </span>
            </button>

            <div
              id="authority-management-accordion"
              class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300"
              :class="{
                block:
                  $page.url.startsWith('/admin/roles') ||
                  $page.url.startsWith('/admin/permissions') ||
                  $page.url.startsWith('/admin/assign-role-permissions'),
                hidden: !(
                  $page.url.startsWith('/admin/roles') ||
                  $page.url.startsWith('/admin/permissions') ||
                  $page.url.startsWith('/admin/assign-role-permissions')
                )
              }"
            >
              <ul class="pl-8">
                <li v-show="can('roles.view')" class="items-center">
                  <Link
                    :href="route('admin.roles.index')"
                    :data="{
                      page: 1,
                      per_page: 5,
                      sort: 'id',
                      direction: 'desc'
                    }"
                    class="text-xs py-3 font-bold block"
                    :class="{
                      'text-orange-600 hover:text-orange-500': $page.url.startsWith('/admin/roles'),
                      'text-slate-600 hover:text-slate-500': !$page.url.startsWith('/admin/roles')
                    }"
                  >
                    {{ __('Roles') }}
                  </Link>
                </li>
                <li v-show="can('permissions.view')" class="items-center">
                  <Link
                    :href="route('admin.permissions.index')"
                    :data="{
                      page: 1,
                      per_page: 5,
                      sort: 'id',
                      direction: 'desc'
                    }"
                    class="text-xs py-3 font-bold block"
                    :class="{
                      'text-orange-600 hover:text-orange-500':
                        $page.url.startsWith('/admin/permissions'),
                      'text-slate-600 hover:text-slate-500':
                        !$page.url.startsWith('/admin/permissions')
                    }"
                  >
                    {{ __('Permissions') }}
                  </Link>
                </li>
                <li v-show="can('assign-role-permissions.view')" class="items-center">
                  <Link
                    :href="route('admin.assign-role-permissions.index')"
                    :data="{
                      page: 1,
                      per_page: 5,
                      sort: 'id',
                      direction: 'desc'
                    }"
                    class="text-xs py-3 font-bold block"
                    :class="{
                      'text-orange-600 hover:text-orange-500': $page.url.startsWith(
                        '/admin/assign-role-permissions'
                      ),
                      'text-slate-600 hover:text-slate-500': !$page.url.startsWith(
                        '/admin/assign-role-permissions'
                      )
                    }"
                  >
                    {{ __('Assign Role Permissions') }}
                  </Link>
                </li>
              </ul>
            </div>
          </li>
        </ul>

        <!-- Divider -->
        <hr class="my-4 md:min-w-full" />
        <!-- Heading -->
        <h6 class="md:min-w-full text-blueGray-500 text-xs font-bold block pt-1 pb-4 no-underline">
          {{ __('Subscribers & Newsletters') }}
        </h6>
        <!-- Navigation -->

        <ul class="md:flex-col md:min-w-full flex flex-col list-none">
          <!-- Subscribers -->
          <li v-show="can('brands.view')" class="items-center">
            <Link
              :href="route('admin.brands.index')"
              :data="{
                page: 1,
                per_page: 5,
                sort: 'id',
                direction: 'desc'
              }"
              class="text-xs py-3 font-bold block"
              :class="{
                'text-orange-600 hover:text-orange-500': $page.url.startsWith('/admin/brands'),
                'text-slate-600 hover:text-slate-500': !$page.url.startsWith('/admin/brands')
              }"
            >
              <i class="fa-solid fa-bell mr-2"></i>
              {{ __('Subscribers') }}
            </Link>
          </li>

          <!-- Newsletters -->
          <li v-show="can('brands.view')" class="items-center">
            <Link
              :href="route('admin.brands.index')"
              :data="{
                page: 1,
                per_page: 5,
                sort: 'id',
                direction: 'desc'
              }"
              class="text-xs py-3 font-bold block"
              :class="{
                'text-orange-600 hover:text-orange-500': $page.url.startsWith('/admin/brands'),
                'text-slate-600 hover:text-slate-500': !$page.url.startsWith('/admin/brands')
              }"
            >
              <i class="fa-solid fa-envelope-open-text mr-2"></i>
              {{ __('Newsletters') }}
            </Link>
          </li>
        </ul>

        <!-- Divider -->
        <hr class="my-4 md:min-w-full" />
        <!-- Heading -->
        <h6 class="md:min-w-full text-blueGray-500 text-xs font-bold block pt-1 pb-4 no-underline">
          {{ __('Support & Content') }}
        </h6>
        <!-- Navigation -->

        <ul class="md:flex-col md:min-w-full flex flex-col list-none">
          <!-- Subscribers -->
          <li v-show="can('brands.view')" class="items-center">
            <Link
              :href="route('admin.brands.index')"
              :data="{
                page: 1,
                per_page: 5,
                sort: 'id',
                direction: 'desc'
              }"
              class="text-xs py-3 font-bold block"
              :class="{
                'text-orange-600 hover:text-orange-500': $page.url.startsWith('/admin/brands'),
                'text-slate-600 hover:text-slate-500': !$page.url.startsWith('/admin/brands')
              }"
            >
              <i class="fa-solid fa-message mr-2"></i>
              {{ __('Chat Inbox') }}
            </Link>
          </li>

          <!-- FAQs -->
          <li
            v-show="
              can('faq-categories.view') ||
              can('faq-subcategories.view') ||
              can('faq-contents.view')
            "
            class="hs-accordion items-center"
            id="faqs-accordion"
          >
            <button
              type="button"
              class="hs-accordion-toggle text-slate-600 hover:text-slate-500 text-xs py-3 font-bold flex items-center justify-between w-full"
            >
              <span>
                <i class="fa-solid fa-file-circle-question mr-1.5"></i>
                {{ __('FAQs') }}
              </span>
              <span>
                <svg
                  class="hs-accordion-active:block ms-auto hidden w-4 h-4 text-gray-600 group-hover:text-gray-500"
                  xmlns="http://www.w3.org/2000/svg"
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path d="m18 15-6-6-6 6" />
                </svg>

                <svg
                  class="hs-accordion-active:hidden ms-auto block w-4 h-4 text-gray-600 group-hover:text-gray-500"
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M2 5L8.16086 10.6869C8.35239 10.8637 8.64761 10.8637 8.83914 10.6869L15 5"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                  ></path>
                </svg>
              </span>
            </button>

            <div
              id="faqs-accordion"
              class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300"
              :class="{
                block:
                  $page.url.startsWith('/admin/faq-categories') ||
                  $page.url.startsWith('/admin/faq-contents') ||
                  $page.url.startsWith('/admin/faq-subcategories'),
                hidden: !(
                  $page.url.startsWith('/admin/faq-categories') ||
                  $page.url.startsWith('/admin/faq-contents') ||
                  $page.url.startsWith('/admin/faq-subcategories')
                )
              }"
            >
              <ul class="pl-8">
                <li v-show="can('faq-categories.view')" class="items-center">
                  <Link
                    :href="route('admin.faq-categories.index')"
                    :data="{
                      page: 1,
                      per_page: 5,
                      sort: 'id',
                      direction: 'desc'
                    }"
                    class="text-xs py-3 font-bold block"
                    :class="{
                      'text-orange-600 hover:text-orange-500':
                        $page.url.startsWith('/admin/faq-categories'),
                      'text-slate-600 hover:text-slate-500':
                        !$page.url.startsWith('/admin/faq-categories')
                    }"
                  >
                    {{ __('Faq Categories') }}
                  </Link>
                </li>
                <li v-show="can('faq-subcategories.view')" class="items-center">
                  <Link
                    :href="route('admin.faq-subcategories.index')"
                    :data="{
                      page: 1,
                      per_page: 5,
                      sort: 'id',
                      direction: 'desc'
                    }"
                    class="text-xs py-3 font-bold block"
                    :class="{
                      'text-orange-600 hover:text-orange-500': $page.url.startsWith(
                        '/admin/faq-subcategories'
                      ),
                      'text-slate-600 hover:text-slate-500': !$page.url.startsWith(
                        '/admin/faq-subcategories'
                      )
                    }"
                  >
                    {{ __('Faq Subcategories') }}
                  </Link>
                </li>

                <li v-show="can('faq-contents.view')" class="items-center">
                  <Link
                    :href="route('admin.faq-contents.index')"
                    :data="{
                      page: 1,
                      per_page: 5,
                      sort: 'id',
                      direction: 'desc'
                    }"
                    class="text-xs py-3 font-bold block"
                    :class="{
                      'text-orange-600 hover:text-orange-500':
                        $page.url.startsWith('/admin/faq-contents'),
                      'text-slate-600 hover:text-slate-500':
                        !$page.url.startsWith('/admin/faq-contents')
                    }"
                  >
                    {{ __('Faq Contents') }}
                  </Link>
                </li>
              </ul>
            </div>
          </li>

          <!-- Help Pages -->
          <li
            v-show="can('help-pages.edit')"
            class="hs-accordion items-center"
            id="pages-accordion"
          >
            <button
              type="button"
              class="hs-accordion-toggle text-slate-600 hover:text-slate-500 text-xs py-3 font-bold flex items-center justify-between w-full"
            >
              <span>
                <i class="fa-solid fa-file-lines mr-1.5"></i>
                {{ __('Help Pages') }}
              </span>
              <span>
                <svg
                  class="hs-accordion-active:block ms-auto hidden w-4 h-4 text-gray-600 group-hover:text-gray-500"
                  xmlns="http://www.w3.org/2000/svg"
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path d="m18 15-6-6-6 6" />
                </svg>

                <svg
                  class="hs-accordion-active:hidden ms-auto block w-4 h-4 text-gray-600 group-hover:text-gray-500"
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M2 5L8.16086 10.6869C8.35239 10.8637 8.64761 10.8637 8.83914 10.6869L15 5"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                  ></path>
                </svg>
              </span>
            </button>

            <div
              id="pages-accordion"
              class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300"
              :class="{
                block:
                  $page.url.startsWith('/admin/privacy-and-policy') ||
                  $page.url.startsWith('/admin/terms-and-conditions') ||
                  $page.url.startsWith('/admin/returns-and-refunds'),
                hidden: !(
                  $page.url.startsWith('/admin/privacy-and-policy') ||
                  $page.url.startsWith('/admin/terms-and-conditions') ||
                  $page.url.startsWith('/admin/returns-and-refunds')
                )
              }"
            >
              <ul class="pl-8">
                <li v-show="can('help-pages.edit')" class="items-center">
                  <Link
                    :href="route('admin.terms-and-conditions.edit')"
                    class="text-xs py-3 font-bold block"
                    :class="{
                      'text-orange-600 hover:text-orange-500': $page.url.startsWith(
                        '/admin/terms-and-conditions'
                      ),
                      'text-slate-600 hover:text-slate-500': !$page.url.startsWith(
                        '/admin/terms-and-conditions'
                      )
                    }"
                  >
                    {{ __('Terms & Conditions') }}
                  </Link>
                </li>

                <li v-show="can('help-pages.edit')" class="items-center">
                  <Link
                    :href="route('admin.privacy-and-policy.edit')"
                    class="text-xs py-3 font-bold block"
                    :class="{
                      'text-orange-600 hover:text-orange-500': $page.url.startsWith(
                        '/admin/privacy-and-policy'
                      ),
                      'text-slate-600 hover:text-slate-500': !$page.url.startsWith(
                        '/admin/privacy-and-policy'
                      )
                    }"
                  >
                    {{ __('Privacy & Policy') }}
                  </Link>
                </li>

                <li v-show="can('help-pages.edit')" class="items-center">
                  <Link
                    :href="route('admin.returns-and-refunds.edit')"
                    class="text-xs py-3 font-bold block"
                    :class="{
                      'text-orange-600 hover:text-orange-500': $page.url.startsWith(
                        '/admin/returns-and-refunds'
                      ),
                      'text-slate-600 hover:text-slate-500': !$page.url.startsWith(
                        '/admin/returns-and-refunds'
                      )
                    }"
                  >
                    {{ __('Returns & Refunds') }}
                  </Link>
                </li>
              </ul>
            </div>
          </li>
        </ul>

        <!-- Divider -->
        <hr class="my-4 md:min-w-full" />
        <!-- Heading -->
        <h6 class="md:min-w-full text-blueGray-500 text-xs font-bold block pt-1 pb-4 no-underline">
          {{ __('Settings & Configurations') }}
        </h6>
        <!-- Navigation -->

        <ul class="md:flex-col md:min-w-full flex flex-col list-none">
          <!-- Settings -->
          <li class="hs-accordion items-center" id="settings-accordion">
            <button
              type="button"
              class="hs-accordion-toggle text-slate-600 hover:text-slate-500 text-xs py-3 font-bold flex items-center justify-between w-full"
            >
              <span>
                <i class="fa-solid fa-gears mr-1.5"></i>
                {{ __('Settings') }}
              </span>
              <span>
                <svg
                  class="hs-accordion-active:block ms-auto hidden w-4 h-4 text-gray-600 group-hover:text-gray-500"
                  xmlns="http://www.w3.org/2000/svg"
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path d="m18 15-6-6-6 6" />
                </svg>

                <svg
                  class="hs-accordion-active:hidden ms-auto block w-4 h-4 text-gray-600 group-hover:text-gray-500"
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M2 5L8.16086 10.6869C8.35239 10.8637 8.64761 10.8637 8.83914 10.6869L15 5"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                  ></path>
                </svg>
              </span>
            </button>

            <div
              id="settings-accordion"
              class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden"
            >
              <ul class="pl-8">
                <li v-show="can('general-settings.edit')" class="items-center">
                  <Link
                    :href="route('admin.general-settings.edit')"
                    class="text-xs py-3 font-bold block"
                    :class="{
                      'text-orange-600 hover:text-orange-500':
                        $page.url.startsWith('/admin/general-settings'),
                      'text-slate-600 hover:text-slate-500':
                        !$page.url.startsWith('/admin/general-settings')
                    }"
                  >
                    {{ __('General Settings') }}
                  </Link>
                </li>
                <li v-show="can('blog-contents.view')" class="items-center">
                  <Link
                    :href="route('admin.blog-contents.index')"
                    :data="{
                      page: 1,
                      per_page: 5,
                      sort: 'id',
                      direction: 'desc'
                    }"
                    class="text-xs py-3 font-bold block"
                    :class="{
                      'text-orange-600 hover:text-orange-500':
                        $page.url.startsWith('/admin/blog-contents'),
                      'text-slate-600 hover:text-slate-500':
                        !$page.url.startsWith('/admin/blog-contents')
                    }"
                  >
                    {{ __('Appearance Settings') }}
                  </Link>
                </li>

                <li v-show="can('blog-comments.view')" class="items-center">
                  <Link
                    :href="route('admin.blog-comments.index')"
                    :data="{
                      page: 1,
                      per_page: 5,
                      sort: 'id',
                      direction: 'desc'
                    }"
                    class="text-xs py-3 font-bold block"
                    :class="{
                      'text-orange-600 hover:text-orange-500':
                        $page.url.startsWith('/admin/blog-comments'),
                      'text-slate-600 hover:text-slate-500':
                        !$page.url.startsWith('/admin/blog-comments')
                    }"
                  >
                    {{ __('SEO Settings') }}
                  </Link>
                </li>

                <li v-show="can('blog-comments.view')" class="items-center">
                  <Link
                    :href="route('admin.blog-comments.index')"
                    :data="{
                      page: 1,
                      per_page: 5,
                      sort: 'id',
                      direction: 'desc'
                    }"
                    class="text-xs py-3 font-bold block"
                    :class="{
                      'text-orange-600 hover:text-orange-500':
                        $page.url.startsWith('/admin/blog-comments'),
                      'text-slate-600 hover:text-slate-500':
                        !$page.url.startsWith('/admin/blog-comments')
                    }"
                  >
                    {{ __('Notification Settings') }}
                  </Link>
                </li>

                <li v-show="can('blog-comments.view')" class="items-center">
                  <Link
                    :href="route('admin.blog-comments.index')"
                    :data="{
                      page: 1,
                      per_page: 5,
                      sort: 'id',
                      direction: 'desc'
                    }"
                    class="text-xs py-3 font-bold block"
                    :class="{
                      'text-orange-600 hover:text-orange-500':
                        $page.url.startsWith('/admin/blog-comments'),
                      'text-slate-600 hover:text-slate-500':
                        !$page.url.startsWith('/admin/blog-comments')
                    }"
                  >
                    {{ __('Shipping and Tax Settings') }}
                  </Link>
                </li>
              </ul>
            </div>
          </li>

          <!-- Configurations -->
          <li class="hs-accordion items-center" id="configuration-accordion">
            <button
              type="button"
              class="hs-accordion-toggle text-slate-600 hover:text-slate-500 text-xs py-3 font-bold flex items-center justify-between w-full"
            >
              <span>
                <i class="fa-solid fa-screwdriver-wrench mr-1.5"></i>
                {{ __('Configurations') }}
              </span>
              <span>
                <svg
                  class="hs-accordion-active:block ms-auto hidden w-4 h-4 text-gray-600 group-hover:text-gray-500"
                  xmlns="http://www.w3.org/2000/svg"
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path d="m18 15-6-6-6 6" />
                </svg>

                <svg
                  class="hs-accordion-active:hidden ms-auto block w-4 h-4 text-gray-600 group-hover:text-gray-500"
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M2 5L8.16086 10.6869C8.35239 10.8637 8.64761 10.8637 8.83914 10.6869L15 5"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                  ></path>
                </svg>
              </span>
            </button>

            <div
              id="configuration-accordion"
              class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden"
            >
              <ul class="pl-8">
                <li v-show="can('automated-filter-words.view')" class="items-center">
                  <Link
                    :href="route('admin.automated-filter-words.index')"
                    :data="{
                      page: 1,
                      per_page: 5,
                      sort: 'id',
                      direction: 'desc'
                    }"
                    class="text-xs py-3 font-bold block"
                    :class="{
                      'text-orange-600 hover:text-orange-500': $page.url.startsWith(
                        '/admin/automated-filter-words'
                      ),
                      'text-slate-600 hover:text-slate-500': !$page.url.startsWith(
                        '/admin/automated-filter-words'
                      )
                    }"
                  >
                    {{ __('Email Configurations') }}
                  </Link>
                </li>

                <li v-show="can('categories.view')" class="items-center">
                  <Link
                    :href="route('admin.categories.index')"
                    :data="{
                      page: 1,
                      per_page: 5,
                      sort: 'id',
                      direction: 'desc'
                    }"
                    class="text-xs py-3 font-bold block"
                    :class="{
                      'text-orange-600 hover:text-orange-500':
                        $page.url.startsWith('/admin/categories'),
                      'text-slate-600 hover:text-slate-500':
                        !$page.url.startsWith('/admin/categories')
                    }"
                  >
                    {{ __('Payment Configurations') }}
                  </Link>
                </li>
              </ul>
            </div>
          </li>
        </ul>

        <!-- Divider -->
        <hr class="my-4 md:min-w-full" />
        <!-- Heading -->
        <h6 class="md:min-w-full text-blueGray-500 text-xs font-bold block pt-1 pb-4 no-underline">
          {{ __('Important Operations') }}
        </h6>
        <!-- Navigation -->

        <ul class="md:flex-col md:min-w-full flex flex-col list-none">
          <!-- Clear Database -->
          <li v-show="can('brands.view')" class="items-center">
            <Link
              :href="route('admin.brands.index')"
              :data="{
                page: 1,
                per_page: 5,
                sort: 'id',
                direction: 'desc'
              }"
              class="text-xs py-3 font-bold block"
              :class="{
                'text-orange-600 hover:text-orange-500': $page.url.startsWith('/admin/brands'),
                'text-red-600 hover:text-red-500': !$page.url.startsWith('/admin/brands')
              }"
            >
              <i class="fa-solid fa-database mr-2"></i>
              {{ __('Clear Database') }}
            </Link>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>
