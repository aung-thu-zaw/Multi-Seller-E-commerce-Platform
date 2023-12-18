<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import StoreProductSearchBox from '@/Components/Forms/SearchBoxs/StoreProductSearchBox.vue'
import StoreProfileCoverCard from '@/Components/Cards/Stores/StoreProfileCoverCard.vue'
import Home from './Partials/Home.vue'
import AllProducts from './Partials/AllProducts.vue'
import ProductRatingAndReviews from './Partials/ProductRatingAndReviews.vue'
import SellerRatingAndReviews from './Partials/SellerRatingAndReviews.vue'
import { Head, Link } from '@inertiajs/vue3'

defineProps({ store: Object, products: Object })
</script>

<template>
  <Head :title="__('Our Seller Stores')" />

  <AppLayout>
    <section id="seller-stores" class="py-5">
      <div class="w-[1300px] mx-auto flex flex-col items-start">
        <!-- Cover Photo -->
        <StoreProfileCoverCard :store="store" />

        <div class="w-full">
          <div
            class="border border-gray-300 bg-white rounded-md px-10 py-4 flex items-center justify-between"
          >
            <nav class="flex space-x-5">
              <Link
                as="button"
                :href="route('stores.show', { store: store?.slug })"
                :data="{ tab: 'home' }"
                preserve-scroll
                class="py-4 px-1 inline-flex items-center gap-x-1.5 text-sm font-medium whitespace-nowrap text-gray-600 hover:text-orange-600"
                :class="{
                  'border-b-2 font-semibold border-orange-600 text-orange-600':
                    $page.props.ziggy.query?.tab === 'home' || !$page.props.ziggy.query?.tab
                }"
              >
                <i class="fa-solid fa-home"></i>
                Home
              </Link>
              <Link
                as="button"
                :href="route('stores.show', { store: store?.slug })"
                :data="{ tab: 'all-products', view: 'grid' }"
                preserve-scroll
                class="py-4 px-1 inline-flex items-center gap-x-1.5 text-sm font-medium whitespace-nowrap text-gray-600 hover:text-orange-600"
                :class="{
                  'border-b-2 font-semibold border-orange-600 text-orange-600':
                    $page.props.ziggy.query?.tab === 'all-products'
                }"
              >
                <i class="fa-solid fa-basket-shopping"></i>
                All Products
              </Link>
              <Link
                as="button"
                :href="route('stores.show', { store: store?.slug })"
                :data="{ tab: 'product-rating-and-reviews' }"
                preserve-scroll
                class="py-4 px-1 inline-flex items-center gap-x-1.5 text-sm font-medium whitespace-nowrap text-gray-600 hover:text-orange-600"
                :class="{
                  'border-b-2 font-semibold border-orange-600 text-orange-600':
                    $page.props.ziggy.query?.tab === 'product-rating-and-reviews'
                }"
              >
                <i class="fa-solid fa-star"></i>
                Product Rating & Reviews
              </Link>
              <Link
                as="button"
                :href="route('stores.show', { store: store?.slug })"
                :data="{ tab: 'store-rating-and-reviews' }"
                preserve-scroll
                class="py-4 px-1 inline-flex items-center gap-x-1.5 text-sm font-medium whitespace-nowrap text-gray-600 hover:text-orange-600"
                :class="{
                  'border-b-2 font-semibold border-orange-600 text-orange-600':
                    $page.props.ziggy.query?.tab === 'store-rating-and-reviews'
                }"
              >
                <i class="fa-solid fa-store"></i>
                Store Rating & Reviews
              </Link>
            </nav>

            <StoreProductSearchBox />
          </div>

          <div class="mt-3">
            <div v-show="$page.props.ziggy.query?.tab === 'home' || !$page.props.ziggy.query?.tab">
              <Home />
            </div>

            <div v-show="$page.props.ziggy.query?.tab === 'all-products'">
              <AllProducts :store="store" :products="products" />
            </div>

            <div v-show="$page.props.ziggy.query?.tab === 'product-rating-and-reviews'">
              <ProductRatingAndReviews />
            </div>

            <div v-show="$page.props.ziggy.query?.tab === 'store-rating-and-reviews'">
              <SellerRatingAndReviews />
            </div>
          </div>
        </div>
      </div>
    </section>
  </AppLayout>
</template>
