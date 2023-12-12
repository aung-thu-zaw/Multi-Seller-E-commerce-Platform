<script setup>
import ProductGridCard from '@/Components/Cards/Products/ProductGridCard.vue'
import ProductSortingSelectBox from '@/Components/Forms/SelectBoxs/ProductSortingSelectBox.vue'
import ProductFilterSidebar from '@/Components/Sidebars/ProductFilterSidebar.vue'
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <AppLayout>
    <section id="all-products" class="">
      <div class="w-full mx-auto flex items-start">
        <ProductFilterSidebar />

        <div class="w-full pl-5">
          <div class="py-1.5 mb-3 flex items-center justify-between border-b">
            <div class="flex items-center space-x-5">
              <h1 class="font-bold text-md text-gray-800">K Mobile Shop</h1>
              <p class="font-bold text-sm text-orange-600">314 items found</p>
            </div>

            <div class="flex items-center space-x-5">
              <ProductSortingSelectBox />

              <div class="">
                <label for="view" class="font-bold text-sm text-gray-600">
                  {{ __('View') }} :
                </label>

                <Link
                  as="button"
                  href="#"
                  class="px-2 py-1 rounded-md cursor-pointer transition-none mr-2 bg-orange-500 text-white hover:bg-orange-600"
                >
                  <i class="fa-solid fa-grip"></i>
                </Link>

                <Link
                  as="button"
                  href="#"
                  class="px-2 py-1 rounded-md cursor-pointer bg-gray-200 text-gray-600 hover:bg-gray-300 transition-none"
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

          <div>
            <!-- Product Grid Card -->
            <div class="grid grid-cols-4 gap-5 w-full">
              <ProductGridCard />
              <ProductGridCard />
              <ProductGridCard />
              <ProductGridCard />
              <ProductGridCard />
              <ProductGridCard />
              <ProductGridCard />
              <ProductGridCard />
              <ProductGridCard />
              <ProductGridCard />
              <ProductGridCard />
            </div>

            <!-- Blog List Card -->
            <!-- <div v-show="params.view === 'list'" class="grid grid-cols-1 gap-5 w-full">
              <BlogListCard
                v-for="blogContent in blogContents.data"
                :key="blogContent.id"
                :blog="blogContent"
              />
            </div> -->

            <!-- Pagination -->
            <div class="my-5 py-5">
              <!-- <Pagination :links="blogContents.links" /> -->
            </div>
          </div>
          <!-- <div v-else class="py-20">
            <p class="text-center font-bold text-md text-red-600">
              <i class="fa-solid fa-file-circle-xmark"></i>
              {{ __("We're sorry we can't find any matches for your filter term.") }}
            </p>
          </div> -->
        </div>
      </div>
    </section>
  </AppLayout>
</template>
