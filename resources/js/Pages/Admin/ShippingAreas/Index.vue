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
import BulkActionButton from '@/Components/Buttons/BulkActionButton.vue'
import InertiaLinkButton from '@/Components/Buttons/InertiaLinkButton.vue'
import NormalButton from '@/Components/Buttons/NormalButton.vue'
import Pagination from '@/Components/Paginations/DashboardPagination.vue'
import { useResourceActions } from '@/Composables/useResourceActions'
import { Head } from '@inertiajs/vue3'
import { __ } from '@/Services/translations-inside-setup.js'

defineProps({ shippingAreas: Object })

const shippingAreaList = 'admin.shipping-areas.index'

const { softDeleteAction, softDeleteSelectedAction } = useResourceActions()
</script>

<template>
  <Head :title="__('Shipping Areas')" />

  <AdminDashboardLayout>
    <!-- Breadcrumb And Trash Button  -->
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb :to="shippingAreaList" icon="fa-location-dot" label="Shipping Areas">
          <BreadcrumbItem label="List" />
        </Breadcrumb>
      </div>

      <div class="flex items-center justify-between mb-3">
        <!-- Create New Button -->
        <InertiaLinkButton v-show="can('shipping-areas.create')" to="admin.shipping-areas.create">
          <i class="fa-solid fa-file-circle-plus mr-1"></i>
          {{ __('Create A New :label', { label: __('Shipping Area') }) }}
        </InertiaLinkButton>

        <!-- Trash Button -->
        <InertiaLinkButton
          v-show="can('shipping-areas.view.trash')"
          to="admin.shipping-areas.trashed"
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
            :placeholder="__('Search by :label', { label: __('Shipping Area Name') })"
            :to="shippingAreaList"
          />

          <div class="flex items-center justify-end w-full md:space-x-5">
            <DashboardTableDataPerPageSelectBox :to="shippingAreaList" />

            <DashboardTableFilter :to="shippingAreaList" :filterBy="['created']" />
          </div>
        </div>

        <!-- Filtered By -->
        <FilteredBy :to="shippingAreaList" />

        <TableContainer>
          <ActionTable :items="shippingAreas.data">
            <!-- Table Actions -->
            <template #bulk-actions="{ selectedItems }">
              <BulkActionButton
                v-show="can('shipping-areas.delete')"
                @click="
                  softDeleteSelectedAction(
                    'Shipping Areas',
                    'admin.shipping-areas.destroy.selected',
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
              <SortableTableHeaderCell label="Id" :to="shippingAreaList" sort="id" />

              <TableHeaderCell label="Region" />

              <TableHeaderCell label="City" />

              <TableHeaderCell label="Township" />

              <SortableTableHeaderCell label="Name" :to="shippingAreaList" sort="name" />

              <TableHeaderCell label="Actions" />
            </template>

            <!-- Table Body -->
            <template #table-data="{ item }">
              <TableDataCell>
                {{ item?.id }}
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[200px]">
                  {{ item?.region?.name }}
                </div>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[200px]">
                  {{ item?.city?.name }}
                </div>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[200px]">
                  {{ item?.township?.name }}
                </div>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[200px]">
                  {{ item?.name }}
                </div>
              </TableDataCell>

              <TableActionCell>
                <InertiaLinkButton
                  v-show="can('shipping-areas.edit')"
                  to="admin.shipping-areas.edit"
                  :targetIdentifier="{ shipping_area: item?.slug }"
                >
                  <i class="fa-solid fa-edit"></i>
                  {{ __('Edit') }}
                </InertiaLinkButton>

                <NormalButton
                  v-show="can('shipping-areas.delete')"
                  @click="
                    softDeleteAction('Shipping Area', 'admin.shipping-areas.destroy', {
                      shipping_area: item?.slug
                    })
                  "
                  class="bg-red-600 text-white ring-2 ring-red-300"
                >
                  <i class="fa-solid fa-trash-can"></i>
                  {{ __('Delete') }}
                </NormalButton>
              </TableActionCell>
            </template>
          </ActionTable>
        </TableContainer>

        <Pagination :data="shippingAreas" />

        <NoTableData v-show="!shippingAreas.data.length" />
      </div>
      <!-- Table End -->
    </div>
  </AdminDashboardLayout>
</template>
