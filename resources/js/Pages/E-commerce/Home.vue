<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import EcommerceHeader from '@/Components/Headers/EcommerceHeader.vue'
import CampaignBannerSection from '@/Components/Sections/CampaignBannerSection.vue'
import ProductBannerSection from '@/Components/Sections/ProductBannerSection.vue'
import FlashSaleSection from '@/Components/Sections/FlashSaleSection.vue'
import CollectionSection from '@/Components/Sections/CollectionSection.vue'
import OurBrandSection from '@/Components/Sections/OurBrandSection.vue'
import ProductForYouSection from '@/Components/Sections/ProductForYouSection.vue'
import NewsletterSection from '@/Components/Sections/NewsletterSection.vue'
import WhyChooseUsSection from '@/Components/Sections/WhyChooseUsSection.vue'
import { Head } from '@inertiajs/vue3'
// import { Head, usePage } from '@inertiajs/vue3'
// import { onMounted } from 'vue'
// import { toast } from 'vue3-toastify'
// import 'vue3-toastify/dist/index.css'
// import { __ } from '@/Services/translations-inside-setup'

defineProps({
  brands: Object,
  sliderBanners: Object,
  campaignBanner: Object,
  productBanners: Object,
  flashSale: Object,
  collections: Object,
  products: Object
})

// onMounted(() => {
//   const successMessage = usePage().props.flash.success
//   if (successMessage) {
//     toast.success(__(successMessage), {
//       autoClose: 2000
//     })
//   }

//   const errorMessage = usePage().props.flash.error
//   if (errorMessage) {
//     toast.error(__(errorMessage), {
//       autoClose: 2000
//     })
//   }
// })
</script>

<template>
  <Head title="E-commerce Online Shopping" />

  <AppLayout>
    <EcommerceHeader :sliderBanners="sliderBanners" />

    <CampaignBannerSection :campaignBanner="campaignBanner" />

    <FlashSaleSection :flashSale="flashSale" />

    <ProductBannerSection :productBanners="productBanners" />

    <CollectionSection :collections="collections" />

    <OurBrandSection :brands="brands" />

    <ProductForYouSection :products="products" />

    <NewsletterSection />

    <WhyChooseUsSection />
  </AppLayout>
</template>

<style>
.badge-gradient {
  background: rgb(234, 88, 11);
  background: linear-gradient(
    100deg,
    rgba(234, 88, 11, 1) 0%,
    rgba(234, 88, 11, 0.9430365896358543) 53%,
    rgba(255, 255, 255, 1) 53%
  );
}
</style>
