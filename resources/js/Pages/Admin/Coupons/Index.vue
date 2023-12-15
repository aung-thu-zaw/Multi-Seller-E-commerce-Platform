<script setup>
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue'
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
import BlueBadge from '@/Components/Badges/BlueBadge.vue'
import OrangeBadge from '@/Components/Badges/OrangeBadge.vue'
import GreenBadge from '@/Components/Badges/GreenBadge.vue'
import RedBadge from '@/Components/Badges/RedBadge.vue'
import BulkActionButton from '@/Components/Buttons/BulkActionButton.vue'
import InertiaLinkButton from '@/Components/Buttons/InertiaLinkButton.vue'
import NormalButton from '@/Components/Buttons/NormalButton.vue'
import Pagination from '@/Components/Paginations/DashboardPagination.vue'
import { useResourceActions } from '@/Composables/useResourceActions'
import { Head } from '@inertiajs/vue3'
import { __ } from '@/Services/translations-inside-setup.js'

defineProps({ coupons: Object })

const couponList = 'admin.coupons.index'

const { softDeleteAction, softDeleteSelectedAction } = useResourceActions()
</script>

<template>
  <Head :title="__('Coupons')" />

  <AdminDashboardLayout>
    <!-- Breadcrumb And Trash Button  -->
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb :to="couponList" icon="fa-ticket" label="Coupons">
          <BreadcrumbItem label="List" />
        </Breadcrumb>
      </div>

      <div class="flex items-center justify-between mb-3">
        <!-- Create New Button -->
        <InertiaLinkButton v-show="can('coupons.create')" to="admin.coupons.create">
          <i class="fa-solid fa-file-circle-plus mr-1"></i>
          {{ __('Create A New :label', { label: __('Coupon') }) }}
        </InertiaLinkButton>

        <!-- Trash Button -->
        <InertiaLinkButton
          v-show="can('coupons.view.trash')"
          to="admin.coupons.trashed"
          :data="{
            page: 1,
            per_page: 5,
            sort: 'id',
            direction: 'desc'
          }"
          class="bg-red-600 text-white ring-2 ring-red-300"
        >
          <i class="fa-solid fa-trash-can mr-1"></i>
          {{ __('Trash') }}
        </InertiaLinkButton>
      </div>

      <!-- Table Start -->
      <div class="border bg-white rounded-md shadow px-5 py-3">
        <div
          class="my-3 flex flex-col sm:flex-row space-y-5 sm:space-y-0 items-center justify-between overflow-auto p-2"
        >
          <DashboardTableDataSearchBox
            :placeholder="__('Search by :label', { label: __('Code') })"
            :to="couponList"
          />

          <div class="flex items-center justify-end w-full md:space-x-5">
            <DashboardTableDataPerPageSelectBox :to="couponList" />

            <DashboardTableFilter
              :to="couponList"
              :filterBy="['created', 'status']"
              :options="[
                {
                  label: 'Active',
                  value: 'active'
                },
                {
                  label: 'Inactive',
                  value: 'inactive'
                }
              ]"
            />
          </div>
        </div>

        <!-- Filtered By -->
        <FilteredBy :to="couponList" />

        <TableContainer>
          <ActionTable :items="coupons.data">
            <!-- Table Actions -->
            <template #bulk-actions="{ selectedItems }">
              <BulkActionButton
                v-show="can('coupons.delete')"
                @click="
                  softDeleteSelectedAction(
                    'Coupons',
                    'admin.coupons.destroy.selected',
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
              <SortableTableHeaderCell label="Id" :to="couponList" sort="id" />

              <SortableTableHeaderCell label="Code" :to="couponList" sort="code" />

              <TableHeaderCell label="Type" />

              <SortableTableHeaderCell label="Minimum Spend" :to="couponList" sort="min_spend" />

              <SortableTableHeaderCell label="Value" :to="couponList" sort="value" />

              <SortableTableHeaderCell label="Usage Limit" :to="couponList" sort="usage_limit" />

              <SortableTableHeaderCell label="Used" :to="couponList" sort="used" />

              <SortableTableHeaderCell label="Expiry Date" :to="couponList" sort="expiry_date" />

              <TableHeaderCell label="Status" />

              <TableHeaderCell label="Actions" />
            </template>

            <!-- Table Body -->
            <template #table-data="{ item }">
              <TableDataCell>
                {{ item?.id }}
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[150px]">
                  {{ item?.code }}
                </div>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[150px]">
                  <BlueBadge v-show="item?.type === 'free_shipping'"> free shipping </BlueBadge>
                  <GreenBadge v-show="item?.type === 'percentage'"> percentage </GreenBadge>
                  <OrangeBadge v-show="item?.type === 'fixed'"> fixed </OrangeBadge>
                </div>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[150px]">${{ item?.min_spend }}</div>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[100px]">${{ item?.value }}</div>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[100px]">
                  {{ item?.usage_limit }}
                </div>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[100px]">
                  {{ item?.used }}
                </div>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[150px]">
                  {{ item?.expiry_date }}
                </div>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[100px]">
                  <GreenBadge v-show="item?.status === 'active'">
                    <i class="fa-solid fa-eye animate-pulse"></i>
                    {{ item?.status }}
                  </GreenBadge>
                  <RedBadge v-show="item?.status === 'inactive'">
                    <i class="fa-solid fa-eye-slash animate-pulse"></i>
                    {{ item?.status }}
                  </RedBadge>
                </div>
              </TableDataCell>

              <TableActionCell>
                <InertiaLinkButton
                  v-show="can('coupons.edit')"
                  to="admin.coupons.edit"
                  :targetIdentifier="{ coupon: item?.id }"
                >
                  <i class="fa-solid fa-edit"></i>
                  {{ __('Edit') }}
                </InertiaLinkButton>

                <NormalButton
                  v-show="can('coupons.delete')"
                  @click="softDeleteAction('Coupon', 'admin.coupons.destroy', { coupon: item?.id })"
                  class="bg-red-600 text-white ring-2 ring-red-300"
                >
                  <i class="fa-solid fa-trash-can"></i>
                  {{ __('Delete') }}
                </NormalButton>
              </TableActionCell>
            </template>
          </ActionTable>
        </TableContainer>

        <Pagination :data="coupons" />

        <NoTableData v-show="!coupons.data.length" />
      </div>
      <!-- Table End -->
    </div>
  </AdminDashboardLayout>
</template>
