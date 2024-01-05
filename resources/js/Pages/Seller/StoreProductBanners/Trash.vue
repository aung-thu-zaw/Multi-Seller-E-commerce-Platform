<script setup>
import SellerDashboardLayout from '@/Layouts/SellerDashboardLayout.vue'
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

defineProps({ trashedStoreProductBanners: Object })

const storeProductBannerList = 'seller.store-product-banners.index'

const trashedStoreProductBannerList = 'seller.store-product-banners.trashed'

const {
  restoreAction,
  restoreSelectedAction,
  permanentDeleteAction,
  permanentDeleteSelectedAction,
  permanentDeleteAllAction
} = useResourceActions()
</script>

<template>
  <Head :title="__('Deleted :label', { label: __('Product Banners') })" />

  <SellerDashboardLayout>
    <!-- Breadcrumb And Go back Button  -->
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb :to="storeProductBannerList" icon="fa-ad" label="Product Banners">
          <BreadcrumbLinkItem label="Trash" :to="trashedStoreProductBannerList" />
          <BreadcrumbItem label="List" />
        </Breadcrumb>

        <div class="w-auto flex items-center justify-end">
          <InertiaLinkButton
            :to="storeProductBannerList"
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
        v-if="trashedStoreProductBanners.data.length !== 0"
        class="text-left text-sm font-bold mb-5 text-warning-600"
      >
        {{
          __(':label in the trash will be automatically deleted after 60 days', {
            label: __('Product Banners')
          })
        }}

        <EmptyTrashButton
          @click="
            permanentDeleteAllAction(
              'Product Banner',
              'seller.store-product-banners.force-delete.all'
            )
          "
        />
      </div>

      <!-- Table Start -->
      <div class="border bg-white rounded-md shadow px-5 py-3">
        <div
          class="my-3 flex flex-col sm:flex-row space-y-5 sm:space-y-0 items-center justify-between overflow-auto p-2"
        >
          <DashboardTableDataSearchBox
            :placeholder="__('Search by :label', { label: __('Url') })"
            :to="trashedStoreProductBannerList"
          />

          <div class="flex items-center justify-end w-full md:space-x-5">
            <DashboardTableDataPerPageSelectBox :to="trashedStoreProductBannerList" />

            <DashboardTableFilter :to="trashedStoreProductBannerList" :filterBy="['deleted']" />
          </div>
        </div>

        <!-- Filtered By -->
        <FilteredBy :to="trashedStoreProductBannerList" />

        <TableContainer>
          <ActionTable :items="trashedStoreProductBanners.data">
            <!-- Table Actions -->
            <template #bulk-actions="{ selectedItems }">
              <BulkActionButton
                @click="
                  restoreSelectedAction(
                    'Product Banners',
                    'seller.store-product-banners.restore.selected',
                    selectedItems
                  )
                "
              >
                <i class="fa-solid fa-recycle"></i>
                {{ __('Restore Selected') }} ({{ selectedItems.length }})
              </BulkActionButton>

              <BulkActionButton
                @click="
                  permanentDeleteSelectedAction(
                    'Product Banners',
                    'seller.store-product-banners.force-delete.selected',
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
              <TableHeaderCell label="Image" />

              <SortableTableHeaderCell label="Url" :to="trashedStoreProductBannerList" sort="url" />

              <TableHeaderCell label="Actions" />
            </template>

            <!-- Table Body -->
            <template #table-data="{ item }">
              <ImageCell :src="item?.image" />

              <TableDataCell>
                {{ item?.url }}
              </TableDataCell>

              <TableActionCell>
                <NormalButton
                  @click="
                    restoreAction('Product Banner', 'seller.store-product-banners.restore', {
                      id: item?.id
                    })
                  "
                >
                  <i class="fa-solid fa-recycle"></i>
                  {{ __('Restore') }}
                </NormalButton>

                <NormalButton
                  @click="
                    permanentDeleteAction(
                      'Product Banner',
                      'seller.store-product-banners.force-delete',
                      {
                        id: item?.id
                      }
                    )
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

        <Pagination :data="trashedStoreProductBanners" />

        <NoTableData v-show="!trashedStoreProductBanners.data.length" />
      </div>
      <!-- Table End -->
    </div>
  </SellerDashboardLayout>
</template>
