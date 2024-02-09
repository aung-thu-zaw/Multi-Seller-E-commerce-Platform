<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import Breadcrumb from '@/Components/Breadcrumbs/Breadcrumb.vue'
import BreadcrumbLinkItem from '@/Components/Breadcrumbs/BreadcrumbLinkItem.vue'
import BreadcrumbItem from '@/Components/Breadcrumbs/BreadcrumbItem.vue'
import ProductGridCard from '@/Components/Cards/Products/ProductGridCard.vue'
import ProductListCard from '@/Components/Cards/Products/ProductListCard.vue'
import ProductSortingSelectBox from '@/Components/Forms/SelectBoxs/ProductSortingSelectBox.vue'
import ProductFilterSidebar from '@/Components/Sidebars/ProductFilterSidebar.vue'
import Pagination from '@/Components/Paginations/Pagination.vue'
import { Link, Head, usePage, router } from '@inertiajs/vue3'
import { computed } from 'vue'

const props = defineProps({
  category: Object,
  products: Object,
  categories: Object,
  brands: Object
})

const params = computed(() => {
  return {
    search: usePage().props.ziggy.query?.search,
    category: usePage().props.ziggy.query?.category,
    brand: usePage().props.ziggy.query?.brand,
    sort: usePage().props.ziggy.query?.sort,
    page: usePage().props.ziggy.query?.page,
    rating: usePage().props.ziggy.query?.rating,
    price: usePage().props.ziggy.query?.price,
    view: usePage().props.ziggy.query?.view
  }
})

const formattedBrandQuery = computed(() =>
  usePage().props.ziggy.query?.brand ? usePage().props.ziggy.query.brand.split('--') : []
)

const handleRemoveBrand = (brand) => {
  formattedBrandQuery.value.splice(brand, 1)
  params.value.brand = formattedBrandQuery.value.join('--')

  router.get(route('products.category', { category: props.category?.slug }), {
    search: params.value.search,
    sort: params.value.sort,
    page: params.value.page,
    category: params.value.category,
    brand: params.value.brand !== '' ? params.value.brand : undefined,
    rating: params.value.rating,
    price: params.value.price,
    view: params.value.view
  })
}
</script>

