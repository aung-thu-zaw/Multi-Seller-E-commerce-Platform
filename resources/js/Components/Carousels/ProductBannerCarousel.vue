<script setup>
let defaultTransform = 0

const goNext = () => {
  defaultTransform = defaultTransform - 398
  var productBannerSlider = document.getElementById('product-banner-slider')
  if (Math.abs(defaultTransform) >= productBannerSlider.scrollWidth / 1.7) defaultTransform = 0
  productBannerSlider.style.transform = 'translateX(' + defaultTransform + 'px)'
}

const goPrev = () => {
  var productBannerSlider = document.getElementById('product-banner-slider')
  if (Math.abs(defaultTransform) === 0) defaultTransform = 0
  else defaultTransform = defaultTransform + 398
  productBannerSlider.style.transform = 'translateX(' + defaultTransform + 'px)'
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
          id="product-banner-slider"
          class="h-full flex gap-3 items-center justify-start transition ease-out duration-700"
        >
          <div class="flex flex-shrink-0 relative">
            <img
              src="https://slidebazaar.com/wp-content/uploads/2021/09/product-banner-jpg.webp"
              alt="campaign-banner-image"
              class="object-contain object-center w-full h-56"
            />
          </div>
          <div class="flex flex-shrink-0 relative">
            <img
              src="https://t4.ftcdn.net/jpg/04/89/28/05/360_F_489280525_nISHfaWCctYBFlyYkTQUkzQwVOPWmyvp.jpg"
              alt="campaign-banner-image"
              class="object-contain object-center w-full h-56"
            />
          </div>
          <div class="flex flex-shrink-0 relative">
            <img
              src="https://slidebazaar.com/wp-content/uploads/2021/09/newly-arrived-product.jpg"
              alt="campaign-banner-image"
              class="object-contain object-center w-full h-56"
            />
          </div>
          <div class="flex flex-shrink-0 relative">
            <img
              src="https://images.remotehub.com/d42c62669a7711eb91397e038280fee0/original_thumb/ec1eb042.jpg?version=1618112516"
              alt="campaign-banner-image"
              class="object-contain object-center w-full h-56"
            />
          </div>
          <div class="flex flex-shrink-0 relative">
            <img
              src="https://cdn.vectorstock.com/i/preview-1x/80/07/cosmetic-bottles-ad-poster-design-makeup-vector-47518007.jpg"
              alt="campaign-banner-image"
              class="object-contain object-center w-full h-56"
            />
          </div>
          <div class="flex flex-shrink-0 relative">
            <img
              src="https://cdn.vectorstock.com/i/preview-1x/74/07/beauty-product-cosmetics-bottles-mock-up-banner-vector-35787407.jpg"
              alt="campaign-banner-image"
              class="object-contain object-center w-full h-56"
            />
          </div>
          <div class="flex flex-shrink-0 relative">
            <img
              src="https://cdn.vectorstock.com/i/preview-1x/39/19/cosmetic-spray-bottle-mockup-banner-beauty-product-vector-27223919.jpg"
              alt="campaign-banner-image"
              class="object-contain object-center w-full h-56"
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
