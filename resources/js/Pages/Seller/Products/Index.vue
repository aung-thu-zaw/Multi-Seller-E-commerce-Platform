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
import OrangeBadge from '@/Components/Badges/OrangeBadge.vue'
import BlueBadge from '@/Components/Badges/BlueBadge.vue'
import GreenBadge from '@/Components/Badges/GreenBadge.vue'
import RedBadge from '@/Components/Badges/RedBadge.vue'
import BulkActionButton from '@/Components/Buttons/BulkActionButton.vue'
import InertiaLinkButton from '@/Components/Buttons/InertiaLinkButton.vue'
import NormalButton from '@/Components/Buttons/NormalButton.vue'
import Pagination from '@/Components/Paginations/DashboardPagination.vue'
import { useResourceActions } from '@/Composables/useResourceActions'
import { Head } from '@inertiajs/vue3'
import { __ } from '@/Services/translations-inside-setup.js'
import { useFormatFunctions } from '@/Composables/useFormatFunctions'

defineProps({ products: Object })

const productList = 'seller.products.index'

const { formatAmount } = useFormatFunctions()
const { softDeleteAction, softDeleteSelectedAction } = useResourceActions()
</script>

<template>
  <Head :title="__('Products')" />

  <SellerDashboardLayout>
    <!-- Breadcrumb And Trash Button  -->
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb :to="productList" icon="fa-basket-shopping" label="Products">
          <BreadcrumbItem label="List" />
        </Breadcrumb>
      </div>

      <div class="flex items-center justify-between mb-3">
        <!-- Create New Button -->
        <InertiaLinkButton to="seller.products.create">
          <i class="fa-solid fa-file-circle-plus mr-1"></i>
          {{ __('Create A New :label', { label: __('Product') }) }}
        </InertiaLinkButton>

        <!-- Trash Button -->
        <InertiaLinkButton
          to="seller.products.trashed"
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
            :placeholder="__('Search by :label', { label: __('Name') })"
            :to="productList"
          />

          <div class="flex items-center justify-end w-full md:space-x-5">
            <DashboardTableDataPerPageSelectBox :to="productList" />

            <DashboardTableFilter
              :to="productList"
              :filterBy="['created', 'status']"
              :options="[
                {
                  label: 'Draft',
                  value: 'draft'
                },
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
        <FilteredBy :to="productList" />

        <TableContainer>
          <ActionTable :items="products.data">
            <!-- Table Actions -->
            <template #bulk-actions="{ selectedItems }">
              <BulkActionButton
                @click="
                  softDeleteSelectedAction(
                    'Products',
                    'seller.products.destroy.selected',
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
              <SortableTableHeaderCell label="# No" :to="productList" sort="id" />

              <TableHeaderCell label="Image" />

              <SortableTableHeaderCell label="Name" :to="productList" sort="name" />

              <TableHeaderCell label="Qty" />

              <TableHeaderCell label="Price" />

              <TableHeaderCell label="Status" />

              <TableHeaderCell label="Actions" />
            </template>

            <!-- Table Body -->
            <template #table-data="{ item }">
              <TableDataCell>
                {{ item?.id }}
              </TableDataCell>

              <ImageCell :src="item?.image" />

              <TableDataCell>
                <div class="min-w-[300px]">
                  {{ item?.name }}
                </div>
              </TableDataCell>

              <TableDataCell>
                {{ item?.qty }}
              </TableDataCell>

              <TableDataCell>
                {{ formatAmount(item?.price) }}
              </TableDataCell>

              <TableDataCell>
                <OrangeBadge v-show="item?.status === 'draft'">
                  <i class="fa-solid fa-file-pen animate-pulse"></i>
                  {{ item?.status }}
                </OrangeBadge>
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
              </TableDataCell>

              <TableActionCell>
                <NormalButton
                  v-show="item?.status === 'draft'"
                  class="bg-slate-600 text-white ring-2 ring-slate-300"
                >
                  <i class="fa-solid fa-paper-plane"></i>
                  {{ __('Request') }}
                </NormalButton>

                <InertiaLinkButton
                  to="seller.products.edit"
                  :targetIdentifier="{ product: item?.slug }"
                >
                  <i class="fa-solid fa-edit"></i>
                  {{ __('Edit') }}
                </InertiaLinkButton>

                <NormalButton
                  @click="softDeleteAction('Product', 'seller.products.destroy', item?.slug)"
                  class="bg-red-600 text-white ring-2 ring-red-300"
                >
                  <i class="fa-solid fa-trash-can"></i>
                  {{ __('Delete') }}
                </NormalButton>
              </TableActionCell>
            </template>
          </ActionTable>
        </TableContainer>

        <Pagination :data="products" />

        <NoTableData v-show="!products.data.length" />
      </div>
      <!-- Table End -->
    </div>
  </SellerDashboardLayout>
</template>
