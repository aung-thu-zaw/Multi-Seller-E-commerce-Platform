<script setup>
import CardStats from '@/Components/Cards/CardStats.vue'
</script>

<template>
  <!-- Header -->
  <div class="relative bg-blue-600 pb-32 pt-12">
    <div class="px-4 md:px-10 mx-auto w-full">
      <div>
        <!-- Card stats -->
        <div class="flex flex-wrap">
          <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
            <CardStats
              statSubtitle="TOTAL USERS"
              statTitle="350,897"
              statArrow="up"
              statPercent="3.48"
              statPercentColor="text-emerald-500"
              statDescripiron="Since last month"
              statIconName="fas fa-users"
              statIconColor="bg-red-500"
            />
          </div>

          <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
            <CardStats
              statSubtitle="TOTAL ORDERS"
              statTitle="2,356"
              statArrow="down"
              statPercent="3.48"
              statPercentColor="text-red-500"
              statDescripiron="Since last week"
              statIconName="fas fa-chart-pie"
              statIconColor="bg-orange-500"
            />
          </div>

          <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
            <CardStats
              statSubtitle="TOTAL SALES"
              statTitle="49,65"
              statArrow="up"
              statPercent="12"
              statPercentColor="text-emerald-500"
              statDescripiron="Since last month"
              statIconName="fas fa-sack-dollar"
              statIconColor="bg-yellow-500"
            />
          </div>

          <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
            <CardStats
              statSubtitle="TODAY EARNINGS"
              statTitle="924"
              statArrow="down"
              statPercent="1.10"
              statPercentColor="text-orange-500"
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
