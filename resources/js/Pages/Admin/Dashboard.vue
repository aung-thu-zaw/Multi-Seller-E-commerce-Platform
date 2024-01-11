<script setup>
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue'
import DashboardHeaderStats from '@/Components/Headers/AdminDashboardHeaderStats.vue'
import TotalSaleLineChart from '@/Components/Charts/TotalSaleLineChart.vue'
import TotalOrderBarChart from '@/Components/Charts/TotalOrderBarChart.vue'
import TotalUserBarChart from '@/Components/Charts/TotalUserBarChart.vue'
import { Head } from '@inertiajs/vue3'

defineProps({
  totalUsers: Object,
  totalOrders: Object,
  totalSales: Object,
  todayEarnings: Object,
  percentageChangeUsers: Object,
  percentageChangeOrders: Object,
  percentageChangeSales: Object,
  percentageChangeTodayEarnings: Object,
  thisYearMonthlyUserLabels: Object,
  thisYearMonthlyUserData: Object,
  lastYearMonthlyUserLabels: Object,
  lastYearMonthlyUserData: Object,
  thisYearMonthlyOrderLabels: Object,
  thisYearMonthlyOrderData: Object,
  lastYearMonthlyOrderLabels: Object,
  lastYearMonthlyOrderData: Object,
  thisYearMonthlySaleLabels: Object,
  thisYearMonthlySaleData: Object,
  lastYearMonthlySaleLabels: Object,
  lastYearMonthlySaleData: Object
})
</script>

<template>
  <Head :title="__('Admin Dashboard')" />

  <AdminDashboardLayout>
    <template #header>
      <DashboardHeaderStats
        :totalUsers="totalUsers"
        :totalOrders="totalOrders"
        :totalSales="totalSales"
        :todayEarnings="todayEarnings"
        :percentageChangeUsers="percentageChangeUsers"
        :percentageChangeOrders="percentageChangeOrders"
        :percentageChangeSales="percentageChangeSales"
        :percentageChangeTodayEarnings="percentageChangeTodayEarnings"
      />
    </template>

    <div class="min-h-screen">
      <div class="flex flex-wrap">
        <div class="w-full xl:w-1/2 px-4">
          <TotalUserBarChart
            :thisYearMonthlyUserLabels="thisYearMonthlyUserLabels"
            :thisYearMonthlyUserData="thisYearMonthlyUserData"
            :lastYearMonthlyUserLabels="lastYearMonthlyUserLabels"
            :lastYearMonthlyUserData="lastYearMonthlyUserData"
          />
        </div>
        <div class="w-full xl:w-1/2 px-4">
          <TotalOrderBarChart
            :thisYearMonthlyOrderLabels="thisYearMonthlyOrderLabels"
            :thisYearMonthlyOrderData="thisYearMonthlyOrderData"
            :lastYearMonthlyOrderLabels="lastYearMonthlyOrderLabels"
            :lastYearMonthlyOrderData="lastYearMonthlyOrderData"
          />
        </div>
        <div class="w-full mb-12 xl:mb-0 px-4">
          <TotalSaleLineChart
            :thisYearMonthlySaleLabels="thisYearMonthlySaleLabels"
            :thisYearMonthlySaleData="thisYearMonthlySaleData"
            :lastYearMonthlySaleLabels="lastYearMonthlySaleLabels"
            :lastYearMonthlySaleData="lastYearMonthlySaleData"
          />
        </div>
      </div>
    </div>
  </AdminDashboardLayout>
</template>