<template>
  <Head :title="category?.name" />
  <AppLayout>
    <section id="all-products" class="">
      <div class="w-[1280px] mx-auto flex flex-col items-start py-10">
        <div class="mb-5 border-b w-full pb-8">
          <Breadcrumb to="home" icon="fa-home" label="Home">
            <BreadcrumbLinkItem
              v-if="category.parent?.parent?.parent?.parent"
              to="products.category"
              :targetIdentifier="{ category: category.parent.parent.parent.parent.slug }"
              :data="{
                sort: params.sort,
                view: params.view
              }"
              :label="category.parent.parent.parent.parent.name"
            />
            <BreadcrumbLinkItem
              v-if="category.parent?.parent?.parent"
              to="products.category"
              :targetIdentifier="{ category: category.parent.parent.parent.slug }"
              :data="{
                sort: params.sort,
                view: params.view
              }"
              :label="category.parent.parent.parent.name"
            />
            <BreadcrumbLinkItem
              v-if="category.parent?.parent"
              to="products.category"
              :targetIdentifier="{ category: category.parent.parent.slug }"
              :data="{
                sort: params.sort,
                view: params.view
              }"
              :label="category.parent.parent.name"
            />
            <BreadcrumbLinkItem
              v-if="category.parent"
              to="products.category"
              :targetIdentifier="{ category: category.parent.slug }"
              :data="{
                sort: params.sort,
                view: params.view
              }"
              :label="category.parent.name"
            />
            <BreadcrumbItem v-if="category" :label="category.name" />
          </Breadcrumb>
        </div>

        <div class="w-[1280px] mx-auto flex items-start">
          <ProductFilterSidebar
            to="products.category"
            :targetIdentifier="{ category: category?.slug }"
            :categories="categories"
            :brands="brands"
          />

          <div class="w-full pl-5">
            <div class="py-1.5 mb-3 flex items-center justify-between border-b">
              <div class="flex items-center space-x-5">
                <p class="font-bold text-sm text-gray-600">{{ products.total }} items found</p>
              </div>

              <div class="flex items-center space-x-5">
                <ProductSortingSelectBox
                  to="products.category"
                  :targetIdentifier="{ category: category?.slug }"
                />

                <div class="">
                  <label for="view" class="font-bold text-sm text-gray-600">
                    {{ __('View') }} :
                  </label>

                  <Link
                    as="button"
                    :href="route('products.category', { category: category?.slug })"
                    :data="{
                      search: params?.search,
                      category: params?.category,
                      brand: params?.brand,
                      sort: params?.sort,
                      page: params?.page,
                      rating: params?.rating,
                      price: params?.price,
                      view: 'grid'
                    }"
                    class="px-2 py-1 rounded-md cursor-pointer transition-none mr-2"
                    :class="{
                      'bg-orange-500 text-white hover:bg-orange-600': params?.view === 'grid',
                      'bg-gray-200 text-gray-600 hover:bg-gray-300': params?.view !== 'grid'
                    }"
                  >
                    <i class="fa-solid fa-grip"></i>
                  </Link>

                  <Link
                    :href="route('products.category', { category: category?.slug })"
                    :data="{
                      search: params?.search,
                      category: params?.category,
                      brand: params?.brand,
                      sort: params?.sort,
                      page: params?.page,
                      rating: params?.rating,
                      price: params?.price,
                      view: 'list'
                    }"
                    class="px-2 py-1 rounded-md cursor-pointer transition-none"
                    :class="{
                      'bg-orange-500 text-white hover:bg-orange-600': params?.view === 'list',
                      'bg-gray-200 text-gray-600 hover:bg-gray-300': params?.view !== 'list'
                    }"
                  >
                    <i class="fa-solid fa-list"></i>
                  </Link>
                </div>
              </div>
            </div>

            <!-- Filtered By -->
            <div
              v-if="params?.category || params?.brand || params?.rating || params?.price"
              class="my-5 px-2 flex items-center"
            >
              <div class="flex items-center">
                <p class="font-bold text-blueGray-700 text-sm mr-1">{{ __('Filtered By') }} :</p>

                <div class="flex items-center space-x-3">
                  <div
                    v-show="params?.category"
                    class="inline-flex flex-nowrap items-center bg-white border border-gray-200 rounded-full px-2 py-1.5"
                  >
                    <div class="whitespace-nowrap text-xs font-bold text-gray-700 capitalize">
                      {{ __('Category') }} : {{ params?.category }}
                    </div>
                    <Link
                      as="button"
                      :href="route('products.category', { category: category?.slug })"
                      :data="{
                        search: params.search,
                        sort: params.sort,
                        page: params.page,
                        brand: params.brand,
                        rating: params.rating,
                        price: params.price,
                        view: params.view
                      }"
                      class="ms-2.5 inline-flex justify-center items-center h-2 w-2 rounded-full text-gray-600 text-xs hover:text-red-600 transition-all cursor-pointer"
                    >
                      <i class="fa-solid fa-circle-xmark"></i>
                    </Link>
                  </div>

                  <div
                    v-show="params?.brand"
                    v-for="(brand, index) in formattedBrandQuery"
                    :key="index"
                    class="inline-flex flex-nowrap items-center bg-white border border-gray-200 rounded-full px-2 py-1.5"
                  >
                    <div class="whitespace-nowrap text-xs font-bold text-gray-700 capitalize">
                      {{ __('Brand') }} : {{ brand }}
                    </div>
                    <button
                      @click="handleRemoveBrand"
                      type="button"
                      class="ms-2.5 inline-flex justify-center items-center h-2 w-2 rounded-full text-gray-600 text-xs hover:text-red-600 transition-all cursor-pointer"
                    >
                      <i class="fa-solid fa-circle-xmark"></i>
                    </button>
                  </div>

                  <div
                    v-show="params?.price"
                    class="inline-flex flex-nowrap items-center bg-white border border-gray-200 rounded-full px-2 py-1.5"
                  >
                    <div class="whitespace-nowrap text-xs font-bold text-gray-700 capitalize">
                      {{ __('Price') }} : {{ params?.price }}
                    </div>
                    <Link
                      as="button"
                      :href="route('products.category', { category: category?.slug })"
                      :data="{
                        search: params.search,
                        sort: params.sort,
                        page: params.page,
                        category: params.category,
                        brand: params.brand,
                        rating: params.rating,
                        view: params.view
                      }"
                      class="ms-2.5 inline-flex justify-center items-center h-2 w-2 rounded-full text-gray-600 text-xs hover:text-red-600 transition-all cursor-pointer"
                    >
                      <i class="fa-solid fa-circle-xmark"></i>
                    </Link>
                  </div>

                  <div
                    v-show="params?.rating"
                    class="inline-flex flex-nowrap items-center bg-white border border-gray-200 rounded-full px-2 py-1.5"
                  >
                    <div class="whitespace-nowrap text-xs font-bold text-gray-700 capitalize">
                      {{ __('Rating') }} : {{ params?.rating }}
                      {{ params.rating < 5 ? 'star and up' : 'stars' }}
                    </div>
                    <Link
                      as="button"
                      :href="route('products.category', { category: category?.slug })"
                      :data="{
                        search: params.search,
                        sort: params.sort,
                        page: params.page,
                        category: params.category,
                        brand: params.brand,
                        price: params.price,
                        view: params.view
                      }"
                      class="ms-2.5 inline-flex justify-center items-center h-2 w-2 rounded-full text-gray-600 text-xs hover:text-red-600 transition-all cursor-pointer"
                    >
                      <i class="fa-solid fa-circle-xmark"></i>
                    </Link>
                  </div>
                </div>
              </div>
            </div>

            <div v-if="products.data.length">
              <!-- Product Grid Card -->
              <div v-show="params?.view === 'grid'" class="grid grid-cols-4 gap-5 w-full">
                <ProductGridCard
                  v-for="product in products.data"
                  :key="product.id"
                  :product="product"
                />
              </div>

              <!-- Product List Card -->
              <div v-show="params?.view === 'list'" class="grid grid-cols-1 gap-5 w-full">
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
      </div>
    </section>
  </AppLayout>
</template>
