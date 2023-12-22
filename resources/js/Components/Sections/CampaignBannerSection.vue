<script setup>
defineProps({ campaignBanner: Object })
</script>

<template>
  <section v-show="campaignBanner" id="campaign-banner" class="my-5">
    <div class="container mx-auto flex items-center justify-center">
      <a :href="campaignBanner.url" target="_blank" class="h-full">
        <img
          :src="campaignBanner?.image"
          alt="campaign-banner-image"
          class="object-contain w-full max-h-40"
        />
      </a>
    </div>
  </section>
</template>
