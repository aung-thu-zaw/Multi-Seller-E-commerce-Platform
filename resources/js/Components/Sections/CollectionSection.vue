<script setup>
import InertiaLinkButton from '@/Components/Buttons/InertiaLinkButton.vue'
import NormalButton from '@/Components/Buttons/NormalButton.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import BrandCarousel from '@/Components/Carousels/BrandCarousel.vue'
import English from '@/assets/images/united-state.png'
import Myanmar from '@/assets/images/myanmar.png'
import { Link } from '@inertiajs/vue3'
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
        <div class="border rounded-md p-5 hover:shadow-lg hover:scale-105 bg-white transition-all">
          <div class="flex items-center justify-between">
            <img
              src="https://images.unsplash.com/photo-1540221652346-e5dd6b50f3e7?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Y2xvdGhlc3xlbnwwfHwwfHx8MA%3D%3D"
              alt=""
              class="rounded-md w-16 h-16 object-cover shadow-md"
            />
            <img
              src="https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTV8fGNsb3RoZXN8ZW58MHx8MHx8fDA%3D"
              alt=""
              class="rounded-md w-16 h-16 object-cover shadow-md"
            />
            <img
              src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c2hvZXN8ZW58MHx8MHx8fDA%3D"
              alt=""
              class="rounded-md w-16 h-16 object-cover shadow-md"
            />
          </div>

          <h3 class="font-semibold text-md text-gray-600 mt-3 mb-1 text-center">
            All in One Solution
          </h3>

          <p class="text-xs font-semibold text-center text-gray-400">50 Products</p>
        </div>
        <!-- Collection Card -->
        <div class="border rounded-md p-5 hover:shadow-lg hover:scale-105 bg-white transition-all">
          <div class="flex items-center justify-between">
            <img
              src="https://images.unsplash.com/photo-1540221652346-e5dd6b50f3e7?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Y2xvdGhlc3xlbnwwfHwwfHx8MA%3D%3D"
              alt=""
              class="rounded-md w-16 h-16 object-cover shadow-md"
            />
            <img
              src="https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTV8fGNsb3RoZXN8ZW58MHx8MHx8fDA%3D"
              alt=""
              class="rounded-md w-16 h-16 object-cover shadow-md"
            />
            <img
              src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c2hvZXN8ZW58MHx8MHx8fDA%3D"
              alt=""
              class="rounded-md w-16 h-16 object-cover shadow-md"
            />
          </div>

          <h3 class="font-semibold text-md text-gray-600 mt-3 mb-1 text-center">
            All in One Solution
          </h3>

          <p class="text-xs font-semibold text-center text-gray-400">50 Products</p>
        </div>
        <!-- Collection Card -->
        <div class="border rounded-md p-5 hover:shadow-lg hover:scale-105 bg-white transition-all">
          <div class="flex items-center justify-between">
            <img
              src="https://images.unsplash.com/photo-1540221652346-e5dd6b50f3e7?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Y2xvdGhlc3xlbnwwfHwwfHx8MA%3D%3D"
              alt=""
              class="rounded-md w-16 h-16 object-cover shadow-md"
            />
            <img
              src="https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTV8fGNsb3RoZXN8ZW58MHx8MHx8fDA%3D"
              alt=""
              class="rounded-md w-16 h-16 object-cover shadow-md"
            />
            <img
              src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c2hvZXN8ZW58MHx8MHx8fDA%3D"
              alt=""
              class="rounded-md w-16 h-16 object-cover shadow-md"
            />
          </div>

          <h3 class="font-semibold text-md text-gray-600 mt-3 mb-1 text-center">
            All in One Solution
          </h3>

          <p class="text-xs font-semibold text-center text-gray-400">50 Products</p>
        </div>
        <!-- Collection Card -->
        <div class="border rounded-md p-5 hover:shadow-lg hover:scale-105 bg-white transition-all">
          <div class="flex items-center justify-between">
            <img
              src="https://images.unsplash.com/photo-1540221652346-e5dd6b50f3e7?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Y2xvdGhlc3xlbnwwfHwwfHx8MA%3D%3D"
              alt=""
              class="rounded-md w-16 h-16 object-cover shadow-md"
            />
            <img
              src="https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTV8fGNsb3RoZXN8ZW58MHx8MHx8fDA%3D"
              alt=""
              class="rounded-md w-16 h-16 object-cover shadow-md"
            />
            <img
              src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c2hvZXN8ZW58MHx8MHx8fDA%3D"
              alt=""
              class="rounded-md w-16 h-16 object-cover shadow-md"
            />
          </div>

          <h3 class="font-semibold text-md text-gray-600 mt-3 mb-1 text-center">
            All in One Solution
          </h3>

          <p class="text-xs font-semibold text-center text-gray-400">50 Products</p>
        </div>
        <!-- Collection Card -->
        <div class="border rounded-md p-5 hover:shadow-lg hover:scale-105 bg-white transition-all">
          <div class="flex items-center justify-between">
            <img
              src="https://images.unsplash.com/photo-1540221652346-e5dd6b50f3e7?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Y2xvdGhlc3xlbnwwfHwwfHx8MA%3D%3D"
              alt=""
              class="rounded-md w-16 h-16 object-cover shadow-md"
            />
            <img
              src="https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTV8fGNsb3RoZXN8ZW58MHx8MHx8fDA%3D"
              alt=""
              class="rounded-md w-16 h-16 object-cover shadow-md"
            />
            <img
              src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c2hvZXN8ZW58MHx8MHx8fDA%3D"
              alt=""
              class="rounded-md w-16 h-16 object-cover shadow-md"
            />
          </div>

          <h3 class="font-semibold text-md text-gray-600 mt-3 mb-1 text-center">
            All in One Solution
          </h3>

          <p class="text-xs font-semibold text-center text-gray-400">50 Products</p>
        </div>
        <!-- Collection Card -->
        <div class="border rounded-md p-5 hover:shadow-lg hover:scale-105 bg-white transition-all">
          <div class="flex items-center justify-between">
            <img
              src="https://images.unsplash.com/photo-1540221652346-e5dd6b50f3e7?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Y2xvdGhlc3xlbnwwfHwwfHx8MA%3D%3D"
              alt=""
              class="rounded-md w-16 h-16 object-cover shadow-md"
            />
            <img
              src="https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTV8fGNsb3RoZXN8ZW58MHx8MHx8fDA%3D"
              alt=""
              class="rounded-md w-16 h-16 object-cover shadow-md"
            />
            <img
              src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c2hvZXN8ZW58MHx8MHx8fDA%3D"
              alt=""
              class="rounded-md w-16 h-16 object-cover shadow-md"
            />
          </div>

          <h3 class="font-semibold text-md text-gray-600 mt-3 mb-1 text-center">
            All in One Solution
          </h3>

          <p class="text-xs font-semibold text-center text-gray-400">50 Products</p>
        </div>
        <!-- Collection Card -->
        <div class="border rounded-md p-5 hover:shadow-lg hover:scale-105 bg-white transition-all">
          <div class="flex items-center justify-between">
            <img
              src="https://images.unsplash.com/photo-1540221652346-e5dd6b50f3e7?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Y2xvdGhlc3xlbnwwfHwwfHx8MA%3D%3D"
              alt=""
              class="rounded-md w-16 h-16 object-cover shadow-md"
            />
            <img
              src="https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTV8fGNsb3RoZXN8ZW58MHx8MHx8fDA%3D"
              alt=""
              class="rounded-md w-16 h-16 object-cover shadow-md"
            />
            <img
              src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c2hvZXN8ZW58MHx8MHx8fDA%3D"
              alt=""
              class="rounded-md w-16 h-16 object-cover shadow-md"
            />
          </div>

          <h3 class="font-semibold text-md text-gray-600 mt-3 mb-1 text-center">
            All in One Solution
          </h3>

          <p class="text-xs font-semibold text-center text-gray-400">50 Products</p>
        </div>
        <!-- Collection Card -->
        <div class="border rounded-md p-5 hover:shadow-lg hover:scale-105 bg-white transition-all">
          <div class="flex items-center justify-between">
            <img
              src="https://images.unsplash.com/photo-1540221652346-e5dd6b50f3e7?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Y2xvdGhlc3xlbnwwfHwwfHx8MA%3D%3D"
              alt=""
              class="rounded-md w-16 h-16 object-cover shadow-md"
            />
            <img
              src="https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTV8fGNsb3RoZXN8ZW58MHx8MHx8fDA%3D"
              alt=""
              class="rounded-md w-16 h-16 object-cover shadow-md"
            />
            <img
              src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c2hvZXN8ZW58MHx8MHx8fDA%3D"
              alt=""
              class="rounded-md w-16 h-16 object-cover shadow-md"
            />
          </div>

          <h3 class="font-semibold text-md text-gray-600 mt-3 mb-1 text-center">
            All in One Solution
          </h3>

          <p class="text-xs font-semibold text-center text-gray-400">50 Products</p>
        </div>
        <!-- Collection Card -->
        <div class="border rounded-md p-5 hover:shadow-lg hover:scale-105 bg-white transition-all">
          <div class="flex items-center justify-between">
            <img
              src="https://images.unsplash.com/photo-1540221652346-e5dd6b50f3e7?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Y2xvdGhlc3xlbnwwfHwwfHx8MA%3D%3D"
              alt=""
              class="rounded-md w-16 h-16 object-cover shadow-md"
            />
            <img
              src="https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTV8fGNsb3RoZXN8ZW58MHx8MHx8fDA%3D"
              alt=""
              class="rounded-md w-16 h-16 object-cover shadow-md"
            />
            <img
              src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c2hvZXN8ZW58MHx8MHx8fDA%3D"
              alt=""
              class="rounded-md w-16 h-16 object-cover shadow-md"
            />
          </div>

          <h3 class="font-semibold text-md text-gray-600 mt-3 mb-1 text-center">
            All in One Solution
          </h3>

          <p class="text-xs font-semibold text-center text-gray-400">50 Products</p>
        </div>
        <!-- Collection Card -->
        <div class="border rounded-md p-5 hover:shadow-lg hover:scale-105 bg-white transition-all">
          <div class="flex items-center justify-between">
            <img
              src="https://images.unsplash.com/photo-1540221652346-e5dd6b50f3e7?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Y2xvdGhlc3xlbnwwfHwwfHx8MA%3D%3D"
              alt=""
              class="rounded-md w-16 h-16 object-cover shadow-md"
            />
            <img
              src="https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTV8fGNsb3RoZXN8ZW58MHx8MHx8fDA%3D"
              alt=""
              class="rounded-md w-16 h-16 object-cover shadow-md"
            />
            <img
              src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c2hvZXN8ZW58MHx8MHx8fDA%3D"
              alt=""
              class="rounded-md w-16 h-16 object-cover shadow-md"
            />
          </div>

          <h3 class="font-semibold text-md text-gray-600 mt-3 mb-1 text-center">
            All in One Solution
          </h3>

          <p class="text-xs font-semibold text-center text-gray-400">50 Products</p>
        </div>
        <!-- Collection Card -->
        <div class="border rounded-md p-5 hover:shadow-lg hover:scale-105 bg-white transition-all">
          <div class="flex items-center justify-between">
            <img
              src="https://images.unsplash.com/photo-1540221652346-e5dd6b50f3e7?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Y2xvdGhlc3xlbnwwfHwwfHx8MA%3D%3D"
              alt=""
              class="rounded-md w-16 h-16 object-cover shadow-md"
            />
            <img
              src="https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTV8fGNsb3RoZXN8ZW58MHx8MHx8fDA%3D"
              alt=""
              class="rounded-md w-16 h-16 object-cover shadow-md"
            />
            <img
              src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c2hvZXN8ZW58MHx8MHx8fDA%3D"
              alt=""
              class="rounded-md w-16 h-16 object-cover shadow-md"
            />
          </div>

          <h3 class="font-semibold text-md text-gray-600 mt-3 mb-1 text-center">
            All in One Solution
          </h3>

          <p class="text-xs font-semibold text-center text-gray-400">50 Products</p>
        </div>
        <!-- Collection Card -->
        <div class="border rounded-md p-5 hover:shadow-lg hover:scale-105 bg-white transition-all">
          <div class="flex items-center justify-between">
            <img
              src="https://images.unsplash.com/photo-1540221652346-e5dd6b50f3e7?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Y2xvdGhlc3xlbnwwfHwwfHx8MA%3D%3D"
              alt=""
              class="rounded-md w-16 h-16 object-cover shadow-md"
            />
            <img
              src="https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTV8fGNsb3RoZXN8ZW58MHx8MHx8fDA%3D"
              alt=""
              class="rounded-md w-16 h-16 object-cover shadow-md"
            />
            <img
              src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c2hvZXN8ZW58MHx8MHx8fDA%3D"
              alt=""
              class="rounded-md w-16 h-16 object-cover shadow-md"
            />
          </div>

          <h3 class="font-semibold text-md text-gray-600 mt-3 mb-1 text-center">
            All in One Solution
          </h3>

          <p class="text-xs font-semibold text-center text-gray-400">50 Products</p>
        </div>
      </div>
    </div>
  </section>
</template>
