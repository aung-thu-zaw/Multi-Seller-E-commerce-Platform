<script setup>
defineProps({ brands: Object })

let defaultTransform = 0

const goNext = () => {
  defaultTransform = defaultTransform - 398
  var brandCarousel = document.getElementById('brand-carousel')
  if (Math.abs(defaultTransform) >= brandCarousel.scrollWidth / 1.7) defaultTransform = 0
  brandCarousel.style.transform = 'translateX(' + defaultTransform + 'px)'
}

const goPrev = () => {
  var brandCarousel = document.getElementById('brand-carousel')
  if (Math.abs(defaultTransform) === 0) defaultTransform = 0
  else defaultTransform = defaultTransform + 398
  brandCarousel.style.transform = 'translateX(' + defaultTransform + 'px)'
}
</script>

<template>
  <div class="flex items-center justify-center w-full h-full p-4">
    <div class="w-full relative flex items-center justify-center">
      <button
        aria-label="slide backward"
        class="absolute z-30 -left-10 border w-8 h-8 rounded-full flex items-center justify-center bg-orange-500 hover:bg-orange-600 shadow transition-all focus:ring-2 focus:ring-orange-200 focus:border-orange-300"
        @click="goPrev"
      >
        <svg
          class="text-white"
          width="8"
          height="14"
          viewBox="0 0 8 14"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M7 1L1 7L7 13"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
          />
        </svg>
      </button>
      <div class="w-full h-full mx-auto overflow-x-hidden overflow-y-hidden">
        <div
          id="brand-carousel"
          class="h-full flex gap-8 items-center justify-start transition ease-out duration-700 px-10"
        >
          <div v-for="brand in brands" :key="brand.id" class="flex flex-shrink-0 relative">
            <img
              :src="brand.logo"
              alt="brand-image"
              class="object-contain object-center w-20 h-20"
            />
          </div>
        </div>
      </div>
      <button
        aria-label="slide forward"
        class="absolute z-30 -right-10 border w-8 h-8 rounded-full flex items-center justify-center bg-orange-500 hover:bg-orange-600 shadow transition-all focus:ring-2 focus:ring-orange-200 focus:border-orange-300"
        @click="goNext"
      >
        <svg
          class="text-white"
          width="8"
          height="14"
          viewBox="0 0 8 14"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M1 1L7 7L1 13"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
          />
        </svg>
      </button>
    </div>
  </div>
</template>
