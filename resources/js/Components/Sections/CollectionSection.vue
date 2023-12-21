<script setup>
import CollectionCard from '@/Components/Cards/CollectionCard.vue'
defineProps({ collections: Object })
</script>

<template>
  <section id="collections" class="my-5">
    <div class="container max-w-screen-xl mx-auto bg-transparent rounded-md py-6">
      <!-- Title -->
      <div class="text-slate-600 flex items-center justify-between py-3">
        <h2 class="text-2xl font-bold">
          {{ __('Collections') }}
        </h2>

        <Link
          href="#"
          class="font-bold text-sm rounded-full px-4 py-2 text-orange-600 border border-orange-600 hover:bg-orange-600 hover:text-white transition-all"
        >
          {{ __('See More') }}
          <i class="fa-solid fa-angles-right ml-1"></i>
        </Link>
      </div>

      <div class="grid grid-cols-4 gap-3 py-3">
        <!-- Collection Card -->
        <CollectionCard
          v-for="collection in collections"
          :key="collection.id"
          :collection="collection"
        />
      </div>
    </div>
  </section>
</template>
