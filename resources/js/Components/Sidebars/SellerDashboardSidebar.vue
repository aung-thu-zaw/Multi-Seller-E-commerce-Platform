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
          {{ __('Shop Administration') }}
        </h6>
        <!-- Navigation -->

        <ul class="md:flex-col md:min-w-full flex flex-col list-none">
          <!-- Dashboard -->
          <li class="items-center">
            <Link :href="route('admin.dashboard')">
              <div
                class="text-xs py-3 font-bold block"
                :class="{
                  'text-blue-600 hover:text-blue-500': $page.url === '/seller/dashboard',
                  'text-slate-600 hover:text-slate-500': $page.url !== '/seller/dashboard'
                }"
              >
                <i class="fas fa-tv mr-2"></i>
                {{ __('Dashboard') }}
              </div>
            </Link>
          </li>

          <!-- Categories -->
          <li class="items-center">
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
                'text-blue-600 hover:text-blue-500': $page.url.startsWith('/seller/categories'),
                'text-slate-600 hover:text-slate-500': !$page.url.startsWith('/seller/categories')
              }"
            >
              <i class="fa-solid fa-list mr-2"></i>
              {{ __('Categories') }}
            </Link>
          </li>

          <!-- Products -->
          <li class="items-center">
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
                'text-blue-600 hover:text-blue-500': $page.url.startsWith('/seller/products'),
                'text-slate-600 hover:text-slate-500': !$page.url.startsWith('/seller/products')
              }"
            >
              <i class="fa-solid fa-basket-shopping mr-2"></i>
              {{ __('Products') }}
            </Link>
          </li>

          <!-- Flash Sales -->
          <li class="items-center">
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
                'text-blue-600 hover:text-blue-500': $page.url.startsWith('/seller/flash-sales'),
                'text-slate-600 hover:text-slate-500': !$page.url.startsWith('/seller/flash-sales')
              }"
            >
              <i class="fa-solid fa-bolt-lightning mr-2"></i>
              {{ __('Flash Sales') }}
            </Link>
          </li>

          <!-- Banners -->
          <li class="items-center">
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
                'text-blue-600 hover:text-blue-500':
                  $page.url.startsWith('/seller/product-banners'),
                'text-slate-600 hover:text-slate-500':
                  !$page.url.startsWith('/seller/product-banners')
              }"
            >
              <i class="fa-solid fa-ad mr-2"></i>
              {{ __('Product Banners') }}
            </Link>
          </li>

          <!-- Chat -->
          <!-- Store Profile -->
          <li class="items-center">
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
                'text-blue-600 hover:text-blue-500': $page.url.startsWith('/seller/chat'),
                'text-slate-600 hover:text-slate-500': !$page.url.startsWith('/seller/chat')
              }"
            >
              <i class="fa-solid fa-message mr-2"></i>
              {{ __('Chat') }}
            </Link>
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
          <!-- Stock Management -->
          <li class="items-center">
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
                'text-blue-600 hover:text-blue-500': $page.url.startsWith(
                  '/seller/stock-management'
                ),
                'text-slate-600 hover:text-slate-500': !$page.url.startsWith(
                  '/seller/stock-management'
                )
              }"
            >
              <i class="fa-solid fa-boxes-stacked mr-2"></i>
              {{ __('Stock Management') }}
            </Link>
          </li>

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
                <li class="items-center">
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
                      'text-blue-600 hover:text-blue-500':
                        $page.url.startsWith('/admin/categories'),
                      'text-slate-600 hover:text-slate-500':
                        !$page.url.startsWith('/admin/categories')
                    }"
                  >
                    {{ __('All Orders') }}
                  </Link>
                </li>

                <li class="items-center">
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
                      'text-blue-600 hover:text-blue-500':
                        $page.url.startsWith('/admin/categories'),
                      'text-slate-600 hover:text-slate-500':
                        !$page.url.startsWith('/admin/categories')
                    }"
                  >
                    {{ __('Return Orders') }}
                  </Link>
                </li>

                <li class="items-center">
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
                      'text-blue-600 hover:text-blue-500':
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

          <!-- Review Managements -->
          <li class="hs-accordion items-center" id="review-management-accordion">
            <button
              type="button"
              class="hs-accordion-toggle text-slate-600 hover:text-slate-500 text-xs py-3 font-bold flex items-center justify-between w-full"
            >
              <span>
                <i class="fa-solid fa-star mr-1.5"></i>
                {{ __('Review Management') }}
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
              class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden"
            >
              <ul class="pl-8">
                <li class="items-center">
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
                      'text-blue-600 hover:text-blue-500':
                        $page.url.startsWith('/admin/product-reviews'),
                      'text-slate-600 hover:text-slate-500':
                        !$page.url.startsWith('/admin/product-reviews')
                    }"
                  >
                    {{ __('Product Reviews') }}
                  </Link>
                </li>
                <li class="items-center">
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
                      'text-blue-600 hover:text-blue-500':
                        $page.url.startsWith('/admin/store-reviews'),
                      'text-slate-600 hover:text-slate-500':
                        !$page.url.startsWith('/admin/store-reviews')
                    }"
                  >
                    {{ __('Store Reviews') }}
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
          {{ __('Financial & Store') }}
        </h6>
        <!-- Navigation -->

        <ul class="md:flex-col md:min-w-full flex flex-col list-none">
          <!-- My Withdraw -->
          <li class="items-center">
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
                'text-blue-600 hover:text-blue-500': $page.url.startsWith('/seller/my-withdraw'),
                'text-slate-600 hover:text-slate-500': !$page.url.startsWith('/seller/my-withdraw')
              }"
            >
              <i class="fa-solid fa-money-bill-transfer mr-2"></i>
              {{ __('My Withdraw') }}
            </Link>
          </li>

          <!-- Store Setting -->
          <li class="items-center">
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
                'text-blue-600 hover:text-blue-500': $page.url.startsWith('/seller/my-withdraw'),
                'text-slate-600 hover:text-slate-500': !$page.url.startsWith('/seller/my-withdraw')
              }"
            >
              <i class="fa-solid fa-store mr-2"></i>
              {{ __('Store Setting') }}
            </Link>
          </li>
        </ul>

        <!-- Divider -->
        <hr class="my-4 md:min-w-full" />
        <!-- Heading -->
        <h6 class="md:min-w-full text-blueGray-500 text-xs font-bold block pt-1 pb-4 no-underline">
          {{ __('Help & Support') }}
        </h6>
        <!-- Navigation -->

        <ul class="md:flex-col md:min-w-full flex flex-col list-none">
          <!-- Seller Guides -->
          <li class="items-center">
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
                'text-blue-600 hover:text-blue-500': $page.url.startsWith('/seller/guides'),
                'text-slate-600 hover:text-slate-500': !$page.url.startsWith('/seller/guides')
              }"
            >
              <i class="fa-solid fa-book mr-2"></i>
              {{ __('Guides') }}
            </Link>
          </li>

          <!-- Seller Faqs -->
          <li class="items-center">
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
                'text-blue-600 hover:text-blue-500': $page.url.startsWith('/seller/guides'),
                'text-slate-600 hover:text-slate-500': !$page.url.startsWith('/seller/guides')
              }"
            >
              <i class="fa-solid fa-circle-question mr-2"></i>
              {{ __('FAQs') }}
            </Link>
          </li>

          <!-- Help Center -->
          <li class="items-center">
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
                'text-blue-600 hover:text-blue-500': $page.url.startsWith('/seller/guides'),
                'text-slate-600 hover:text-slate-500': !$page.url.startsWith('/seller/guides')
              }"
            >
              <i class="fa-solid fa-circle-info mr-2"></i>
              {{ __('Help Center') }}
            </Link>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>
