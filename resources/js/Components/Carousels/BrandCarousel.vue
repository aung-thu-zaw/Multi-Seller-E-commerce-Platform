<script setup>
let defaultTransform = 0;

const goNext = () => {
  defaultTransform = defaultTransform - 398;
  var brandSlider = document.getElementById("brand-slider");
  if (Math.abs(defaultTransform) >= brandSlider.scrollWidth / 1.7)
    defaultTransform = 0;
  brandSlider.style.transform = "translateX(" + defaultTransform + "px)";
};

const goPrev = () => {
  var brandSlider = document.getElementById("brand-slider");
  if (Math.abs(defaultTransform) === 0) defaultTransform = 0;
  else defaultTransform = defaultTransform + 398;
  brandSlider.style.transform = "translateX(" + defaultTransform + "px)";
};
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
          id="brand-slider"
          class="h-full flex gap-8 items-center justify-start transition ease-out duration-700 px-10"
        >
          <div class="flex flex-shrink-0 relative">
            <img
              src="https://seeklogo.com/images/C/chanel-logo-12D54F4AC6-seeklogo.com.png"
              alt="black chair and white table"
              class="object-contain object-center w-20 h-20"
            />
          </div>
          <div class="flex flex-shrink-0 relative">
            <img
              src="https://1000logos.net/wp-content/uploads/2021/04/Suzuki-logo.png"
              alt="black chair and white table"
              class="object-contain object-center w-20 h-20"
            />
          </div>
          <div class="flex flex-shrink-0 relative">
            <img
              src="https://www.logo.wine/a/logo/Nike,_Inc./Nike,_Inc.-Logo.wine.svg"
              alt="black chair and white table"
              class="object-contain object-center w-20 h-20"
            />
          </div>
          <div class="flex flex-shrink-0 relative">
            <img
              src="https://cdn.freebiesupply.com/logos/large/2x/samsung-1-logo-black-and-white.png"
              alt="black chair and white table"
              class="object-contain object-center w-20 h-20"
            />
          </div>
          <div class="flex flex-shrink-0 relative">
            <img
              src="https://pngimg.com/d/amazon_PNG1.png"
              alt="black chair and white table"
              class="object-contain object-center w-20 h-20"
            />
          </div>

          <div class="flex flex-shrink-0 relative">
            <img
              src="https://www.logo.wine/a/logo/Under_Armour/Under_Armour-Logo.wine.svg"
              alt="black chair and white table"
              class="object-contain object-center w-20 h-20"
            />
          </div>
          <div class="flex flex-shrink-0 relative">
            <img
              src="https://getvectorlogo.com/wp-content/uploads/2022/10/acuity-brands-vector-logo-2022.png"
              alt="black chair and white table"
              class="object-contain object-center w-20 h-20"
            />
          </div>
          <div class="flex flex-shrink-0 relative">
            <img
              src="https://www.freepnglogos.com/uploads/new-balance-png-logo/womens-stylish-shoes-new-balance-png-logo-1.png"
              alt="black chair and white table"
              class="object-contain object-center w-20 h-20"
            />
          </div>
          <div class="flex flex-shrink-0 relative">
            <img
              src="https://cdn.freebiesupply.com/logos/large/2x/acuity-1-logo-png-transparent.png"
              alt="black chair and white table"
              class="object-contain object-center w-20 h-20"
            />
          </div>
          <div class="flex flex-shrink-0 relative">
            <img
              src="https://www.kindpng.com/picc/m/10-106582_asus-logo-png-republic-of-gamers-transparent-png.png"
              alt="black chair and white table"
              class="object-contain object-center w-20 h-20"
            />
          </div>
          <div class="flex flex-shrink-0 relative">
            <img
              src="https://static.vecteezy.com/system/resources/previews/022/100/989/original/spotify-logo-transparent-free-png.png"
              alt="black chair and white table"
              class="object-contain object-center w-20 h-20"
            />
          </div>
          <div class="flex flex-shrink-0 relative">
            <img
              src="https://logovectorseek.com/wp-content/uploads/2020/07/imperial-brands-logo-vector.png"
              alt="black chair and white table"
              class="object-contain object-center w-20 h-20"
            />
          </div>
          <div class="flex flex-shrink-0 relative">
            <img
              src="https://vtlogo.com/wp-content/uploads/2021/06/contigo-brands-vector-logo.png"
              alt="black chair and white table"
              class="object-contain object-center w-20 h-20"
            />
          </div>
          <div class="flex flex-shrink-0 relative">
            <img
              src="https://1000logos.net/wp-content/uploads/2021/05/Sony-logo.png"
              alt="black chair and white table"
              class="object-contain object-center w-20 h-20"
            />
          </div>
          <div class="flex flex-shrink-0 relative">
            <img
              src="https://www.freepnglogos.com/uploads/lg-logo-png/lg-logo-logo-png-transparent-svg-vector-bie-supply-0.png"
              alt="black chair and white table"
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

