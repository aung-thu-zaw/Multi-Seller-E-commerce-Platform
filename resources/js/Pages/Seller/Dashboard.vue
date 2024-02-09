<script setup>
import SellerDashboardLayout from '@/Layouts/SellerDashboardLayout.vue'
import DashboardHeaderStats from '@/Components/Headers/SellerDashboardHeaderStats.vue'
// import TotalSaleLineChart from '@/Components/Charts/TotalSaleLineChart.vue'
import TotalOrderItemBarChart from '@/Components/Charts/TotalOrderItemBarChart.vue'
import TotalSaleBarChart from '@/Components/Charts/TotalSaleBarChart.vue'
import YellowAlert from '@/Components/Alerts/YellowAlert.vue'
import { Head, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

const user = computed(() => usePage().props.auth?.user)

defineProps({
  store: Object,
  totalFollowers: Object,
  totalOrders: Object,
  totalSales: Object,
  todayEarnings: Object,
  percentageChangeFollowers: Object,
  percentageChangeOrders: Object,
  percentageChangeSales: Object,
  percentageChangeTodayEarnings: Object,
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
  <Head :title="__('Seller Dashboard')" />

  <SellerDashboardLayout v-if="user?.role === 'seller' && store?.status === 'active'">
    <template #header>
      <DashboardHeaderStats
        :totalFollowers="totalFollowers"
        :totalOrders="totalOrders"
        :totalSales="totalSales"
        :todayEarnings="todayEarnings"
        :percentageChangeFollowers="percentageChangeFollowers"
        :percentageChangeOrders="percentageChangeOrders"
        :percentageChangeSales="percentageChangeSales"
        :percentageChangeTodayEarnings="percentageChangeTodayEarnings"
      />
    </template>

    <div class="min-h-screen">
      <div class="flex flex-wrap">
        <div class="w-full xl:w-1/2 px-4">
          <TotalSaleBarChart
            :thisYearMonthlySaleLabels="thisYearMonthlySaleLabels"
            :thisYearMonthlySaleData="thisYearMonthlySaleData"
            :lastYearMonthlySaleLabels="lastYearMonthlySaleLabels"
            :lastYearMonthlySaleData="lastYearMonthlySaleData"
          />
        </div>
        <div class="w-full xl:w-1/2 px-4">
          <TotalOrderItemBarChart
            :thisYearMonthlyOrderLabels="thisYearMonthlyOrderLabels"
            :thisYearMonthlyOrderData="thisYearMonthlyOrderData"
            :lastYearMonthlyOrderLabels="lastYearMonthlyOrderLabels"
            :lastYearMonthlyOrderData="lastYearMonthlyOrderData"
          />
        </div>
        <div class="w-full mb-12 xl:mb-0 px-4">
          <!-- <TotalSaleLineChart /> -->
        </div>
      </div>
    </div>
  </SellerDashboardLayout>

  <SellerDashboardLayout v-else>
    <div class="mt-20 py-12 min-h-screen space-y-10">
      <YellowAlert>
        <div class="flex items-center space-x-5">
          <i class="fa-solid fa-spinner animate-spin"></i>
          <span>
            {{
              __(
                'Your store is currently inactive. Please fill in the required information. An administrator will verify your information and contact you.'
              )
            }}
          </span>
        </div>
      </YellowAlert>
    </div>
  </SellerDashboardLayout>
</template>
