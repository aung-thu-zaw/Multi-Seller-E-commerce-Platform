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

defineProps({ orders: Object })

const orderList = 'seller.orders.index'

const handleDownloadInvoice = async (orderId) => {
  try {
    const response = await axios.get(route('seller.order-invoice.download', { order: orderId }), {
      responseType: 'blob'
    })
    const url = window.URL.createObjectURL(new Blob([response.data]))
    const link = document.createElement('a')
    link.href = url
    link.setAttribute('download', 'invoice.pdf')
    document.body.appendChild(link)
    link.click()
  } catch (error) {
    this.showSnackbar({
      message: 'Error downloading invoice.',
      type: 'error'
    })
  }
}

const totalProductQty = (orderItems) => {
  return orderItems.reduce((totalQty, orderItem) => {
    return totalQty + orderItem.qty
  }, 0)
}

const subTotal = (orderItems) => {
  return orderItems.reduce((accumulator, currentItem) => {
    const numericTotalPrice = parseFloat(currentItem.total_price)
    return accumulator + numericTotalPrice
  }, 0)
}
</script>

<template>
  <Head :title="__('Orders')" />

  <SellerDashboardLayout>
    <!-- Breadcrumb And Trash Button  -->
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb :to="orderList" icon="fa-boxes-packing" label="Orders">
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
            :to="orderList"
          />

          <div class="flex items-center justify-end w-full md:space-x-5">
            <DashboardTableDataPerPageSelectBox :to="orderList" />

            <DashboardTableFilter
              :to="orderList"
              :filterBy="['created', 'status']"
              :options="[
                {
                  label: 'Pending',
                  value: 'pending'
                },
                {
                  label: 'Processing',
                  value: 'processing'
                },
                {
                  label: 'Shipped',
                  value: 'shipped'
                },
                {
                  label: 'Delivered',
                  value: 'delivered'
                }
              ]"
            />
          </div>
        </div>

        <!-- Filtered By -->
        <FilteredBy :to="orderList" />

        <TableContainer>
          <ActionTable :items="orders.data">
            <!-- Table Header -->
            <template #table-header>
              <TableHeaderCell label="Customer" />

              <SortableTableHeaderCell label="Invoice" :to="orderList" sort="invoice_no" />

              <SortableTableHeaderCell label="Product Qty" :to="orderList" sort="product_qty" />

              <SortableTableHeaderCell label="Total Amount" :to="orderList" sort="total_amount" />

              <TableHeaderCell label="Shipping Method" />

              <TableHeaderCell label="Payment Method" />

              <TableHeaderCell label="Payment Status" />

              <TableHeaderCell label="Order Status" />

              <TableHeaderCell label="Order Date" />

              <TableHeaderCell label="Actions" />
            </template>

            <!-- Table Body -->
            <template #table-data="{ item }">
              <TableDataCell>
                <div class="min-w-[150px]">
                  {{ item?.user?.name }}
                </div>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[200px]">
                  {{ item?.invoice_no }}
                </div>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[150px]">
                  {{ totalProductQty(item.order_items) }}
                </div>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[150px]">$ {{ subTotal(item.order_items) }}</div>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[150px]">
                  {{ item?.shipping_method }}
                </div>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[150px]">
                  {{ item?.payment_method }}
                </div>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[150px]">
                  <BlueBadge v-show="item?.payment_status === 'pending'">
                    <i class="fa-solid fa-spinner animate-spin"></i>
                    {{ item?.payment_status }}
                  </BlueBadge>
                  <GreenBadge v-show="item?.payment_status === 'completed'">
                    <i class="fa-solid fa-circle-check animate-pulse"></i>
                    {{ item?.payment_status }}
                  </GreenBadge>
                </div>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[150px]">
                  <BlueBadge v-show="item?.status === 'pending'">
                    <i class="fa-solid fa-spinner animate-spin"></i>
                    {{ item?.status }}
                  </BlueBadge>
                  <OrangeBadge v-show="item?.status === 'processing'">
                    <i class="fa-solid fa-rotate animate-spin"></i>
                    {{ item?.status }}
                  </OrangeBadge>
                  <RedBadge v-show="item?.status === 'shipped'">
                    <i class="fa-solid fa-truck-fast animate-pulse"></i>
                    {{ item?.status }}
                  </RedBadge>

                  <GreenBadge v-show="item?.status === 'delivered'">
                    <i class="fa-solid fa-truck-ramp-box animate-pulse"></i>
                    {{ item?.status }}
                  </GreenBadge>
                </div>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[250px]">
                  {{ item?.created_at }}
                </div>
              </TableDataCell>

              <TableActionCell>
                <NormalButton
                  @click="handleDownloadInvoice(item?.uuid)"
                  class="bg-yellow-600 text-white ring-2 ring-yellow-300"
                >
                  <i class="fa-solid fa-download"></i>
                  {{ __('Invoice') }}
                </NormalButton>

                <InertiaLinkButton
                  to="seller.orders.show"
                  :targetIdentifier="{ order: item?.uuid }"
                  class="bg-sky-600 text-white ring-2 ring-sky-300"
                >
                  <i class="fa-solid fa-eye"></i>
                  {{ __('Details') }}
                </InertiaLinkButton>
              </TableActionCell>
            </template>
          </ActionTable>
        </TableContainer>

        <Pagination :data="orders" />

        <NoTableData v-show="!orders.data.length" />
      </div>
      <!-- Table End -->
    </div>
  </SellerDashboardLayout>
</template>
