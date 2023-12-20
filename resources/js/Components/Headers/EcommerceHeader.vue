<script setup>
import SliderCarousel from '@/Components/Carousels/SliderCarousel.vue'
import HeroMainCategoryCard from '@/Components/Cards/HeroMainCategoryCard.vue'

defineProps({
  sliderBanners: Object
})
</script>

<template>
  <section class="pt-5">
    <div class="w-[1280px] mx-auto">
      <article class="flex items-center gap-x-3">
        <HeroMainCategoryCard />

        <!-- Slider Banner -->
        <main class="w-full z-10">
          <SliderCarousel :sliderBanners="sliderBanners" />
        </main>
      </article>
    </div>
  </section>
</template>



