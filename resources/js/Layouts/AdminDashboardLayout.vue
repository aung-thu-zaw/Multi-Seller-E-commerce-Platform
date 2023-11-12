<script setup>
import AdminDashboardNavbar from "@/Components/Navbars/AdminDashboardNavbar.vue";
import AdminDashboardSidebar from "@/Components/Sidebars/AdminDashboardSidebar.vue";
</script>

<template>
  <div class="">
    <AdminDashboardSidebar />
    <div class="relative md:ml-64 bg-blueGray-100">
      <AdminDashboardNavbar />
      <slot name="header"></slot>

      <div
        class="px-4 md:px-10 mx-auto w-full"
        :class="{ '-m-24': $page.url === '/admin/dashboard' }"
      >
        <slot />
      </div>
    </div>
  </div>
</template>
