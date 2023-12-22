<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({ collection: Object })
</script>

<template>
  <Link
    :href="route('collections.products.show', { collection: collection?.slug })"
    class="border rounded-md p-5 hover:shadow-lg hover:scale-105 bg-white transition-all"
  >
    <div class="flex items-center justify-between">
      <img
        :src="collection?.products[0]?.image"
        alt="product-image"
        class="rounded-md w-16 h-16 object-cover shadow-md"
      />
      <img
        :src="collection?.products[1]?.image"
        alt="product-image"
        class="rounded-md w-16 h-16 object-cover shadow-md"
      />
      <img
        :src="collection?.products[2]?.image"
        alt="product-image"
        class="rounded-md w-16 h-16 object-cover shadow-md"
      />
    </div>

    <h3 class="font-semibold text-md text-gray-600 mt-3 mb-1 text-center">
      {{ collection?.name }}
    </h3>

    <p class="text-xs font-semibold text-center text-gray-400">
      {{ collection?.products_count }} Products
    </p>
  </Link>
</template>
