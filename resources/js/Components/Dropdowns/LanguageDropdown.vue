<script setup>
import English from '@/assets/images/united-state.png'
import Myanmar from '@/assets/images/myanmar.png'
</script>

<template>
  <div class="hs-dropdown relative inline-flex">
    <button
      id="hs-dropdown-custom-icon-trigger"
      type="button"
      class="hs-dropdown-toggle flex items-center whitespace-nowrap text-sm font-bold leading-normal text-white"
      :class="{
        'px-4 pt-2.5 pb-2 ': $page.url.startsWith('/admin') || $page.url.startsWith('/seller')
      }"
    >
      <i class="fa-solid fa-globe mr-1"></i>
      <span v-show="!$page.url.startsWith('/admin') || !$page.url.startsWith('/seller')">
        {{ __('Language') }}
      </span>
    </button>

    <div
      class="hs-dropdown-menu transition-[opacity,margin] duration z-50 hs-dropdown-open:opacity-100 opacity-0 hidden bg-white shadow-md rounded-lg p-2 mt-2"
      aria-labelledby="hs-dropdown-custom-icon-trigger"
    >
      <div>
        <div
          class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
        >
          <a
            :href="route('languages.change', { language: 'en' })"
            class="flex items-center justify-between"
          >
            <div class="flex items-center font-medium">
              <img :src="English" alt="English" class="w-5 mr-2" />

              English
            </div>

            <span v-show="$page.props.language === 'en'" class="ml-1">
              <i class="fa-solid fa-circle-check"></i>
            </span>
          </a>
        </div>
        <div
          class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
        >
          <a
            :href="route('languages.change', { language: 'my' })"
            class="flex items-center justify-between"
          >
            <div class="flex items-center font-medium">
              <img :src="Myanmar" alt="Myanmar" class="w-5 mr-2" />

              Myanmar
            </div>

            <span v-show="$page.props.language === 'my'" class="ml-1">
              <i class="fa-solid fa-circle-check"></i>
            </span>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>
