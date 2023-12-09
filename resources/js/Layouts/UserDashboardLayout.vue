<script setup>
import UserDashboardSidebar from '@/Components/Sidebars/UserDashboardSidebar.vue'
import AppLayout from '@/Layouts/AppLayout.vue'
</script>

<template>
  <AppLayout>
    <section id="user-dashboard" class="py-10">
      <div class="w-[1280px] min-h-screen mx-auto flex items-start">
        <UserDashboardSidebar />

        <div class="ms-6 w-full pt-10">
          <slot />
        </div>
      </div>
    </section>
  </AppLayout>
</template>
