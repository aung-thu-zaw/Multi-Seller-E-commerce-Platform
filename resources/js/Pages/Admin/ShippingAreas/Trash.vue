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

defineProps({ trashedShippingAreas: Object })

const shippingAreaList = 'admin.shipping-areas.index'

const trashedShippingAreaList = 'admin.shipping-areas.trashed'

const {
  restoreAction,
  restoreSelectedAction,
  permanentDeleteAction,
  permanentDeleteSelectedAction,
  permanentDeleteAllAction
} = useResourceActions()
</script>

<template>
  <Head :title="__('Deleted :label', { label: __('Shipping Areas') })" />

  <AdminDashboardLayout>
    <!-- Breadcrumb And Go back Button  -->
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb :to="shippingAreaList" icon="fa-location-dot" label="Shipping Areas">
          <BreadcrumbLinkItem label="Trash" :to="trashedShippingAreaList" />
          <BreadcrumbItem label="List" />
        </Breadcrumb>

        <div class="w-auto flex items-center justify-end">
          <InertiaLinkButton
            :to="shippingAreaList"
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
        v-if="can('shipping-areas.force.delete') && trashedShippingAreas.data.length !== 0"
        class="text-left text-sm font-bold mb-5 text-warning-600"
      >
        {{
          __(':label in the trash will be automatically deleted after 60 days', {
            label: __('Shipping Areas')
          })
        }}

        <EmptyTrashButton
          @click="
            permanentDeleteAllAction('Shipping Area', 'admin.shipping-areas.force-delete.all')
          "
        />
      </div>

      <!-- Table Start -->
      <div class="border bg-white rounded-md shadow px-5 py-3">
        <div
          class="my-3 flex flex-col sm:flex-row space-y-5 sm:space-y-0 items-center justify-between overflow-auto p-2"
        >
          <DashboardTableDataSearchBox
            :placeholder="__('Search by :label', { label: __('Shipping Area Name') })"
            :to="trashedShippingAreaList"
          />

          <div class="flex items-center justify-end w-full md:space-x-5">
            <DashboardTableDataPerPageSelectBox :to="trashedShippingAreaList" />

            <DashboardTableFilter :to="trashedShippingAreaList" :filterBy="['deleted']" />
          </div>
        </div>

        <!-- Filtered By -->
        <FilteredBy :to="trashedShippingAreaList" />

        <TableContainer>
          <ActionTable :items="trashedShippingAreas.data">
            <!-- Table Actions -->
            <template #bulk-actions="{ selectedItems }">
              <BulkActionButton
                v-show="can('shipping-areas.restore')"
                @click="
                  restoreSelectedAction(
                    'Shipping Areas',
                    'admin.shipping-areas.restore.selected',
                    selectedItems
                  )
                "
              >
                <i class="fa-solid fa-recycle"></i>
                {{ __('Restore Selected') }} ({{ selectedItems.length }})
              </BulkActionButton>

              <BulkActionButton
                v-show="can('shipping-areas.force.delete')"
                @click="
                  permanentDeleteSelectedAction(
                    'Shipping Areas',
                    'admin.shipping-areas.force-delete.selected',
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
              <SortableTableHeaderCell label="Id" :to="trashedShippingAreaList" sort="id" />

              <TableHeaderCell label="Region" />

              <TableHeaderCell label="City" />

              <TableHeaderCell label="Township" />

              <SortableTableHeaderCell label="Name" :to="trashedShippingAreaList" sort="name" />

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
                <NormalButton
                  v-show="can('shipping-areas.restore')"
                  @click="
                    restoreAction('Shipping Area', 'admin.shipping-areas.restore', {
                      id: item?.id
                    })
                  "
                >
                  <i class="fa-solid fa-recycle"></i>
                  {{ __('Restore') }}
                </NormalButton>

                <NormalButton
                  v-show="can('shipping-areas.force.delete')"
                  @click="
                    permanentDeleteAction('Shipping Area', 'admin.shipping-areas.force-delete', {
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

        <Pagination :data="trashedShippingAreas" />

        <NoTableData v-show="!trashedShippingAreas.data.length" />
      </div>
      <!-- Table End -->
    </div>
  </AdminDashboardLayout>
</template>
