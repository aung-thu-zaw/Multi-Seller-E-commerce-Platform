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
import BlueBadge from '@/Components/Badges/BlueBadge.vue'
import BulkActionButton from '@/Components/Buttons/BulkActionButton.vue'
import InertiaLinkButton from '@/Components/Buttons/InertiaLinkButton.vue'
import NormalButton from '@/Components/Buttons/NormalButton.vue'
import Pagination from '@/Components/Paginations/DashboardPagination.vue'
import { useResourceActions } from '@/Composables/useResourceActions'
import { Head } from '@inertiajs/vue3'
import { __ } from '@/Services/translations-inside-setup.js'

defineProps({ sellerRequests: Object })

const claimsAsASellerList = 'admin.claims-as-a-seller.index'

const { softDeleteAction, softDeleteSelectedAction } = useResourceActions()
</script>

<template>
  <Head :title="__('Claims as a seller')" />

  <AdminDashboardLayout>
    <!-- Breadcrumb And Trash Button  -->
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb :to="claimsAsASellerList" icon="fa-user-tie" label="Claims as a seller">
          <BreadcrumbItem label="List" />
        </Breadcrumb>
      </div>

      <div class="flex items-center justify-end mb-3">
        <!-- Trash Button -->
        <InertiaLinkButton
          v-show="can('claims-as-a-seller.view.trash')"
          to="admin.claims-as-a-seller.trashed"
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
            :placeholder="__('Search by :label', { label: __('Store Name') })"
            :to="claimsAsASellerList"
          />

          <div class="flex items-center justify-end w-full md:space-x-5">
            <DashboardTableDataPerPageSelectBox :to="claimsAsASellerList" />

            <DashboardTableFilter
              :to="claimsAsASellerList"
              :filterBy="['created', 'status']"
              :options="[
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
        <FilteredBy :to="claimsAsASellerList" />

        <TableContainer>
          <ActionTable :items="sellerRequests.data">
            <!-- Table Actions -->
            <template #bulk-actions="{ selectedItems }">
              <BulkActionButton
                v-show="can('claims-as-a-seller.delete')"
                @click="
                  softDeleteSelectedAction(
                    'Claims as a seller',
                    'admin.claims-as-a-seller.destroy.selected',
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
              <SortableTableHeaderCell label="Id" :to="claimsAsASellerList" sort="id" />

              <SortableTableHeaderCell
                label="Store Name"
                :to="claimsAsASellerList"
                sort="store_name"
              />

              <TableHeaderCell label="Store Type" />

              <SortableTableHeaderCell
                label="Contact Email"
                :to="claimsAsASellerList"
                sort="contact_email"
              />

              <SortableTableHeaderCell
                label="Contact Phone"
                :to="claimsAsASellerList"
                sort="contact_phone"
              />

              <TableHeaderCell label="Status" />

              <TableHeaderCell label="Actions" />
            </template>

            <!-- Table Body -->
            <template #table-data="{ item }">
              <TableDataCell>
                {{ item?.id }}
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[150px]">
                  {{ item?.store_name }}
                </div>
              </TableDataCell>

              <TableDataCell>
                <OrangeBadge v-show="item?.store_type === 'personal'">
                  {{ item?.store_type }}
                </OrangeBadge>
                <GreenBadge v-show="item?.store_type === 'business'">
                  {{ item?.store_type }}
                </GreenBadge>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[150px]">
                  {{ item?.contact_email }}
                </div>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[150px]">
                  {{ item?.contact_phone }}
                </div>
              </TableDataCell>

              <TableDataCell>
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
                <InertiaLinkButton
                  v-show="can('claims-as-a-seller.view')"
                  to="admin.claims-as-a-seller.show"
                  :targetIdentifier="{ seller_request: item?.id }"
                  class="bg-sky-600 text-white ring-2 ring-sky-300"
                >
                  <i class="fa-solid fa-eye"></i>
                  {{ __('Details') }}
                </InertiaLinkButton>

                <NormalButton
                  v-show="can('claims-as-a-seller.delete')"
                  @click="
                    softDeleteAction('Claim as a seller', 'admin.claims-as-a-seller.destroy', {
                      seller_request: item?.id
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

        <Pagination :data="sellerRequests" />

        <NoTableData v-show="!sellerRequests.data.length" />
      </div>
      <!-- Table End -->
    </div>
  </AdminDashboardLayout>
</template>
