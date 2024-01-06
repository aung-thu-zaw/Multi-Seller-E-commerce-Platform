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
import ImageCell from '@/Components/Tables/TableCells/TableImageCell.vue'
import NoTableData from '@/Components/Tables/NoTableData.vue'
import GreenBadge from '@/Components/Badges/GreenBadge.vue'
import OrangeBadge from '@/Components/Badges/OrangeBadge.vue'
import BulkActionButton from '@/Components/Buttons/BulkActionButton.vue'
import InertiaLinkButton from '@/Components/Buttons/InertiaLinkButton.vue'
import Pagination from '@/Components/Paginations/DashboardPagination.vue'
import { Head } from '@inertiajs/vue3'
import { __ } from '@/Services/translations-inside-setup.js'

defineProps({ productQuestions: Object })

const productQuestionList = 'seller.product-questions.index'
</script>

<template>
  <Head :title="__('Product Questions')" />

  <SellerDashboardLayout>
    <!-- Breadcrumb And Trash Button  -->
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb
          :to="productQuestionList"
          icon="fa-clipboard-question"
          label="Product Questions"
        >
          <BreadcrumbItem label="List" />
        </Breadcrumb>
      </div>

      <!-- Table Start -->
      <div class="border bg-white rounded-md shadow px-5 py-3">
        <div
          class="my-3 flex flex-col sm:flex-row space-y-5 sm:space-y-0 items-center justify-between overflow-auto p-2"
        >
          <DashboardTableDataSearchBox
            :placeholder="__('Search by :label', { label: __('Question') })"
            :to="productQuestionList"
          />

          <div class="flex items-center justify-end w-full md:space-x-5">
            <DashboardTableDataPerPageSelectBox :to="productQuestionList" />

            <DashboardTableFilter
              :to="productQuestionList"
              :filterBy="['created', 'status']"
              :options="[
                {
                  label: 'Awaiting',
                  value: 'awaiting'
                },
                {
                  label: 'Answered',
                  value: 'answered'
                }
              ]"
            />
          </div>
        </div>

        <!-- Filtered By -->
        <FilteredBy :to="productQuestionList" />

        <TableContainer>
          <ActionTable :items="productQuestions.data">
            <!-- Table Actions -->
            <template #bulk-actions="{ selectedItems }">
              <BulkActionButton
                @click="
                  softDeleteSelectedAction(
                    'Product Questions',
                    'seller.product-questions.destroy.selected',
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

              <TableHeaderCell label="Product" />

              <SortableTableHeaderCell label="Question" :to="productQuestionList" sort="question" />

              <TableHeaderCell label="Status" />

              <TableHeaderCell label="Actions" />
            </template>

            <!-- Table Body -->
            <template #table-data="{ item }">
              <ImageCell :src="item?.product?.image" />

              <TableDataCell>
                <div class="min-w-[250px]">
                  {{ item?.product?.name }}
                </div>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[250px]">
                  {{ item?.question }}
                </div>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[150px]">
                  <OrangeBadge v-show="item?.status === 'awaiting'">
                    <i class="fa-solid fa-spinner animate-spin"></i>
                    awaiting response
                  </OrangeBadge>
                  <GreenBadge v-show="item?.status === 'answered'">
                    <i class="fa-solid fa-circle-check animate-pulse"></i>
                    {{ item?.status }}
                  </GreenBadge>
                </div>
              </TableDataCell>

              <TableActionCell>
                <InertiaLinkButton
                  to="products.show"
                  :targetIdentifier="{ product: item?.product?.slug }"
                  :data="{ tab: 'questions-and-answers' }"
                >
                  <i class="fa-solid fa-arrow-right"></i>
                  {{ __('Go To Question') }}
                </InertiaLinkButton>
              </TableActionCell>
            </template>
          </ActionTable>
        </TableContainer>

        <Pagination :data="productQuestions" />

        <NoTableData v-show="!productQuestions.data.length" />
      </div>
      <!-- Table End -->
    </div>
  </SellerDashboardLayout>
</template>
