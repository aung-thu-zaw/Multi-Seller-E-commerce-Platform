<script setup>
defineProps({ productBanners: Object })

let defaultTransform = 0

const goNext = () => {
  defaultTransform = defaultTransform - 398
  var productBannerCarousel = document.getElementById('product-banner-carousel')
  if (Math.abs(defaultTransform) >= productBannerCarousel.scrollWidth / 1.7) defaultTransform = 0
  productBannerCarousel.style.transform = 'translateX(' + defaultTransform + 'px)'
}

const goPrev = () => {
  var productBannerCarousel = document.getElementById('product-banner-carousel')
  if (Math.abs(defaultTransform) === 0) defaultTransform = 0
  else defaultTransform = defaultTransform + 398
  productBannerCarousel.style.transform = 'translateX(' + defaultTransform + 'px)'
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
          id="product-banner-carousel"
          class="h-full flex gap-3 items-center justify-start transition ease-out duration-700"
        >
          <div
            v-for="productBanner in productBanners"
            :key="productBanner.id"
            class="flex flex-shrink-0 relative rounded-md overflow-hidden"
          >
            <a :href="productBanner.url" target="_blank" class="h-full">
              <img
                :src="productBanner.image"
                alt="product-banner-image"
                class="object-contain object-center w-full h-56"
              />
            </a>
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
