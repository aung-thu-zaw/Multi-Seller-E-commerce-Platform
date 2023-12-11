<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import StoreProfileCard from '@/Components/Cards/StoreProfileCard.vue'
import StoreSearchBox from '@/Components/Forms/SearchBoxs/StoreSearchBox.vue'
import { Head } from '@inertiajs/vue3'
</script>

<template>
  <Head :title="__('Our Seller Stores')" />

  <AppLayout>
    <section id="seller-stores" class="py-5">
      <div class="w-[1200px] mx-auto flex flex-col items-start">
        <!-- Cover Photo -->
        <div
          class="w-full h-[150px] mb-10 shadow-md rounded-md overflow-hidden flex items-center justify-center seller-background"
        >
          <div class="font-semibold text-white space-y-5">
            <p class="text-center text-2xl">{{ __('Our Seller Stores') }}</p>
            <p class="text-center text-sm text-gray-100 mt-2">
              {{ __('Explore a variety of products from our trusted sellers.') }}
            </p>
          </div>
        </div>

        <div class="mb-5 ml-auto">
          <StoreSearchBox />
        </div>

        <div class="grid grid-cols-3 gap-5">
          <!-- Card -->
          <StoreProfileCard />
          <StoreProfileCard />
          <StoreProfileCard />
          <StoreProfileCard />
          <StoreProfileCard />
          <StoreProfileCard />
          <StoreProfileCard />
          <StoreProfileCard />
          <StoreProfileCard />
          <StoreProfileCard />
          <StoreProfileCard />
          <StoreProfileCard />
        </div>
      </div>
    </section>
  </AppLayout>
</template>


<style>
.seller-background {
  background-image: url('https://png.pngtree.com/thumb_back/fh260/back_our/20190614/ourmid/pngtree-happy-shopping-light-spot-poster-background-image_122448.jpg');
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
  background-color: rgba(0, 0, 0, 0.3);
  background-blend-mode: overlay;
}
</style>
