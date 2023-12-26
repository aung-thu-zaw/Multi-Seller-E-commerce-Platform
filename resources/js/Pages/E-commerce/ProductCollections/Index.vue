<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import CollectionCard from '@/Components/Cards/CollectionCard.vue'
import { usePage, router, Head } from '@inertiajs/vue3'
import { ref } from 'vue'

const props = defineProps({ collections: Object })

const isLoading = ref(false)

const loadCollections = ref(props.collections?.data)

const url = usePage().url

const loadMoreCollection = () => {
  if (props.collections.next_page_url === null) {
    return
  }

  isLoading.value = true

  router.get(
    props.collections.next_page_url,
    {},
    {
      preserveState: true,
      preserveScroll: true,
      only: ['collections'],
      onSuccess: () => {
        isLoading.value = false
        loadCollections.value = [...loadCollections.value, ...props.collections.data]
        window.history.replaceState({}, '', url)
      }
    }
  )
}
</script>

<template>
  <AppLayout>
    <Head :title="__('Product Collections')" />

    <section id="seller-stores" class="py-5">
      <div class="w-[1200px] mx-auto">
        <div v-if="loadCollections.length">
          <div class="grid grid-cols-4 gap-3 py-3">
            <!-- Collection Card -->
            <CollectionCard
              v-for="collection in loadCollections"
              :key="collection.id"
              :collection="collection"
            />
          </div>

          <div class="my-8 flex items-center justify-center">
            <div
              v-if="collections.next_page_url !== null"
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
                @click="loadMoreCollection"
                class="border text-sm border-orange-600 px-24 py-3 font-bold text-orange-600 rounded-sm shadow-md bg-orange-600 bg-opacity-0 hover:bg-opacity-100 hover:text-white transition-all"
              >
                {{ __('Load More Collection') }}
              </button>
            </div>
            <p v-else class="my-5 text-gray-700 font-bold text-center">
              {{ __('You have reached the end of the page.') }}
            </p>
          </div>
        </div>

        <div v-else>
          <p class="text-center text-red-600 font-semibold">No Collections Found!</p>
        </div>
      </div>
    </section>
  </AppLayout>
</template>
