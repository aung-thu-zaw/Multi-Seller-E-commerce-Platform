<script setup>
import SellerDashboardLayout from '@/Layouts/SellerDashboardLayout.vue'
import Breadcrumb from '@/Components/Breadcrumbs/Breadcrumb.vue'
import BreadcrumbItem from '@/Components/Breadcrumbs/BreadcrumbItem.vue'
import TableContainer from '@/Components/Tables/TableContainer.vue'
import ActionTable from '@/Components/Tables/ActionTable.vue'
import DashboardTableDataSearchBox from '@/Components/Forms/SearchBoxs/DashboardTableDataSearchBox.vue'
import DashboardTableDataPerPageSelectBox from '@/Components/Forms/SelectBoxs/DashboardTableDataPerPageSelectBox.vue'
import DashboardTableFilter from '@/Components/Forms/SelectBoxs/DashboardTableFilter.vue'
import FilteredBy from '@/Components/Tables/FilteredBy.vue'
import SortableTableHeaderCell from '@/Components/Tables/TableCells/SortableTableHeaderCell.vue'
import TableHeaderCell from '@/Components/Tables/TableCells/TableHeaderCell.vue'
import TableDataCell from '@/Components/Tables/TableCells/TableDataCell.vue'
import NoTableData from '@/Components/Tables/NoTableData.vue'
import GreenBadge from '@/Components/Badges/GreenBadge.vue'
import BlueBadge from '@/Components/Badges/BlueBadge.vue'
import RedBadge from '@/Components/Badges/BlueBadge.vue'
import InertiaLinkButton from '@/Components/Buttons/InertiaLinkButton.vue'
import Pagination from '@/Components/Paginations/DashboardPagination.vue'
import { Head } from '@inertiajs/vue3'
import { __ } from '@/Services/translations-inside-setup.js'
import { useFormatFunctions } from '@/Composables/useFormatFunctions'

defineProps({ payoutRequests: Object })

const payoutRequestList = 'seller.payout-requests.index'

const { formatAmount } = useFormatFunctions()
</script>

<template>
  <Head :title="__('Payout Requests')" />

  <SellerDashboardLayout>
    <!-- Breadcrumb And Trash Button  -->
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb :to="payoutRequestList" icon="fa-money-bill-transfer" label="Payout Requests">
          <BreadcrumbItem label="List" />
        </Breadcrumb>
      </div>

      <div class="flex items-center justify-between mb-3">
        <!-- Create New Button -->
        <InertiaLinkButton to="seller.payout-requests.create">
          <i class="fa-solid fa-file-circle-plus mr-1"></i>
          {{ __('Make A New Request') }}
        </InertiaLinkButton>
      </div>

      <!-- Table Start -->
      <div class="border bg-white rounded-md shadow px-5 py-3">
        <div
          class="my-3 flex flex-col sm:flex-row space-y-5 sm:space-y-0 items-center justify-between overflow-auto p-2"
        >
          <DashboardTableDataSearchBox
            :placeholder="__('Search by :label', { label: __('Question') })"
            :to="payoutRequestList"
          />

          <div class="flex items-center justify-end w-full md:space-x-5">
            <DashboardTableDataPerPageSelectBox :to="payoutRequestList" />

            <DashboardTableFilter
              :to="payoutRequestList"
              :filterBy="['created', 'status']"
              :options="[
                {
                  label: 'Pending',
                  value: 'pending'
                },
                {
                  label: 'Completed',
                  value: 'completed'
                },
                {
                  label: 'Failed',
                  value: 'failed'
                }
              ]"
            />
          </div>
        </div>

        <!-- Filtered By -->
        <FilteredBy :to="payoutRequestList" />

        <TableContainer>
          <ActionTable :items="payoutRequests.data">
            <!-- Table Header -->
            <template #table-header>
              <SortableTableHeaderCell label="Amount" :to="payoutRequestList" sort="amount" />

              <TableHeaderCell label="Status" />

              <TableHeaderCell label="Date" />
            </template>

            <!-- Table Body -->
            <template #table-data="{ item }">
              <TableDataCell>
                <div class="min-w-[150px]">$ {{ formatAmount(item?.amount) }}</div>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[150px]">
                  <BlueBadge v-show="item?.status === 'pending'">
                    <i class="fa-solid fa-spinner animate-spin"></i>
                    {{ item?.status }}
                  </BlueBadge>
                  <GreenBadge v-show="item?.status === 'paid'">
                    <i class="fa-solid fa-circle-check animate-pulse"></i>
                    {{ item?.status }}
                  </GreenBadge>
                  <RedBadge v-show="item?.status === 'declined'">
                    <i class="fa-solid fa-circle-xmark animate-pulse"></i>
                    {{ item?.status }}
                  </RedBadge>
                </div>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[200px]">
                  {{ item?.created_at }}
                </div>
              </TableDataCell>
            </template>
          </ActionTable>
        </TableContainer>

        <Pagination :data="payoutRequests" />

        <NoTableData v-show="!payoutRequests.data.length" />
      </div>
      <!-- Table End -->
    </div>
  </SellerDashboardLayout>
</template>
