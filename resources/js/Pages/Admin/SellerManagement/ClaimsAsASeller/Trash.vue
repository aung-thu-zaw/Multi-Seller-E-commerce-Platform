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
import GreenBadge from '@/Components/Badges/GreenBadge.vue'
import RedBadge from '@/Components/Badges/RedBadge.vue'
import OrangeBadge from '@/Components/Badges/OrangeBadge.vue'
import BlueBadge from '@/Components/Badges/BlueBadge.vue'
import NoTableData from '@/Components/Tables/NoTableData.vue'
import BulkActionButton from '@/Components/Buttons/BulkActionButton.vue'
import InertiaLinkButton from '@/Components/Buttons/InertiaLinkButton.vue'
import NormalButton from '@/Components/Buttons/NormalButton.vue'
import EmptyTrashButton from '@/Components/Buttons/EmptyTrashButton.vue'
import Pagination from '@/Components/Paginations/DashboardPagination.vue'
import { Head } from '@inertiajs/vue3'
import { __ } from '@/Services/translations-inside-setup.js'
import { useResourceActions } from '@/Composables/useResourceActions'

defineProps({ trashedSellerRequests: Object })

const claimsAsASellerList = 'admin.claims-as-a-seller.index'

const trashedClaimsAsASellerList = 'admin.claims-as-a-seller.trashed'

const {
  restoreAction,
  restoreSelectedAction,
  permanentDeleteAction,
  permanentDeleteSelectedAction,
  permanentDeleteAllAction
} = useResourceActions()
</script>

<template>
  <Head :title="__('Deleted :label', { label: __('Claims As A Seller') })" />

  <AdminDashboardLayout>
    <!-- Breadcrumb And Go back Button  -->
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb :to="claimsAsASellerList" icon="fa-user-tie" label="Claims As A Seller">
          <BreadcrumbLinkItem label="Trash" :to="trashedClaimsAsASellerList" />
          <BreadcrumbItem label="List" />
        </Breadcrumb>

        <div class="w-auto flex items-center justify-end">
          <InertiaLinkButton
            :to="claimsAsASellerList"
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
        v-if="can('claims-as-a-seller.force.delete') && trashedSellerRequests.data.length !== 0"
        class="text-left text-sm font-bold mb-5 text-warning-600"
      >
        {{
          __(':label in the trash will be automatically deleted after 60 days', {
            label: __('Claims As A Seller')
          })
        }}

        <EmptyTrashButton
          @click="
            permanentDeleteAllAction(
              'Claims As A Seller',
              'admin.claims-as-a-seller.force-delete.all'
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
            :placeholder="__('Search by :label', { label: __('Store Name') })"
            :to="trashedClaimsAsASellerList"
          />

          <div class="flex items-center justify-end w-full md:space-x-5">
            <DashboardTableDataPerPageSelectBox :to="trashedClaimsAsASellerList" />

            <DashboardTableFilter :to="trashedClaimsAsASellerList" :filterBy="['deleted']" />
          </div>
        </div>

        <!-- Filtered By -->
        <FilteredBy :to="trashedClaimsAsASellerList" />

        <TableContainer>
          <ActionTable :items="trashedSellerRequests.data">
            <!-- Table Actions -->
            <template #bulk-actions="{ selectedItems }">
              <BulkActionButton
                v-show="can('claims-as-a-seller.restore')"
                @click="
                  restoreSelectedAction(
                    'Claims As A Seller',
                    'admin.claims-as-a-seller.restore.selected',
                    selectedItems
                  )
                "
              >
                <i class="fa-solid fa-recycle"></i>
                {{ __('Restore Selected') }} ({{ selectedItems.length }})
              </BulkActionButton>

              <BulkActionButton
                v-show="can('claims-as-a-seller.force.delete')"
                @click="
                  permanentDeleteSelectedAction(
                    'Claims As A Seller',
                    'admin.claims-as-a-seller.force-delete.selected',
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
              <SortableTableHeaderCell label="Id" :to="trashedClaimsAsASellerList" sort="id" />

              <SortableTableHeaderCell
                label="Store Name"
                :to="trashedClaimsAsASellerList"
                sort="store_name"
              />

              <TableHeaderCell label="Store Type" />

              <SortableTableHeaderCell
                label="Contact Email"
                :to="trashedClaimsAsASellerList"
                sort="contact_email"
              />

              <SortableTableHeaderCell
                label="Contact Phone"
                :to="trashedClaimsAsASellerList"
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
                <NormalButton
                  v-show="can('claims-as-a-seller.restore')"
                  @click="
                    restoreAction('Claim As A Seller', 'admin.claims-as-a-seller.restore', {
                      id: item?.id
                    })
                  "
                >
                  <i class="fa-solid fa-recycle"></i>
                  {{ __('Restore') }}
                </NormalButton>

                <NormalButton
                  v-show="can('claims-as-a-seller.force.delete')"
                  @click="
                    permanentDeleteAction(
                      'Claim As A Seller',
                      'admin.claims-as-a-seller.force-delete',
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

        <Pagination :data="trashedSellerRequests" />

        <NoTableData v-show="!trashedSellerRequests.data.length" />
      </div>
      <!-- Table End -->
    </div>
  </AdminDashboardLayout>
</template>
