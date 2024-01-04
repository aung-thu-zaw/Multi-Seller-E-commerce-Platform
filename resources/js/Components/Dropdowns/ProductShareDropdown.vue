<script setup>
import { __ } from '@/Services/translations-inside-setup.js'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'

defineProps({ shares: Object })

const copyLink = () => {
  if (navigator.clipboard) {
    const baseUrl = window.location.href.split('?')[0]
    navigator.clipboard
      .writeText(baseUrl)
      .then(() => {
        toast.success(__('Copied To Clipboard!'), {
          autoClose: 2000
        })
      })
      .catch((error) => {
        console.error('Error copying message:', error)
      })
  } else {
    console.error('Clipboard API is not supported in this browser.')
  }
}
</script>

<template>
  <div class="hs-dropdown relative inline-flex">
    <button
      id="hs-dropdown-custom-icon-trigger"
      type="button"
      class="hs-dropdown-toggle flex justify-center items-center h-10 w-10 text-sm font-semibold"
    >
      <span
        class="rounded-full w-8 h-8 bg-gray-100 text-gray-700 hover:bg-gray-200 hover:text-gray-800 flex items-center justify-center border"
      >
        <i class="fa-solid fa-share-nodes"></i>
      </span>
    </button>

    <div
      class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-[15rem] bg-white shadow-md rounded-lg mt-2 text-sm text-gray-600 font-semibold p-4 border"
      aria-labelledby="hs-dropdown-custom-icon-trigger"
    >
      <ul class="space-y-3">
        <li class="text-left hover:text-orange-600">
          <a :href="shares?.facebook" target="_blank">
            <i class="fa-brands fa-facebook mr-3 text-lg text-blue-600"></i>
            Facebook
          </a>
        </li>

        <li class="text-left hover:text-orange-600">
          <a :href="shares?.twitter" target="_blank">
            <i class="fa-brands fa-twitter mr-3 text-lg text-sky-600"></i>
            Twitter
          </a>
        </li>

        <li class="text-left hover:text-orange-600">
          <a :href="shares?.reddit" target="_blank">
            <i class="fa-brands fa-reddit mr-3 text-lg text-orange-500"></i>
            Reddit
          </a>
        </li>

        <li class="text-left hover:text-orange-600">
          <a :href="shares?.telegram" target="_blank">
            <i class="fa-brands fa-telegram mr-3 text-lg text-blue-500"></i>
            Telegram
          </a>
        </li>

        <li class="text-left hover:text-orange-600">
          <a :href="shares?.whatsapp" target="_blank">
            <i class="fa-brands fa-whatsapp mr-3 text-lg text-emerald-600"></i>
            Whatsapp
          </a>
        </li>

        <li class="text-left hover:text-orange-600">
          <button @click="copyLink">
            <i class="fa-solid fa-link mr-3 text-sm text-slate-600"></i>
            Copy Link
          </button>
        </li>
      </ul>
    </div>
  </div>
</template>
