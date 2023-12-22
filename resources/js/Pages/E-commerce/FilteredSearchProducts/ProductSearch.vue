<script setup>
import ProductGridCard from '@/Components/Cards/Products/ProductGridCard.vue'
import ProductListCard from '@/Components/Cards/Products/ProductListCard.vue'
import ProductSortingSelectBox from '@/Components/Forms/SelectBoxs/ProductSortingSelectBox.vue'
import ProductFilterSidebar from '@/Components/Sidebars/ProductFilterSidebar.vue'
import Pagination from '@/Components/Paginations/Pagination.vue'
import { Link } from '@inertiajs/vue3'

defineProps({ products: Object })
</script>

<template>
  <AppLayout>
    <section id="all-products" class="">
      <div class="w-full mx-auto flex items-start">
        <ProductFilterSidebar />

        <div class="w-full pl-5">
          <div class="py-1.5 mb-3 flex items-center justify-between border-b">
            <div class="flex items-center space-x-5">
              <p class="font-bold text-sm text-orange-600">{{ products.total }} items found</p>
            </div>

            <div class="flex items-center space-x-5">
              <ProductSortingSelectBox />

              <div class="">
                <label for="view" class="font-bold text-sm text-gray-600">
                  {{ __('View') }} :
                </label>

                <Link
                  as="button"
                  :data="{
                    search: $page.props.ziggy.query?.search,
                    tab: $page.props.ziggy.query?.tab,
                    category: $page.props.ziggy.query?.category,
                    brand: $page.props.ziggy.query?.brand,
                    sort: $page.props.ziggy.query?.sort,
                    direction: $page.props.ziggy.query?.direction,
                    page: $page.props.ziggy.query?.page,
                    rating: $page.props.ziggy.query?.rating,
                    price: $page.props.ziggy.query?.price,
                    view: 'grid'
                  }"
                  class="px-2 py-1 rounded-md cursor-pointer transition-none mr-2"
                  :class="{
                    'bg-orange-500 text-white hover:bg-orange-600':
                      $page.props.ziggy.query?.view === 'grid',
                    'bg-gray-200 text-gray-600 hover:bg-gray-300':
                      $page.props.ziggy.query?.view !== 'grid'
                  }"
                >
                  <i class="fa-solid fa-grip"></i>
                </Link>

                <Link
                  as="button"
                  :data="{
                    search: $page.props.ziggy.query?.search,
                    tab: $page.props.ziggy.query?.tab,
                    category: $page.props.ziggy.query?.category,
                    brand: $page.props.ziggy.query?.brand,
                    sort: $page.props.ziggy.query?.sort,
                    direction: $page.props.ziggy.query?.direction,
                    page: $page.props.ziggy.query?.page,
                    rating: $page.props.ziggy.query?.rating,
                    price: $page.props.ziggy.query?.price,
                    view: 'list'
                  }"
                  class="px-2 py-1 rounded-md cursor-pointer transition-none"
                  :class="{
                    'bg-orange-500 text-white hover:bg-orange-600':
                      $page.props.ziggy.query?.view === 'list',
                    'bg-gray-200 text-gray-600 hover:bg-gray-300':
                      $page.props.ziggy.query?.view !== 'list'
                  }"
                >
                  <i class="fa-solid fa-list"></i>
                </Link>
              </div>
            </div>
          </div>

          <!-- Filtered By -->
          <div class="my-5 px-2 flex items-center">
            <div class="flex items-center">
              <p class="font-bold text-blueGray-700 text-sm mr-1">{{ __('Filtered By') }} :</p>

              <div class="flex items-center space-x-3">
                <div
                  class="inline-flex flex-nowrap items-center bg-white border border-gray-200 rounded-full px-2 py-1.5"
                >
                  <div class="whitespace-nowrap text-xs font-bold text-gray-700 capitalize">
                    {{ __('Category') }} : Makeup
                  </div>
                  <Link
                    as="button"
                    class="ms-2.5 inline-flex justify-center items-center h-2 w-2 rounded-full text-gray-600 text-xs hover:text-red-600 transition-all cursor-pointer"
                  >
                    <i class="fa-solid fa-circle-xmark"></i>
                  </Link>
                </div>

                <div
                  class="inline-flex flex-nowrap items-center bg-white border border-gray-200 rounded-full px-2 py-1.5"
                >
                  <div class="whitespace-nowrap text-xs font-bold text-gray-700 capitalize">
                    {{ __('Brand') }} : Samsung
                  </div>
                  <Link
                    as="button"
                    class="ms-2.5 inline-flex justify-center items-center h-2 w-2 rounded-full text-gray-600 text-xs hover:text-red-600 transition-all cursor-pointer"
                  >
                    <i class="fa-solid fa-circle-xmark"></i>
                  </Link>
                </div>
              </div>
            </div>

            <!-- <p v-show="params.search_blog" class="text-sm font-medium text-gray-700 ml-auto">
              {{
                __(':total post(s) found for search result :result', {
                  total: blogContents.total,
                  result: '"' + params.search_blog + '"'
                })
              }}
            </p> -->
          </div>

          <div v-if="products.data.length">
            <!-- Product Grid Card -->
            <div
              v-show="$page.props.ziggy.query?.view === 'grid'"
              class="grid grid-cols-4 gap-5 w-full"
            >
              <ProductGridCard
                v-for="product in products.data"
                :key="product.id"
                :product="product"
              />
            </div>

            <!-- Blog List Card -->
            <div
              v-show="$page.props.ziggy.query?.view === 'list'"
              class="grid grid-cols-1 gap-5 w-full"
            >
              <ProductListCard
                v-for="product in products.data"
                :key="product.id"
                :product="product"
              />
            </div>

            <!-- Pagination -->
            <div class="my-5 py-5">
              <Pagination :links="products.links" />
            </div>
          </div>
          <div v-else class="py-20">
            <p class="text-center font-bold text-md text-red-600">
              <i class="fa-solid fa-file-circle-xmark"></i>
              {{ __("We're sorry we can't find any matches for your filter term.") }}
            </p>
          </div>
        </div>
      </div>
    </section>
  </AppLayout>
</template>
