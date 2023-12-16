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
import OptionDropdown from '@/Components/Dropdowns/OptionDropdown.vue'
import SortableTableHeaderCell from '@/Components/Tables/TableCells/SortableTableHeaderCell.vue'
import TableHeaderCell from '@/Components/Tables/TableCells/TableHeaderCell.vue'
import TableDataCell from '@/Components/Tables/TableCells/TableDataCell.vue'
import TableActionCell from '@/Components/Tables/TableCells/TableActionCell.vue'
import ImageCell from '@/Components/Tables/TableCells/TableImageCell.vue'
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
import { Head, Link } from '@inertiajs/vue3'
import { __ } from '@/Services/translations-inside-setup.js'

defineProps({ products: Object })

const productList = 'admin.products.index'

const { softDeleteAction, softDeleteSelectedAction } = useResourceActions()
</script>

<template>
  <Head :title="__('Products')" />

  <AdminDashboardLayout>
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
        <InertiaLinkButton v-show="can('products.create')" to="admin.products.create">
          <i class="fa-solid fa-file-circle-plus mr-1"></i>
          {{ __('Create A New :label', { label: __('Product') }) }}
        </InertiaLinkButton>

        <!-- Trash Button -->
        <InertiaLinkButton
          v-show="can('products.view.trash')"
          to="admin.products.trashed"
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
            :placeholder="__('Search by :label', { label: __('Product Name') })"
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
                v-show="can('products.delete')"
                @click="
                  softDeleteSelectedAction(
                    'Products',
                    'admin.products.destroy.selected',
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
              <SortableTableHeaderCell label="Id" :to="productList" sort="id" />

              <TableHeaderCell label="Image" />

              <SortableTableHeaderCell label="Name" :to="productList" sort="name" />

              <SortableTableHeaderCell label="Qty" :to="productList" sort="qty" />

              <SortableTableHeaderCell label="Price" :to="productList" sort="price" />

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
                <div class="min-w-[250px]">
                  {{ item?.name }}
                </div>
              </TableDataCell>

              <TableDataCell>
                {{ item?.qty }}
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[100px]">
                  {{ item?.price }}
                </div>
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
                <div class="min-w-[400px] space-x-3">
                  <NormalButton
                    v-show="item?.status === 'draft' && can('products.edit')"
                    class="bg-amber-600 text-white ring-2 ring-amber-300"
                  >
                    <i class="fa-solid fa-paper-plane"></i>
                    {{ __('Request') }}
                  </NormalButton>

                  <OptionDropdown v-show="can('products.edit')">
                    <Link
                      class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                      :href="route('admin.product.images', item?.slug)"
                    >
                      <i class="fa-solid fa-images"></i>
                      {{ __('Product Images') }}
                    </Link>
                  </OptionDropdown>

                  <InertiaLinkButton
                    v-show="can('products.edit')"
                    to="admin.products.edit"
                    :targetIdentifier="{ product: item?.slug }"
                  >
                    <i class="fa-solid fa-edit"></i>
                    {{ __('Edit') }}
                  </InertiaLinkButton>

                  <NormalButton
                    v-show="can('products.delete')"
                    @click="
                      softDeleteAction('Product', 'admin.products.destroy', { product: item?.slug })
                    "
                    class="bg-red-600 text-white ring-2 ring-red-300"
                  >
                    <i class="fa-solid fa-trash-can"></i>
                    {{ __('Delete') }}
                  </NormalButton>
                </div>
              </TableActionCell>
            </template>
          </ActionTable>
        </TableContainer>

        <Pagination :data="products" />

        <NoTableData v-show="!products.data.length" />
      </div>
      <!-- Table End -->
    </div>
  </AdminDashboardLayout>
</template>
