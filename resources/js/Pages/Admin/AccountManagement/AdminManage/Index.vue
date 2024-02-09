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
import ImageCell from '@/Components/Tables/TableCells/TableImageCell.vue'
import NoTableData from '@/Components/Tables/NoTableData.vue'
import OrangeBadge from '@/Components/Badges/OrangeBadge.vue'
import GreenBadge from '@/Components/Badges/GreenBadge.vue'
import BlueBadge from '@/Components/Badges/BlueBadge.vue'
import BulkActionButton from '@/Components/Buttons/BulkActionButton.vue'
import InertiaLinkButton from '@/Components/Buttons/InertiaLinkButton.vue'
import NormalButton from '@/Components/Buttons/NormalButton.vue'
import Pagination from '@/Components/Paginations/DashboardPagination.vue'
import { useResourceActions } from '@/Composables/useResourceActions'
import { Head } from '@inertiajs/vue3'
import { __ } from '@/Services/translations-inside-setup.js'

defineProps({ admins: Object })

const adminList = 'admin.admin-manage.index'

const { changeStatusAction, softDeleteAction, softDeleteSelectedAction } = useResourceActions()
</script>

<template>
  <Head :title="__('Admins')" />

  <AdminDashboardLayout>
    <!-- Breadcrumb And Trash Button  -->
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb :to="adminList" icon="fa-user-tie" label="Admin Manage">
          <BreadcrumbItem label="List" />
        </Breadcrumb>
      </div>

      <div class="flex items-center justify-between mb-3">
        <!-- Create New Button -->
        <InertiaLinkButton v-show="can('admin-manage.create')" to="admin.admin-manage.create">
          <i class="fa-solid fa-file-circle-plus mr-1"></i>
          {{ __('Create A New :label', { label: __('Admin Account') }) }}
        </InertiaLinkButton>

        <!-- Trash Button -->
        <InertiaLinkButton
          v-show="can('admin-manage.view.trash')"
          to="admin.admin-manage.trashed"
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
            :to="adminList"
          />

          <div class="flex items-center justify-end w-full md:space-x-5">
            <DashboardTableDataPerPageSelectBox :to="adminList" />

            <DashboardTableFilter
              :to="adminList"
              :filterBy="['created', 'status']"
              :options="[
                {
                  label: 'Active',
                  value: 'active'
                },
                {
                  label: 'Suspended',
                  value: 'suspended'
                }
              ]"
            />
          </div>
        </div>

        <!-- Filtered By -->
        <FilteredBy :to="adminList" />

        <TableContainer>
          <ActionTable :items="admins.data">
            <!-- Table Actions -->
            <template #bulk-actions="{ selectedItems }">
              <BulkActionButton
                v-show="can('admin-manage.delete')"
                @click="
                  softDeleteSelectedAction(
                    'Admins',
                    'admin.admin-manage.destroy.selected',
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
              <SortableTableHeaderCell label="Id" :to="adminList" sort="id" />

              <TableHeaderCell label="Avatar" />

              <SortableTableHeaderCell label="Name" :to="adminList" sort="name" />

              <SortableTableHeaderCell label="Email" :to="adminList" sort="email" />

              <TableHeaderCell label="Role" />

              <TableHeaderCell label="Status" />

              <TableHeaderCell label="Actions" />
            </template>

            <!-- Table Body -->
            <template #table-data="{ item }">
              <TableDataCell>
                {{ item?.id }}
              </TableDataCell>

              <ImageCell :src="item?.avatar" />

              <TableDataCell>
                <div class="min-w-[150px]">
                  {{ item?.name }}
                </div>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[150px]">
                  {{ item?.email }}
                </div>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[100px]">
                  <BlueBadge v-if="item.roles.length">
                    {{ item?.roles[0]?.name }}
                  </BlueBadge>
                </div>
              </TableDataCell>

              <TableDataCell>
                <GreenBadge v-show="item?.status === 'active'">
                  <i class="fa-solid fa-user-check animate-pulse"></i>
                  {{ item?.status }}
                </GreenBadge>
                <OrangeBadge v-show="item?.status === 'suspended'">
                  <i class="fa-solid fa-user-xmark animate-pulse"></i>
                  {{ item?.status }}
                </OrangeBadge>
              </TableDataCell>

              <TableActionCell>
                <NormalButton
                  v-show="can('admin-manage.edit')"
                  @click="
                    changeStatusAction(
                      'Admin',
                      'admin.admin-manage.change-status',
                      { user: item?.id },
                      item?.status
                    )
                  "
                  :class="{
                    'bg-emerald-600 text-white ring-2 ring-emerald-300':
                      item?.status === 'suspended',
                    'bg-amber-600 text-white ring-2 ring-amber-300': item?.status === 'active'
                  }"
                >
                  <i
                    class="fa-solid"
                    :class="{
                      'fa-user-xmark': item?.status === 'active',
                      'fa-user-check': item?.status === 'suspended'
                    }"
                  ></i>
                  {{ item?.status === 'active' ? __('Suspend') : __('Active') }}
                </NormalButton>

                <InertiaLinkButton
                  v-show="can('admin-manage.edit')"
                  to="admin.admin-manage.edit"
                  :targetIdentifier="{ user: item?.id }"
                >
                  <i class="fa-solid fa-edit"></i>
                  {{ __('Edit') }}
                </InertiaLinkButton>

                <NormalButton
                  v-show="can('admin-manage.delete')"
                  @click="
                    softDeleteAction('Admin', 'admin.admin-manage.destroy', {
                      user: item?.id
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

        <Pagination :data="admins" />

        <NoTableData v-show="!admins.data.length" />
      </div>
      <!-- Table End -->
    </div>
  </AdminDashboardLayout>
</template>
