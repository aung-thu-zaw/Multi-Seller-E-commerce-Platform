<script setup>
import SellerDashboardLayout from '@/Layouts/SellerDashboardLayout.vue'
import DashboardHeaderStats from '@/Components/Headers/SellerDashboardHeaderStats.vue'
import TotalSaleLineChart from '@/Components/Charts/TotalSaleLineChart.vue'
import TotalOrderBarChart from '@/Components/Charts/TotalOrderBarChart.vue'
import TotalUserBarChart from '@/Components/Charts/TotalUserBarChart.vue'
import { Head } from '@inertiajs/vue3'
</script>

<template>
  <Head :title="__('Seller Dashboard')" />

  <SellerDashboardLayout>
    <template #header>
      <DashboardHeaderStats />
    </template>

    <div class="min-h-screen">
      <div class="flex flex-wrap">
        <div class="w-full xl:w-1/2 px-4">
          <TotalUserBarChart />
        </div>
        <div class="w-full xl:w-1/2 px-4">
          <TotalOrderBarChart />
        </div>
        <div class="w-full mb-12 xl:mb-0 px-4">
          <TotalSaleLineChart />
        </div>
      </div>

      <!-- <div class="flex flex-wrap mt-4">
        <div class="w-full mb-12 px-4">
          <div
            class="w-full bg-white px-6 py-3 shadow rounded-sm border-t-4 border-t-orange-500"
          >
            <h1 class="font-semibold text-blueGray-600 p-5 text-lg">
              <i class="fa-solid fa-calendar-day"></i>
              Today Orders
            </h1>

            <div class="my-5 flex items-center justify-between">
              <DashboardTableDataSearchBox />

              <DashboardTableDataPerPageSelectBox />
            </div>
            <TableContainer>
              <Table
                :items="[
                  { testingOne: 'testingOne' },
                  { testingTwo: 'testingTwo' },
                ]"
              > -->
      <!-- Table Header -->
      <!-- <template #table-header>
                  <SortableTableHeaderCell label="# No" to="home" />

                  <SortableTableHeaderCell label="Invoice Id" to="home" />

                  <SortableTableHeaderCell label="Customer Name" to="home" />

                  <SortableTableHeaderCell label="Qty" to="home" />

                  <SortableTableHeaderCell label="Order Status" to="home" />

                  <SortableTableHeaderCell label="Payment Status" to="home" />

                  <SortableTableHeaderCell label="Total" to="home" />

                  <SortableTableHeaderCell label="Date" to="home" />

                  <TableHeaderCell label="Actions" />
                </template> -->

      <!-- Table Body -->
      <!-- <template #table-data>
                  <TableDataCell> 1 </TableDataCell>

                  <TableDataCell>
                    <div class="min-w-[150px]">#E-commerce124453</div>
                  </TableDataCell>

                  <TableDataCell>
                    <div class="min-w-[150px]">Aung Thu Zaw</div>
                  </TableDataCell>

                  <TableDataCell> 3 </TableDataCell>

                  <TableDataCell>
                    <div class="min-w-[150px]">
                      <BlueBadge>
                        <i class="fa-solid fa-spinner animate-spin"></i>
                        pending
                      </BlueBadge>
                    </div>
                  </TableDataCell>

                  <TableDataCell>
                    <div class="min-w-[150px]">
                      <GreenBadge>
                        <i class="fa-regular fa-circle-check animate-pulse"></i>
                        completed
                      </GreenBadge>
                    </div>
                  </TableDataCell>

                  <TableDataCell>
                    <div class="min-w-[100px]">$ 500</div>
                  </TableDataCell>

                  <TableDataCell>
                    <div class="min-w-[150px]">12-September-2023</div>
                  </TableDataCell>

                  <TableActionCell>
                    <InertiaLinkButton to="home">
                      <i class="fa-solid fa-eye"></i>
                    </InertiaLinkButton>

                    <InertiaLinkButton to="home">
                      <i class="fa-solid fa-truck-ramp-box"></i>
                    </InertiaLinkButton>

                    <InertiaLinkButton to="home">
                      <i class="fa-solid fa-trash-can"></i>
                    </InertiaLinkButton>
                  </TableActionCell>
                </template>
              </Table>
            </TableContainer> -->

      <!-- <div class="py-3 flex items-center justify-center">
              <nav aria-label="Page navigation example">
                <ul class="inline-flex -space-x-px text-base h-10">
                  <li>
                    <a
                      href="#"
                      class="flex items-center justify-center px-4 h-10 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                      >Previous</a
                    >
                  </li>
                  <li>
                    <a
                      href="#"
                      class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                      >1</a
                    >
                  </li>
                  <li>
                    <a
                      href="#"
                      class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                      >2</a
                    >
                  </li>
                  <li>
                    <a
                      href="#"
                      aria-current="page"
                      class="flex items-center justify-center px-4 h-10 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                      >3</a
                    >
                  </li>
                  <li>
                    <a
                      href="#"
                      class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                      >4</a
                    >
                  </li>
                  <li>
                    <a
                      href="#"
                      class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                      >5</a
                    >
                  </li>
                  <li>
                    <a
                      href="#"
                      class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                      >Next</a
                    >
                  </li>
                </ul>
              </nav>
            </div> -->
      <!-- </div> -->
      <!-- </div> -->
      <!-- </div> -->
    </div>
  </SellerDashboardLayout>
</template>
