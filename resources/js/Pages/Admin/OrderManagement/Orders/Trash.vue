<script setup>
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue'
import Breadcrumb from '@/Components/Breadcrumbs/Breadcrumb.vue'
import BreadcrumbLinkItem from '@/Components/Breadcrumbs/BreadcrumbLinkItem.vue'
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
import BulkActionButton from '@/Components/Buttons/BulkActionButton.vue'
import InertiaLinkButton from '@/Components/Buttons/InertiaLinkButton.vue'
import NormalButton from '@/Components/Buttons/NormalButton.vue'
import EmptyTrashButton from '@/Components/Buttons/EmptyTrashButton.vue'
import Pagination from '@/Components/Paginations/DashboardPagination.vue'
import { Head } from '@inertiajs/vue3'
import { __ } from '@/Services/translations-inside-setup.js'
import { useResourceActions } from '@/Composables/useResourceActions'

defineProps({ trashedOrders: Object })

const orderList = 'admin.orders.index'

const trashedOrderList = 'admin.orders.trashed'

const {
  restoreAction,
  restoreSelectedAction,
  permanentDeleteAction,
  permanentDeleteSelectedAction,
  permanentDeleteAllAction
} = useResourceActions()
</script>

<template>
  <Head :title="__('Deleted :label', { label: __('Orders') })" />

  <AdminDashboardLayout>
    <!-- Breadcrumb And Go back Button  -->
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb :to="orderList" icon="fa-boxes-packing" label="Orders">
          <BreadcrumbLinkItem label="Trash" :to="trashedOrderList" />
          <BreadcrumbItem label="List" />
        </Breadcrumb>

        <div class="w-auto flex items-center justify-end">
          <InertiaLinkButton
            :to="orderList"
            :data="{
              page: 1,
              per_page: 5,
              sort: 'id',
              direction: 'desc'
            }"
          >
            <i class="fa-solid fa-left-long"></i>
            {{ __('Go To List') }}
          </InertiaLinkButton>
        </div>
      </div>

      <!-- Message -->
      <div
        v-if="can('orders.force.delete') && trashedOrders.data.length !== 0"
        class="text-left text-sm font-bold mb-5 text-warning-600"
      >
        {{
          __(':label in the trash will be automatically deleted after 60 days', {
            label: __('Orders')
          })
        }}

        <EmptyTrashButton
          @click="permanentDeleteAllAction('Order', 'admin.orders.force-delete.all')"
        />
      </div>

      <!-- Table Start -->
      <div class="border bg-white rounded-md shadow px-5 py-3">
        <div
          class="my-3 flex flex-col sm:flex-row space-y-5 sm:space-y-0 items-center justify-between overflow-auto p-2"
        >
          <DashboardTableDataSearchBox
            :placeholder="__('Search by :label', { label: __('Invoice No') })"
            :to="trashedOrderList"
          />

          <div class="flex items-center justify-end w-full md:space-x-5">
            <DashboardTableDataPerPageSelectBox :to="trashedOrderList" />

            <DashboardTableFilter :to="trashedOrderList" :filterBy="['deleted']" />
          </div>
        </div>

        <!-- Filtered By -->
        <FilteredBy :to="trashedOrderList" />

        <TableContainer>
          <ActionTable :items="trashedOrders.data">
            <!-- Table Actions -->
            <template #bulk-actions="{ selectedItems }">
              <BulkActionButton
                v-show="can('orders.restore')"
                @click="
                  restoreSelectedAction('Orders', 'admin.orders.restore.selected', selectedItems)
                "
              >
                <i class="fa-solid fa-recycle"></i>
                {{ __('Restore Selected') }} ({{ selectedItems.length }})
              </BulkActionButton>

              <BulkActionButton
                v-show="can('orders.force.delete')"
                @click="
                  permanentDeleteSelectedAction(
                    'Orders',
                    'admin.orders.force-delete.selected',
                    selectedItems
                  )
                "
                class="text-red-600"
              >
                <i class="fa-solid fa-trash-can"></i>
                {{ __('Delete Selected') }} ({{ selectedItems.length }})
              </BulkActionButton>
            </template>

            <!-- Table Header -->
            <template #table-header>
              <SortableTableHeaderCell label="Id" :to="trashedOrderList" sort="id" />

              <TableHeaderCell label="Customer" />

              <SortableTableHeaderCell label="Invoice" :to="trashedOrderList" sort="invoice_no" />

              <SortableTableHeaderCell
                label="Product Qty"
                :to="trashedOrderList"
                sort="product_qty"
              />

              <SortableTableHeaderCell
                label="Total Amount"
                :to="trashedOrderList"
                sort="total_amount"
              />

              <TableHeaderCell label="Shipping Method" />

              <TableHeaderCell label="Payment Method" />

              <TableHeaderCell label="Payment Status" />

              <TableHeaderCell label="Order Date" />

              <TableHeaderCell label="Actions" />
            </template>

            <!-- Table Body -->
            <template #table-data="{ item }">
              <TableDataCell>
                {{ item?.id }}
              </TableDataCell>

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
                  {{ item?.product_qty }}
                </div>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[150px]">$ {{ formatAmount(item?.total_amount) }}</div>
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
                <div class="min-w-[200px]">
                  {{ item?.created_at }}
                </div>
              </TableDataCell>

              <TableActionCell>
                <NormalButton
                  v-show="can('orders.restore')"
                  @click="restoreAction('Order', 'admin.orders.restore', { id: item?.id })"
                >
                  <i class="fa-solid fa-recycle"></i>
                  {{ __('Restore') }}
                </NormalButton>

                <NormalButton
                  v-show="can('orders.force.delete')"
                  @click="
                    permanentDeleteAction('Order', 'admin.orders.force-delete', {
                      id: item?.id
                    })
                  "
                  class="bg-red-600 text-white ring-2 ring-red-300"
                >
                  <i class="fa-solid fa-trash-can"></i>
                  {{ __('Delete Forever') }}
                </NormalButton>
              </TableActionCell>
            </template>
          </ActionTable>
        </TableContainer>

        <Pagination :data="trashedOrders" />

        <NoTableData v-show="!trashedOrders.data.length" />
      </div>
      <!-- Table End -->
    </div>
  </AdminDashboardLayout>
</template>
