<script setup>
import { useQueryStringParams } from "@/Composables/useQueryStringParams";
import { Link } from "@inertiajs/vue3";

defineProps({
  to: String,

  label: {
    type: String,
    required: true,
  },

  icon: {
    type: String,
    default: "fa-home",
  },
});

const { queryStringParams } = useQueryStringParams();
</script>

<template>
  <nav
    class="flex mb-5 md:mb-0 overflow-x-auto w-full md:max-w-[600px] px-0"
    aria-label="Breadcrumb"
  >
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
      <li class="inline-flex items-center">
        <Link
          :href="route(to)"
          :data="queryStringParams"
          class="inline-flex items-center text-sm font-bold text-blueGray-600 hover:text-blue-600"
        >
          <span class="mr-2.5">
            <i class="fa-solid" :class="icon"></i>
          </span>
          {{ __(label) }}
        </Link>
      </li>
      <slot />
    </ol>
  </nav>
</template>
