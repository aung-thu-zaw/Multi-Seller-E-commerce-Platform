<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import StoreProductSearchBox from '@/Components/Forms/SearchBoxs/StoreProductSearchBox.vue'
import StoreProfileCoverCard from '@/Components/Cards/Stores/StoreProfileCoverCard.vue'
import Home from './Partials/Home.vue'
import AllProducts from './Partials/AllProducts.vue'
import ProductRatingAndReviews from './Partials/ProductRatingAndReviews.vue'
import StoreProfile from './Partials/StoreProfile.vue'
import { Head } from '@inertiajs/vue3'
</script>

<template>
  <Head :title="__('Our Seller Stores')" />

  <AppLayout>
    <section id="seller-stores" class="py-5">
      <div class="w-[1200px] mx-auto flex flex-col items-start">
        <!-- Cover Photo -->
        <StoreProfileCoverCard />

        <div class="w-full">
          <div
            class="border border-gray-300 bg-white rounded-md px-10 py-4 flex items-center justify-between"
          >
            <nav class="flex space-x-5" aria-label="Tabs" role="tablist">
              <button
                type="button"
                class="hs-tab-active:font-semibold hs-tab-active:border-orange-600 hs-tab-active:text-orange-600 py-4 px-1 inline-flex items-center gap-x-1.5 border-b-2 border-transparent text-sm font-medium whitespace-nowrap text-gray-600 hover:text-orange-600"
                id="tabs-with-icons-item-1"
                data-hs-tab="#tabs-with-icons-1"
                aria-controls="tabs-with-icons-1"
                role="tab"
              >
                <i class="fa-solid fa-home"></i>
                Home
              </button>
              <button
                type="button"
                class="hs-tab-active:font-semibold hs-tab-active:border-orange-600 hs-tab-active:text-orange-600 py-4 px-1 inline-flex items-center gap-x-1.5 border-b-2 border-transparent text-sm font-medium whitespace-nowrap text-gray-600 hover:text-orange-600"
                id="tabs-with-icons-item-2"
                data-hs-tab="#tabs-with-icons-2"
                aria-controls="tabs-with-icons-2"
                role="tab"
              >
                <i class="fa-solid fa-basket-shopping"></i>
                All Products
              </button>
              <button
                type="button"
                class="hs-tab-active:font-semibold hs-tab-active:border-orange-600 hs-tab-active:text-orange-600 py-4 px-1 inline-flex items-center gap-x-1.5 border-b-2 border-transparent text-sm font-medium whitespace-nowrap text-gray-600 hover:text-orange-600"
                id="tabs-with-icons-item-2"
                data-hs-tab="#tabs-with-icons-3"
                aria-controls="tabs-with-icons-3"
                role="tab"
              >
                <i class="fa-solid fa-star"></i>
                Product Rating & Reviews
              </button>
              <button
                type="button"
                class="hs-tab-active:font-semibold hs-tab-active:border-orange-600 hs-tab-active:text-orange-600 py-4 px-1 inline-flex items-center gap-x-1.5 border-b-2 border-transparent text-sm font-medium whitespace-nowrap text-gray-600 hover:text-orange-600"
                id="tabs-with-icons-item-2"
                data-hs-tab="#tabs-with-icons-4"
                aria-controls="tabs-with-icons-4"
                role="tab"
              >
                <i class="fa-solid fa-store"></i>
                Store Profile
              </button>
            </nav>

            <StoreProductSearchBox />
          </div>

          <div class="mt-3">
            <div id="tabs-with-icons-1" role="tabpanel" aria-labelledby="tabs-with-icons-item-1">
              <Home />
            </div>

            <div
              id="tabs-with-icons-2"
              class="hidden"
              role="tabpanel"
              aria-labelledby="tabs-with-icons-item-2"
            >
              <AllProducts />
            </div>

            <div
              id="tabs-with-icons-3"
              class="hidden"
              role="tabpanel"
              aria-labelledby="tabs-with-icons-item-2"
            >
              <ProductRatingAndReviews />
            </div>

            <div
              id="tabs-with-icons-4"
              class="hidden"
              role="tabpanel"
              aria-labelledby="tabs-with-icons-item-2"
            >
              <StoreProfile />
            </div>
          </div>
        </div>
      </div>
    </section>
  </AppLayout>
</template>
