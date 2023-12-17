<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import PeopleWhoViewedProductSection from '@/Components/Sections/PeopleWhoViewedProductSection.vue'
import ProductMainDetailSection from '@/Components/Sections/ProductMainDetailSection.vue'
import ProductInformationSection from '@/Components/Sections/ProductInformationSection.vue'
import ProductGridCard from '@/Components/Cards/Products/ProductGridCard.vue'
import { Head } from '@inertiajs/vue3'
</script>


<template>
  <Head title="Product Name" />
  <AppLayout>
    <div class="w-[1280px] mx-auto my-5 space-y-5">
      <ProductMainDetailSection />
      <div class="flex items-start justify-between gap-x-5">
        <div class="w-9/12">
          <ProductInformationSection />

          <PeopleWhoViewedProductSection />
        </div>

        <div class="w-3/12">
          <div
            class="flex flex-col items-center space-y-5 bg-white py-10 border rounded-md border-gray-200"
          >
            <h1 class="font-bold text-gray-700 text-lg w-full px-12">
              <i class="fa-solid fa-store text-md mr-1"></i>
              From The Same Store
            </h1>
            <ProductGridCard />
            <ProductGridCard />
            <ProductGridCard />
            <ProductGridCard />
            <ProductGridCard />
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<style>
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  display: none;
}

.scrollbar::-webkit-scrollbar {
  height: 10px;
}
</style>
