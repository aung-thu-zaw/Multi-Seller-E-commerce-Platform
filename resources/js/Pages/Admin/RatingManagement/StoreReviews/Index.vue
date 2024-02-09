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
import GreenBadge from '@/Components/Badges/GreenBadge.vue'
import RedBadge from '@/Components/Badges/RedBadge.vue'
import OrangeBadge from '@/Components/Badges/OrangeBadge.vue'
import StarRating from '@/Components/Ratings/StarRating.vue'
import BulkActionButton from '@/Components/Buttons/BulkActionButton.vue'
import InertiaLinkButton from '@/Components/Buttons/InertiaLinkButton.vue'
import NormalButton from '@/Components/Buttons/NormalButton.vue'
import Pagination from '@/Components/Paginations/DashboardPagination.vue'
import { useResourceActions } from '@/Composables/useResourceActions'
import { Head } from '@inertiajs/vue3'
import { __ } from '@/Services/translations-inside-setup.js'

defineProps({ storeReviews: Object })

const storeReviewList = 'admin.store-reviews.index'

const { softDeleteAction, softDeleteSelectedAction } = useResourceActions()
</script>

<template>
  <Head :title="__('Store Reviews')" />

  <AdminDashboardLayout>
    <!-- Breadcrumb And Trash Button  -->
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb :to="storeReviewList" icon="fa-store" label="Store Reviews">
          <BreadcrumbItem label="List" />
        </Breadcrumb>
      </div>

      <div class="flex items-center justify-end mb-3">
        <!-- Trash Button -->
        <InertiaLinkButton
          v-show="can('store-reviews.view.trash')"
          to="admin.store-reviews.trashed"
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
            :placeholder="__('Search by :label', { label: __('Comment') })"
            :to="storeReviewList"
          />

          <div class="flex items-center justify-end w-full md:space-x-5">
            <DashboardTableDataPerPageSelectBox :to="storeReviewList" />

            <DashboardTableFilter
              :to="storeReviewList"
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
        <FilteredBy :to="storeReviewList" />

        <TableContainer>
          <ActionTable :items="storeReviews.data">
            <!-- Table Actions -->
            <template #bulk-actions="{ selectedItems }">
              <BulkActionButton
                v-show="can('store-reviews.delete')"
                @click="
                  softDeleteSelectedAction(
                    'Store Reviews',
                    'admin.store-reviews.destroy.selected',
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
              <SortableTableHeaderCell label="Id" :to="storeReviewList" sort="id" />

              <TableHeaderCell label="Reviewer" />

              <TableHeaderCell label="Rating" />

              <SortableTableHeaderCell label="Comment" :to="storeReviewList" sort="comment" />

              <TableHeaderCell label="Response Status" />

              <TableHeaderCell label="Review Status" />

              <TableHeaderCell label="Actions" />
            </template>

            <!-- Table Body -->
            <template #table-data="{ item }">
              <TableDataCell>
                {{ item?.id }}
              </TableDataCell>

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

                <NormalButton
                  v-show="can('store-reviews.delete')"
                  @click="
                    softDeleteAction('Store Review', 'admin.store-reviews.destroy', {
                      store_review: item?.id
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

        <Pagination :data="storeReviews" />

        <NoTableData v-show="!storeReviews.data.length" />
      </div>
      <!-- Table End -->
    </div>
  </AdminDashboardLayout>
</template>
