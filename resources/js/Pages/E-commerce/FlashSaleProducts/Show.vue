<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import FlashSaleCountdownTimer from '@/Components/FlashSaleCountdownTimer.vue'
import ProductGridCard from '@/Components/Cards/Products/ProductGridCard.vue'
import { Head, router, usePage } from '@inertiajs/vue3'
import { ref } from 'vue'

const props = defineProps({ flashSale: Object, products: Object })

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
  <Head :title="__('Flash Sale Products')" />

  <AppLayout>
    <section id="flash-sales" class="py-5">
      <div class="w-[1200px] mx-auto flex flex-col items-start">
        <!-- Cover Photo -->
        <div
          class="w-full h-[150px] mb-10 shadow-md rounded-md overflow-hidden flex items-center justify-center flash-sale-background"
        >
          <div class="font-semibold text-white space-y-5">
            <p class="text-center text-2xl">
              {{ __('Flash Sale Products') }}
            </p>

            <FlashSaleCountdownTimer :flashSale="flashSale" />
          </div>
        </div>

        <div v-if="loadProducts?.length">
          <div class="grid grid-cols-5 gap-3 py-3">
            <ProductGridCard v-for="product in loadProducts" :key="product.id" :product="product" />
          </div>

          <div class="my-8 flex items-center justify-center">
            <div
              v-if="products.next_page_url !== null"
              class="my-5 flex items-center justify-center"
            >
              <img
                v-if="isLoading"
                src="../../../assets/images/loading.gif"
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
  </AppLayout>
</template>

<style>
.flash-sale-background {
  background-image: url('https://t3.ftcdn.net/jpg/05/35/13/82/360_F_535138292_62ZnI4Hcw37J8Jaeg4E9TzJwUciCwSnp.jpg');
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
  background-color: rgba(0, 0, 0, 0.5);
  background-blend-mode: overlay;
}
</style>
