<script setup>
import InertiaLinkButton from "@/Components/Buttons/InertiaLinkButton.vue";
import NormalButton from "@/Components/Buttons/NormalButton.vue";
import InputField from "@/Components/Forms/Fields/InputField.vue";
import InputLabel from "@/Components/Forms/Fields/InputLabel.vue";
import BrandCarousel from "@/Components/Carousels/BrandCarousel.vue";
import English from "@/assets/images/united-state.png";
import Myanmar from "@/assets/images/myanmar.png";
import { Link } from "@inertiajs/vue3";
</script>

<template>
  <section id="why-choose-us" class="bg-white py-12">
    <div class="container max-w-screen-xl mx-auto px-4">
      <h2 class="text-3xl font-bold mb-8">{{ __("Why Choose Us") }}</h2>

      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        <div>
          <figure class="flex mb-4">
            <div class="flex-shrink-0 mr-3">
              <span
                class="w-16 h-16 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center"
              >
                <i class="fa fa-money-bill text-2xl"></i>
              </span>
            </div>
            <figcaption>
              <h5 class="font-semibold">Reasonable prices</h5>
              <p class="text-gray-500">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
              </p>
            </figcaption>
          </figure>
        </div>
        <div>
          <figure class="flex mb-4">
            <div class="flex-shrink-0 mr-3">
              <span
                class="w-16 h-16 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center"
              >
                <i class="fa fa-star text-2xl"></i>
              </span>
            </div>
            <figcaption>
              <h5 class="font-semibold">Best quality</h5>
              <p class="text-gray-500">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
              </p>
            </figcaption>
          </figure>
        </div>
        <div>
          <figure class="flex mb-4">
            <div class="flex-shrink-0 mr-3">
              <span
                class="w-16 h-16 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center"
              >
                <i class="fa fa-plane text-2xl"></i>
              </span>
            </div>
            <figcaption>
              <h5 class="font-semibold">Worldwide shipping</h5>
              <p class="text-gray-500">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
              </p>
            </figcaption>
          </figure>
        </div>
        <div>
          <figure class="flex mb-4">
            <div class="flex-shrink-0 mr-3">
              <span
                class="w-16 h-16 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center"
              >
                <i class="fa fa-users text-2xl"></i>
              </span>
            </div>
            <figcaption>
              <h5 class="font-semibold">Customer satisfaction</h5>
              <p class="text-gray-500">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
              </p>
            </figcaption>
          </figure>
        </div>
        <div>
          <figure class="flex mb-4">
            <div class="flex-shrink-0 mr-3">
              <span
                class="w-16 h-16 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center"
              >
                <i class="fa fa-thumbs-up text-2xl"></i>
              </span>
            </div>
            <figcaption>
              <h5 class="font-semibold">Happy customers</h5>
              <p class="text-gray-500">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
              </p>
            </figcaption>
          </figure>
        </div>
        <div>
          <figure class="flex mb-4">
            <div class="flex-shrink-0 mr-3">
              <span
                class="w-16 h-16 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center"
              >
                <i class="fa fa-box text-2xl"></i>
              </span>
            </div>
            <figcaption>
              <h5 class="font-semibold">Thousand items</h5>
              <p class="text-gray-500">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
              </p>
            </figcaption>
          </figure>
        </div>
      </div>
    </div>
  </section>
</template>
