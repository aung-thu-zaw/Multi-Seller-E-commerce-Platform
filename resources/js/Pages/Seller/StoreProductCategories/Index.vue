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
import RedBadge from '@/Components/Badges/RedBadge.vue'
import BulkActionButton from '@/Components/Buttons/BulkActionButton.vue'
import InertiaLinkButton from '@/Components/Buttons/InertiaLinkButton.vue'
import NormalButton from '@/Components/Buttons/NormalButton.vue'
import Pagination from '@/Components/Paginations/DashboardPagination.vue'
import { useResourceActions } from '@/Composables/useResourceActions'
import { Head } from '@inertiajs/vue3'
import { __ } from '@/Services/translations-inside-setup.js'

defineProps({ storeProductCategories: Object })

const storeProductCategoryList = 'seller.store-product-categories.index'

const { softDeleteAction, softDeleteSelectedAction } = useResourceActions()
</script>

<template>
  <Head :title="__('Product Categories')" />

  <SellerDashboardLayout>
    <!-- Breadcrumb And Trash Button  -->
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb :to="storeProductCategoryList" icon="fa-list" label="Product Categories">
          <BreadcrumbItem label="List" />
        </Breadcrumb>
      </div>

      <div class="flex items-center justify-between mb-3">
        <!-- Create New Button -->
        <InertiaLinkButton to="seller.store-product-categories.create">
          <i class="fa-solid fa-file-circle-plus mr-1"></i>
          {{ __('Create A New :label', { label: __('Product Category') }) }}
        </InertiaLinkButton>

        <!-- Trash Button -->
        <InertiaLinkButton
          to="seller.store-product-categories.trashed"
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
            :placeholder="__('Search by :label', { label: __('Product Category Name') })"
            :to="storeProductCategoryList"
          />

          <div class="flex items-center justify-end w-full md:space-x-5">
            <DashboardTableDataPerPageSelectBox :to="storeProductCategoryList" />

            <DashboardTableFilter
              :to="storeProductCategoryList"
              :filterBy="['created', 'status']"
              :options="[
                {
                  label: 'Show',
                  value: 'show'
                },
                {
                  label: 'Hide',
                  value: 'hide'
                }
              ]"
            />
          </div>
        </div>

        <!-- Filtered By -->
        <FilteredBy :to="storeProductCategoryList" />

        <TableContainer>
          <ActionTable :items="storeProductCategories.data">
            <!-- Table Actions -->
            <template #bulk-actions="{ selectedItems }">
              <BulkActionButton
                @click="
                  softDeleteSelectedAction(
                    'Product Categories',
                    'seller.store-product-categories.destroy.selected',
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
              <SortableTableHeaderCell label="Name" :to="storeProductCategoryList" sort="name" />

              <TableHeaderCell label="Status" />

              <TableHeaderCell label="Actions" />
            </template>

            <!-- Table Body -->
            <template #table-data="{ item }">
              <TableDataCell>
                {{ item?.name }}
              </TableDataCell>

              <TableDataCell>
                <GreenBadge v-show="item?.status === 'show'">
                  <i class="fa-solid fa-eye animate-pulse"></i>
                  {{ item?.status }}
                </GreenBadge>
                <RedBadge v-show="item?.status === 'hide'">
                  <i class="fa-solid fa-eye-slash animate-pulse"></i>
                  {{ item?.status }}
                </RedBadge>
              </TableDataCell>

              <TableActionCell>
                <InertiaLinkButton
                  to="seller.store-product-categories.edit"
                  :targetIdentifier="{ store_product_category: item?.uuid }"
                >
                  <i class="fa-solid fa-edit"></i>
                  {{ __('Edit') }}
                </InertiaLinkButton>

                <NormalButton
                  @click="
                    softDeleteAction(
                      'Product Category',
                      'seller.store-product-categories.destroy',
                      { store_product_category: item?.uuid }
                    )
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

        <Pagination :data="storeProductCategories" />

        <NoTableData v-show="!storeProductCategories.data.length" />
      </div>
      <!-- Table End -->
    </div>
  </SellerDashboardLayout>
</template>
