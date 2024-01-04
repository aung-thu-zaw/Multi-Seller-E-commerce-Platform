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
import ImageCell from '@/Components/Tables/TableCells/TableImageCell.vue'
import TableActionCell from '@/Components/Tables/TableCells/TableActionCell.vue'
import NoTableData from '@/Components/Tables/NoTableData.vue'
import GreenBadge from '@/Components/Badges/GreenBadge.vue'
import BlueBadge from '@/Components/Badges/BlueBadge.vue'
import OrangeBadge from '@/Components/Badges/OrangeBadge.vue'
import RedBadge from '@/Components/Badges/RedBadge.vue'
import InertiaLinkButton from '@/Components/Buttons/InertiaLinkButton.vue'
import NormalButton from '@/Components/Buttons/NormalButton.vue'
import Pagination from '@/Components/Paginations/DashboardPagination.vue'
import { Head } from '@inertiajs/vue3'
import { __ } from '@/Services/translations-inside-setup.js'
import axios from 'axios'
import { useFormatFunctions } from '@/Composables/useFormatFunctions'

defineProps({ cancellationItems: Object })

const cancellationList = 'seller.cancellation-items.index'

const { formatAmount } = useFormatFunctions()

// const handleDownloadInvoice = async (orderId) => {
//   try {
//     const response = await axios.get(route('seller.order-invoice.download', { order: orderId }), {
//       responseType: 'blob'
//     })
//     const url = window.URL.createObjectURL(new Blob([response.data]))
//     const link = document.createElement('a')
//     link.href = url
//     link.setAttribute('download', 'invoice.pdf')
//     document.body.appendChild(link)
//     link.click()
//   } catch (error) {
//     this.showSnackbar({
//       message: 'Error downloading invoice.',
//       type: 'error'
//     })
//   }
// }
</script>

<template>
  <Head :title="__('Cancellation Items')" />

  <SellerDashboardLayout>
    <!-- Breadcrumb And Trash Button  -->
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb :to="cancellationList" icon="fa-square-xmark" label="Cancellation Items">
          <BreadcrumbItem label="List" />
        </Breadcrumb>
      </div>

      <!-- Table Start -->
      <div class="border bg-white rounded-md shadow px-5 py-3">
        <div
          class="my-3 flex flex-col sm:flex-row space-y-5 sm:space-y-0 items-center justify-between overflow-auto p-2"
        >
          <DashboardTableDataSearchBox
            :placeholder="__('Search by :label', { label: __('Invoice No') })"
            :to="cancellationList"
          />

          <div class="flex items-center justify-end w-full md:space-x-5">
            <DashboardTableDataPerPageSelectBox :to="cancellationList" />

            <DashboardTableFilter
              :to="cancellationList"
              :filterBy="['created', 'status']"
              :options="[
                {
                  label: 'Pending',
                  value: 'pending'
                },
                {
                  label: 'Approved',
                  value: 'approved'
                },
                {
                  label: 'Rejected',
                  value: 'rejected'
                }
              ]"
            />
          </div>
        </div>

        <!-- Filtered By -->
        <FilteredBy :to="cancellationList" />

        <TableContainer>
          <ActionTable :items="cancellationItems.data">
            <!-- Table Header -->
            <template #table-header>
              <TableHeaderCell label="Order No" />

              <TableHeaderCell label="Image" />

              <TableHeaderCell label="Item" />

              <TableHeaderCell label="Customer" />

              <TableHeaderCell label="Qty" />

              <TableHeaderCell label="Unit Price" />

              <TableHeaderCell label="Total Price" />

              <TableHeaderCell label="Payment Status" />

              <TableHeaderCell label="Cancellation Status" />

              <TableHeaderCell label="Actions" />
            </template>

            <!-- Table Body -->
            <template #table-data="{ item }">
              <TableDataCell>
                <div class="min-w-[150px]">
                  {{ item.order_item?.order?.tracking_no }}
                </div>
              </TableDataCell>

              <ImageCell :src="item.order_item?.product?.image" />

              <TableDataCell>
                <div class="min-w-[200px]">
                  {{ item.order_item?.product?.name }}
                </div>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[150px]">
                  {{ item.order_item?.order?.user?.name }}
                </div>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[100px]">
                  {{ item.order_item?.qty }}
                </div>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[150px]">$ {{ formatAmount(item.order_item?.unit_price) }}</div>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[150px]">$ {{ formatAmount(item.order_item?.total_price) }}</div>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[150px]">
                  <BlueBadge v-show="item.order_item?.order?.payment_status === 'pending'">
                    <i class="fa-solid fa-spinner animate-spin"></i>
                    {{ item.order_item?.order?.payment_status }}
                  </BlueBadge>
                  <GreenBadge v-show="item.order_item?.order?.payment_status === 'completed'">
                    <i class="fa-solid fa-circle-check animate-pulse"></i>
                    {{ item.order_item?.order?.payment_status }}
                  </GreenBadge>
                </div>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[150px]">
                  <BlueBadge v-show="item?.status === 'pending'">
                    <i class="fa-solid fa-spinner animate-spin"></i>
                    {{ item?.status }}
                  </BlueBadge>

                  <GreenBadge v-show="item?.status === 'approved'">
                    <i class="fa-solid fa-circle-check animate-pulse"></i>
                    {{ item?.status }}
                  </GreenBadge>

                  <RedBadge v-show="item?.status === 'rejected'">
                    <i class="fa-solid fa-circle-xmark animate-pulse"></i>
                    {{ item?.status }}
                  </RedBadge>
                </div>
              </TableDataCell>

              <TableActionCell>
                <!-- <NormalButton
                  @click="handleDownloadInvoice(item?.uuid)"
                  class="bg-yellow-600 text-white ring-2 ring-yellow-300"
                >
                  <i class="fa-solid fa-download"></i>
                  {{ __('Invoice') }}
                </NormalButton> -->

                <InertiaLinkButton
                  to="seller.cancellation-items.show"
                  :targetIdentifier="{ cancellation_item: item?.id }"
                  class="bg-sky-600 text-white ring-2 ring-sky-300"
                >
                  <i class="fa-solid fa-eye"></i>
                  {{ __('Details') }}
                </InertiaLinkButton>
              </TableActionCell>
            </template>
          </ActionTable>
        </TableContainer>

        <Pagination :data="cancellationItems" />

        <NoTableData v-show="!cancellationItems.data.length" />
      </div>
      <!-- Table End -->
    </div>
  </SellerDashboardLayout>
</template>
