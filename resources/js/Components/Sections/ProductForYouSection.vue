<script setup>
import ProductGridCard from '@/Components/Cards/Products/ProductGridCard.vue'
import { router, usePage } from '@inertiajs/vue3'
import { ref } from 'vue'

const props = defineProps({ products: Object })

const isLoading = ref(false)

const loadProducts = ref(props.products.data)

const url = usePage().url

const loadMoreProduct = () => {
  if (props.products.next_page_url === null) {
    return
  }
  isLoading.value = true

  router.get(
    props.products.next_page_url,
    {},
    {
      preserveState: true,
      preserveScroll: true,
      only: ['products'],
      onSuccess: () => {
        isLoading.value = false
        loadProducts.value = [...loadProducts.value, ...props.products.data]
        window.history.replaceState({}, '', url)
      }
    }
  )
}
</script>

<template>
  <section id="product-for-you" class="my-5">
    <div class="max-w-screen-xl mx-auto bg-transparent rounded-md pt-6">
      <!-- Title -->
      <div class="text-gray-700 flex items-center justify-between py-3">
        <h2 class="text-2xl font-bold">
          {{ __('Products For You') }}
        </h2>

        <div class="flex items-center space-x-2">
          <!-- <span
            class="font-bold text-sm bg-orange-500 text-white px-3 py-1.5 rounded-sm transition-all cursor-pointer"
            >New Arrivals</span
          >
          <span
            class="font-bold text-sm text-gray-600 hover:bg-orange-50 px-3 py-1.5 rounded-sm transition-all cursor-pointer"
            >Featured Product</span
          >
          <span
            class="font-bold text-sm text-gray-600 hover:bg-orange-50 px-3 py-1.5 rounded-sm transition-all cursor-pointer"
            >Top Product</span
          > -->
        </div>
      </div>

      <hr class="mb-3" />

      <div v-if="loadProducts.length">
        <div class="grid grid-cols-5 gap-3 py-3">
          <ProductGridCard v-for="product in loadProducts" :key="product.id" :product="product" />
        </div>

        <div class="my-8 flex items-center justify-center">
          <div
            v-if="props.products.next_page_url !== null"
            class="my-5 flex items-center justify-center"
          >
            <img
              v-if="isLoading"
              src="../../assets/images/loading.gif"
              class="w-16 h-16"
              alt="spinner"
            />
            <!-- Load More Button -->
            <button
              v-else
              @click="loadMoreProduct"
              class="border text-sm border-orange-600 px-24 py-3 font-bold text-orange-600 rounded-sm shadow-md bg-orange-600 bg-opacity-0 hover:bg-opacity-100 hover:text-white transition-all"
            >
              {{ __('Load More Product') }}
            </button>
          </div>
          <p v-else class="my-5 text-gray-700 font-bold text-center">
            {{ __('You have reached the end of the page.') }}
          </p>
        </div>
      </div>
      <div v-else>
        <p class="text-center text-red-600 font-semibold">No Products Found!</p>
      </div>
    </div>
  </section>
</template>
