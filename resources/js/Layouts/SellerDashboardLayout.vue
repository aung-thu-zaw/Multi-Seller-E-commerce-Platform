<script setup>
import SellerDashboardNavbar from '@/Components/Navbars/SellerDashboardNavbar.vue'
import SellerDashboardSidebar from '@/Components/Sidebars/SellerDashboardSidebar.vue'
</script>

<template>
  <div class="">
    <SellerDashboardSidebar />
    <div class="relative md:ml-64 bg-blueGray-100">
      <SellerDashboardNavbar />
      <slot name="header"></slot>

      <div
        class="px-4 md:px-10 mx-auto w-full"
        :class="{
          '-m-24': $page.url === '/seller/dashboard'
        }"
      >
        <slot />
      </div>
    </div>
  </div>
</template>

<style>
.ck-editor__editable_inline {
  min-height: 250px;
  border-radius: 200px;
}

:root {
  --ck-border-radius: 0.375rem;
  --ck-color-focus-border: rgb(209 213 219);
  --ck-font-size-base: 0.7rem;
  --ck-color-shadow-drop: none;
  --ck-color-shadow-inner: none;
}
</style>
