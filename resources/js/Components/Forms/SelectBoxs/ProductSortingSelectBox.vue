<script setup>
import { router, usePage } from '@inertiajs/vue3'
import { ref, watch } from 'vue'

const props = defineProps({
  to: {
    type: String,
    required: true
  }
})

const sort = ref(usePage().props.ziggy.query?.sort)

watch(
  () => sort.value,
  () => {
    router.get(
      route(props.to),
      {
        search: usePage().props.ziggy.query.search,
        sort: sort.value,
        page: usePage().props.ziggy.query.page,
        category: usePage().props.ziggy.query.category,
        brand: usePage().props.ziggy.query.brand,
        rating: usePage().props.ziggy.query.rating,
        price: usePage().props.ziggy.query.price,
        view: usePage().props.ziggy.query.view || 'grid'
      },
      {
        replace: true,
        preserveState: true
      }
    )
  }
)
</script>

<template>
  <div>
    <label for="sort-by" class="font-bold text-sm text-gray-600"> {{ __('Sort By') }} : </label>
    <select
      id="product-sort-by"
      class="w-[175px] p-3.5 font-medium text-sm text-gray-500 border border-gray-300 rounded-lg bg-gray-50 focus:ring-2 focus:ring-orange-300 focus:border-orange-400"
      v-model="sort"
    >
      <option value="newest_arrivals">
        {{ __('Newest Arrivals') }}
      </option>
      <option value="price_low_to_high">
        {{ __('Price Low To High') }}
      </option>
      <option value="price_high_to_low">
        {{ __('Price High To Low') }}
      </option>
    </select>
  </div>
</template>
