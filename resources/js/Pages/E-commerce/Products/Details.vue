<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import PeopleWhoViewedProductSection from '@/Components/Sections/PeopleWhoViewedProductSection.vue'
import ProductMainDetailSection from '@/Components/Sections/ProductMainDetailSection.vue'
import ProductInformationSection from '@/Components/Sections/ProductInformationSection.vue'
import ProductGridCard from '@/Components/Cards/Products/ProductGridCard.vue'
import { Head } from '@inertiajs/vue3'

defineProps({ product: Object, productsFromTheSameStore: Object })
</script>


<template>
  <Head :title="product?.name" />
  <AppLayout>
    <div class="w-[1280px] mx-auto my-5 space-y-5">
      <ProductMainDetailSection :product="product" />
      <div class="flex items-start justify-between gap-x-5">
        <div class="w-full">
          <ProductInformationSection :product="product" />

          <PeopleWhoViewedProductSection />
        </div>

        <div class="w-[400px]">
          <div
            class="flex flex-col space-y-5 bg-white py-10 border rounded-md border-gray-200 px-6"
          >
            <h1 class="font-bold text-gray-700 text-lg text-center w-full">
              <i class="fa-solid fa-store text-md mr-1"></i>
              From The Same Store
            </h1>
            <ProductGridCard
              v-for="product in productsFromTheSameStore"
              :key="product.id"
              :product="product"
            />
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<!-- <style>
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  display: none;
}

.scrollbar::-webkit-scrollbar {
  height: 10px;
}
</style> -->
