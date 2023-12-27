<script setup>
import { computed, reactive, ref } from 'vue'

const props = defineProps({ product: Object })

const images = reactive([props.product.image])

props.product.product_images.forEach((image) => images.push(image.image))

const activeImageIndex = ref(0)

const activeImage = computed(() => images[activeImageIndex.value])
</script>

<template>
  <div>
    <div class="text-center rounded mb-5">
      <img
        class="object-cover inline-block w-[500px] h-full"
        :src="activeImage"
        alt="product-name"
      />
    </div>

    <div class="space-x-2 overflow-auto whitespace-nowrap p-3">
      <div
        v-for="(image, index) in images"
        :key="image.id"
        class="inline-block border border-gray-400 p-0.5 rounded-sm hover:border-orange-500"
        :class="{ 'border-orange-500 ring-2 ring-orange-300': activeImageIndex === index }"
        @click="activeImageIndex = index"
      >
        <img class="w-14 h-14 rounded-sm" :src="image" :alt="product.name" />
      </div>
    </div>
  </div>
</template>
