<script setup>
import BrandCarousel from '@/Components/Carousels/BrandCarousel.vue'
defineProps({ brands: Object })
</script>

<template>
  <section id="our-brands" class="my-5 bg-white">
    <div class="container max-w-screen-xl mx-auto bg-transparent rounded-md px-5 py-3">
      <BrandCarousel :brands="brands" />
    </div>
  </section>
</template>
