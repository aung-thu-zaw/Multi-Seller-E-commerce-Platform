<script setup>
import CardStats from '@/Components/Cards/CardStats.vue'

defineProps({
  totalUsers: Object,
  totalOrders: Object,
  totalSales: Object,
  todayEarnings: Object,
  percentageChangeUsers: Object,
  percentageChangeOrders: Object,
  percentageChangeSales: Object,
  percentageChangeTodayEarnings: Object
})
</script>

<template>
  <!-- Header -->
  <div class="relative bg-orange-600 pb-32 pt-12">
    <div class="px-4 md:px-10 mx-auto w-full">
      <div>
        <!-- Card stats -->
        <div class="flex flex-wrap">
          <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
            <CardStats
              statSubtitle="TOTAL USERS"
              :statTitle="totalUsers"
              :statArrow="percentageChangeUsers > 0 ? 'up' : 'down'"
              :statPercent="percentageChangeUsers"
              :statPercentColor="percentageChangeUsers > 0 ? 'text-green-500' : 'text-red-500'"
              statDescripiron="Since last month"
              statIconName="fas fa-users"
              statIconColor="bg-red-500"
            />
          </div>

          <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
            <CardStats
              statSubtitle="TOTAL ORDERS"
              :statTitle="totalOrders"
              :statArrow="percentageChangeOrders > 0 ? 'up' : 'down'"
              :statPercent="percentageChangeOrders"
              :statPercentColor="percentageChangeOrders > 0 ? 'text-green-500' : 'text-red-500'"
              statDescripiron="Since last month"
              statIconName="fas fa-chart-pie"
              statIconColor="bg-orange-500"
            />
          </div>

          <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
            <CardStats
              statSubtitle="TOTAL SALES"
              :statTitle="totalSales"
              :statArrow="percentageChangeSales > 0 ? 'up' : 'down'"
              :statPercent="percentageChangeSales"
              :statPercentColor="percentageChangeSales > 0 ? 'text-green-500' : 'text-red-500'"
              statDescripiron="Since last month"
              statIconName="fas fa-sack-dollar"
              statIconColor="bg-yellow-500"
            />
          </div>

          <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
            <CardStats
              statSubtitle="TODAY EARNINGS"
              :statTitle="todayEarnings"
              :statArrow="percentageChangeTodayEarnings > 0 ? 'up' : 'down'"
              :statPercent="percentageChangeTodayEarnings"
              :statPercentColor="
                percentageChangeTodayEarnings > 0 ? 'text-green-500' : 'text-red-500'
              "
              statDescripiron="Since yesterday"
              statIconName="fas fa-file-invoice-dollar"
              statIconColor="bg-blue-500"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
