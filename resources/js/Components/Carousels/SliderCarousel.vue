<script setup>
defineProps({ sliderBanners: Object })
</script>

<template>
  <div id="default-carousel" class="relative w-full bg-white rounded-md" data-carousel="slide">
    <!-- Carousel wrapper -->
    <div class="relative -z-0 h-[400px] overflow-hidden rounded-lg">
      <div
        v-for="sliderBanner in sliderBanners"
        :key="sliderBanner.id"
        class="hidden duration-700 ease-in-out"
        data-carousel-item
      >
        <a :href="sliderBanner.url" target="_blank" class="h-full">
          <img
            :src="sliderBanner.image"
            class="absolute block w-full h-full object-contain object-center -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
            alt="slider-banner"
          />
        </a>
      </div>
    </div>
    <!-- Slider indicators -->
    <div
      class="absolute z-50 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse"
    >
      <button
        v-for="(sliderBanner, index) in sliderBanners"
        :key="sliderBanner.id"
        type="button"
        class="w-3 h-3 rounded-full"
        :aria-current="index === 0"
        :aria-label="'Slide ' + sliderBanner.id"
        :data-carousel-slide-to="index"
      ></button>
    </div>
    <!-- Slider controls -->
    <button
      type="button"
      class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
      data-carousel-prev
    >
      <span
        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gray-200 group-hover:bg-gray-300 group-focus:ring-4 group-focus:ring-white group-focus:outline-none"
      >
        <svg
          class="w-4 h-4 text-white rtl:rotate-180"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 6 10"
        >
          <path
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M5 1 1 5l4 4"
          />
        </svg>
        <span class="sr-only">Previous</span>
      </span>
    </button>
    <button
      type="button"
      class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
      data-carousel-next
    >
      <span
        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gray-200 group-hover:bg-gray-300 group-focus:ring-4 group-focus:ring-white group-focus:outline-none"
      >
        <svg
          class="w-4 h-4 text-white rtl:rotate-180"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 6 10"
        >
          <path
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="m1 9 4-4-4-4"
          />
        </svg>
        <span class="sr-only">Next</span>
      </span>
    </button>
  </div>
</template>
