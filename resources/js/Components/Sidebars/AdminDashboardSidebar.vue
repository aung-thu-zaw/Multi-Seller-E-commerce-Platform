<script setup>
import UserDropdown from "@/Components/Dropdowns/UserDropdown.vue";
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";
import logo from "@/assets/images/website-logo-color.png";

const collapseShow = ref("hidden");

const toggleCollapseShow = (classes) => {
  collapseShow.value = classes;
};
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
        class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded border border-accent-light md:border-none"
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
                <img
                  :src="logo"
                  alt="logo"
                  class="w-auto h-12 object-contain"
                />
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
        <h6
          class="md:min-w-full text-blueGray-500 text-xs font-bold block pt-1 pb-4 no-underline"
        >
          {{ __("E-commerce Administration") }}
        </h6>
        <!-- Navigation -->

        <ul class="md:flex-col md:min-w-full flex flex-col list-none">
          <!-- Dashboard -->
          <li class="items-center">
            <Link :href="route('admin.dashboard')">
              <div
                class="text-xs py-3 font-bold block"
                :class="{
                  'text-blue-600 hover:text-blue-500':
                    $page.url === '/admin/dashboard',
                  'text-slate-600 hover:text-slate-500':
                    $page.url !== '/admin/dashboard',
                }"
              >
                <i class="fas fa-tv mr-2 text-sm"></i>
                {{ __("Dashboard") }}
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
                direction: 'desc',
              }"
              class="text-xs py-3 font-bold block"
              :class="{
                'text-blue-600 hover:text-blue-500':
                  $page.url.startsWith('/admin/categories'),
                'text-slate-600 hover:text-slate-500':
                  !$page.url.startsWith('/admin/categories'),
              }"
            >
              <i class="fa-solid fa-list mr-2 text-sm"></i>
              {{ __("Categories") }}
            </Link>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>










