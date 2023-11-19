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
  <section id="our-brands" class="my-5 bg-white">
    <div
      class="container max-w-screen-xl mx-auto bg-transparent rounded-md px-5 py-3"
    >
      <BrandCarousel />
    </div>
  </section>
</template>
