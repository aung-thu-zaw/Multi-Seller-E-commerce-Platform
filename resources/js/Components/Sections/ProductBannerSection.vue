<script setup>
import ProductBannerCarousel from '@/Components/Carousels/ProductBannerCarousel.vue'

defineProps({ productBanners: Object })
</script>

<template>
  <section v-show="productBanners.length" id="product-banner" class="my-5 bg-white">
    <div class="container max-w-screen-xl mx-auto bg-transparent rounded-md px-5 py-3">
      <ProductBannerCarousel :productBanners="productBanners" />
    </div>
  </section>
</template>
