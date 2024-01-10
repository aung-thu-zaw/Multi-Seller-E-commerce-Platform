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
import OrangeBadge from '@/Components/Badges/OrangeBadge.vue'
import GreenBadge from '@/Components/Badges/GreenBadge.vue'
import RedBadge from '@/Components/Badges/RedBadge.vue'
import StarRating from '@/Components/Ratings/StarRating.vue'
import BulkActionButton from '@/Components/Buttons/BulkActionButton.vue'
import InertiaLinkButton from '@/Components/Buttons/InertiaLinkButton.vue'
import Pagination from '@/Components/Paginations/DashboardPagination.vue'
import { Head } from '@inertiajs/vue3'
import { __ } from '@/Services/translations-inside-setup.js'

defineProps({ storeReviews: Object })

const productReviewList = 'seller.store-reviews.index'
</script>

<template>
  <Head :title="__('Store Reviews')" />

  <SellerDashboardLayout>
    <!-- Breadcrumb And Trash Button  -->
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb :to="productReviewList" icon="fa-store" label="Store Reviews">
          <BreadcrumbItem label="List" />
        </Breadcrumb>
      </div>

      <!-- Table Start -->
      <div class="border bg-white rounded-md shadow px-5 py-3">
        <div
          class="my-3 flex flex-col sm:flex-row space-y-5 sm:space-y-0 items-center justify-between overflow-auto p-2"
        >
          <DashboardTableDataSearchBox
            :placeholder="__('Search by :label', { label: __('Comment') })"
            :to="productReviewList"
          />

          <div class="flex items-center justify-end w-full md:space-x-5">
            <DashboardTableDataPerPageSelectBox :to="productReviewList" />

            <DashboardTableFilter
              :to="productReviewList"
              :filterBy="['created', 'status']"
              :options="[
                {
                  label: 'Awaiting',
                  value: 'awaiting'
                },
                {
                  label: 'Responded',
                  value: 'responded'
                }
              ]"
            />
          </div>
        </div>

        <!-- Filtered By -->
        <FilteredBy :to="productReviewList" />

        <TableContainer>
          <ActionTable :items="storeReviews.data">
            <!-- Table Actions -->
            <template #bulk-actions="{ selectedItems }">
              <BulkActionButton
                @click="
                  softDeleteSelectedAction(
                    'Store Reviews',
                    'seller.store-reviews.destroy.selected',
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
              <TableHeaderCell label="Reviewer" />

              <TableHeaderCell label="Rating" />

              <SortableTableHeaderCell label="Comment" :to="productReviewList" sort="comment" />

              <TableHeaderCell label="Response Status" />

              <TableHeaderCell label="Review Status" />

              <TableHeaderCell label="Actions" />
            </template>

            <!-- Table Body -->
            <template #table-data="{ item }">
              <TableDataCell>
                <div class="min-w-[200px]">
                  {{ item?.reviewer?.name }}
                </div>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[150px]">
                  <StarRating :rating="item?.rating" />
                </div>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[250px]">
                  {{ item?.comment }}
                </div>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[150px]">
                  <OrangeBadge v-show="item?.response_status === 'awaiting'">
                    <i class="fa-solid fa-spinner animate-spin"></i>
                    awaiting response
                  </OrangeBadge>
                  <GreenBadge v-show="item?.response_status === 'responded'">
                    <i class="fa-solid fa-circle-check animate-pulse"></i>
                    {{ item?.response_status }}
                  </GreenBadge>
                </div>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[150px]">
                  <GreenBadge v-show="item?.status === 'approved'">
                    <i class="fa-solid fa-circle-check animate-pulse"></i>
                    {{ item?.status }}
                  </GreenBadge>
                  <RedBadge v-show="item?.status === 'rejected'">
                    <i class="fa-solid fa-circle-xmark animate-pulse"></i>
                    {{ item?.status }}
                  </RedBadge>
                </div>
              </TableDataCell>

              <TableActionCell>
                <InertiaLinkButton
                  to="stores.show"
                  :targetIdentifier="{ store: item.store?.slug }"
                  :data="{ tab: 'store-rating-and-reviews', rating: 'all', review_sort: 'recent' }"
                >
                  <i class="fa-solid fa-arrow-right"></i>
                  {{ __('Go To Review') }}
                </InertiaLinkButton>
              </TableActionCell>
            </template>
          </ActionTable>
        </TableContainer>

        <Pagination :data="storeReviews" />

        <NoTableData v-show="!storeReviews.data.length" />
      </div>
      <!-- Table End -->
    </div>
  </SellerDashboardLayout>
</template>
