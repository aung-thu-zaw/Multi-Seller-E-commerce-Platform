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
import ImageCell from '@/Components/Tables/TableCells/TableImageCell.vue'
import NoTableData from '@/Components/Tables/NoTableData.vue'
import BulkActionButton from '@/Components/Buttons/BulkActionButton.vue'
import InertiaLinkButton from '@/Components/Buttons/InertiaLinkButton.vue'
import NormalButton from '@/Components/Buttons/NormalButton.vue'
import EmptyTrashButton from '@/Components/Buttons/EmptyTrashButton.vue'
import Pagination from '@/Components/Paginations/DashboardPagination.vue'
import { Head } from '@inertiajs/vue3'
import { __ } from '@/Services/translations-inside-setup.js'
import { useResourceActions } from '@/Composables/useResourceActions'

defineProps({ trashedProducts: Object })

const productList = 'admin.products.index'

const trashedProductList = 'admin.products.trashed'

const {
  restoreAction,
  restoreSelectedAction,
  permanentDeleteAction,
  permanentDeleteSelectedAction,
  permanentDeleteAllAction
} = useResourceActions()
</script>

<template>
  <Head :title="__('Deleted :label', { label: __('Products') })" />

  <AdminDashboardLayout>
    <!-- Breadcrumb And Go back Button  -->
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb :to="productList" icon="fa-basket-shopping" label="Products">
          <BreadcrumbLinkItem label="Trash" :to="trashedProductList" />
          <BreadcrumbItem label="List" />
        </Breadcrumb>

        <div class="w-auto flex items-center justify-end">
          <InertiaLinkButton
            :to="productList"
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
        v-if="can('products.force.delete') && trashedProducts.data.length !== 0"
        class="text-left text-sm font-bold mb-5 text-warning-600"
      >
        {{
          __(':label in the trash will be automatically deleted after 60 days', {
            label: __('Products')
          })
        }}

        <EmptyTrashButton
          @click="permanentDeleteAllAction('Product', 'admin.products.force-delete.all')"
        />
      </div>

      <!-- Table Start -->
      <div class="border bg-white rounded-md shadow px-5 py-3">
        <div
          class="my-3 flex flex-col sm:flex-row space-y-5 sm:space-y-0 items-center justify-between overflow-auto p-2"
        >
          <DashboardTableDataSearchBox
            :placeholder="__('Search by :label', { label: __('Name') })"
            :to="trashedProductList"
          />

          <div class="flex items-center justify-end w-full md:space-x-5">
            <DashboardTableDataPerPageSelectBox :to="trashedProductList" />

            <DashboardTableFilter :to="trashedProductList" :filterBy="['deleted']" />
          </div>
        </div>

        <!-- Filtered By -->
        <FilteredBy :to="trashedProductList" />

        <TableContainer>
          <ActionTable :items="trashedProducts.data">
            <!-- Table Actions -->
            <template #bulk-actions="{ selectedItems }">
              <BulkActionButton
                v-show="can('products.restore')"
                @click="
                  restoreSelectedAction(
                    'Products',
                    'admin.products.restore.selected',
                    selectedItems
                  )
                "
              >
                <i class="fa-solid fa-recycle"></i>
                {{ __('Restore Selected') }} ({{ selectedItems.length }})
              </BulkActionButton>

              <BulkActionButton
                v-show="can('products.force.delete')"
                @click="
                  permanentDeleteSelectedAction(
                    'Products',
                    'admin.products.force-delete.selected',
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
              <SortableTableHeaderCell label="Id" :to="trashedProductList" sort="id" />

              <TableHeaderCell label="Image" />

              <SortableTableHeaderCell label="Name" :to="trashedProductList" sort="name" />

              <SortableTableHeaderCell label="Qty" :to="trashedProductList" sort="qty" />

              <SortableTableHeaderCell label="Price" :to="trashedProductList" sort="price" />

              <TableHeaderCell label="Actions" />
            </template>

            <!-- Table Body -->
            <template #table-data="{ item }">
              <TableDataCell>
                {{ item?.id }}
              </TableDataCell>

              <ImageCell :src="item?.image" />

              <TableDataCell>
                <div class="min-w-[250px]">
                  {{ item?.name }}
                </div>
              </TableDataCell>

              <TableDataCell>
                {{ item?.qty ?? '-' }}
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[100px]">
                  {{ item?.price ?? '-' }}
                </div>
              </TableDataCell>

              <TableActionCell>
                <NormalButton
                  v-show="can('products.restore')"
                  @click="restoreAction('Product', 'admin.products.restore', { id: item?.id })"
                >
                  <i class="fa-solid fa-recycle"></i>
                  {{ __('Restore') }}
                </NormalButton>

                <NormalButton
                  v-show="can('products.force.delete')"
                  @click="
                    permanentDeleteAction('Product', 'admin.products.force-delete', {
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

        <Pagination :data="trashedProducts" />

        <NoTableData v-show="!trashedProducts.data.length" />
      </div>
      <!-- Table End -->
    </div>
  </AdminDashboardLayout>
</template>
