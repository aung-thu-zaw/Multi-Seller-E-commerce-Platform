<script setup>
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue'
import Breadcrumb from '@/Components/Breadcrumbs/Breadcrumb.vue'
import BreadcrumbItem from '@/Components/Breadcrumbs/BreadcrumbItem.vue'
import TableContainer from '@/Components/Tables/TableContainer.vue'
import Table from '@/Components/Tables/Table.vue'
import DashboardTableDataSearchBox from '@/Components/Forms/SearchBoxs/DashboardTableDataSearchBox.vue'
import DashboardTableDataPerPageSelectBox from '@/Components/Forms/SelectBoxs/DashboardTableDataPerPageSelectBox.vue'
import FilteredBy from '@/Components/Tables/FilteredBy.vue'
import SortableTableHeaderCell from '@/Components/Tables/TableCells/SortableTableHeaderCell.vue'
import TableHeaderCell from '@/Components/Tables/TableCells/TableHeaderCell.vue'
import TableDataCell from '@/Components/Tables/TableCells/TableDataCell.vue'
import TableActionCell from '@/Components/Tables/TableCells/TableActionCell.vue'
import NoTableData from '@/Components/Tables/NoTableData.vue'
import InertiaLinkButton from '@/Components/Buttons/InertiaLinkButton.vue'
import BlueBadge from '@/Components/Badges/BlueBadge.vue'
import Pagination from '@/Components/Paginations/DashboardPagination.vue'
import { Head } from '@inertiajs/vue3'
import { __ } from '@/Services/translations-inside-setup.js'

defineProps({ rolesWithPermissions: Object })

const assignRolePermissionList = 'admin.assign-role-permissions.index'
</script>

<template>
  <Head :title="__('Assign Role Permissions')" />

  <AdminDashboardLayout>
    <!-- Breadcrumb And Trash Button  -->
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb
          :to="assignRolePermissionList"
          icon="fa-user-shield"
          label="Assign Role Permissions"
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
            :placeholder="__('Search by :label', { label: __('Role Name') })"
            :to="assignRolePermissionList"
          />

          <div class="flex items-center justify-end w-full md:space-x-5">
            <DashboardTableDataPerPageSelectBox :to="assignRolePermissionList" />
          </div>
        </div>

        <!-- Filtered By -->
        <FilteredBy :to="assignRolePermissionList" />

        <TableContainer>
          <Table :items="rolesWithPermissions.data">
            <!-- Table Header -->
            <template #table-header>
              <SortableTableHeaderCell label="Id" :to="assignRolePermissionList" sort="id" />

              <SortableTableHeaderCell label="Role" :to="assignRolePermissionList" sort="name" />

              <TableHeaderCell label="Permissions" />

              <TableHeaderCell label="Actions" />
            </template>

            <!-- Table Body -->
            <template #table-data="{ item }">
              <TableDataCell>
                {{ item?.id }}
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[150px]">
                  {{ item?.name }}
                </div>
              </TableDataCell>

              <TableDataCell>
                <div
                  v-if="item?.permissions.length"
                  class="min-w-[800px] overflow-scroll flex items-center space-x-2 py-3"
                >
                  <BlueBadge v-for="permission in item?.permissions" :key="permission.id">
                    {{ permission.name }}
                  </BlueBadge>
                </div>
                <div v-else>
                  <p class="text-orange-500 text-xs font-bold">
                    {{ __(":label role doesn't have any permission.", { label: item?.name }) }}
                  </p>
                </div>
              </TableDataCell>

              <TableActionCell>
                <InertiaLinkButton
                  v-show="can('assign-role-permissions.edit')"
                  to="admin.assign-role-permissions.edit"
                  :targetIdentifier="{ role: item?.id }"
                  :class="{
                    'bg-emerald-600 text-white ring-2 ring-emerald-300': !item.permissions.length,
                    'bg-blue-600 text-white ring-2 ring-blue-300': item.permissions.length
                  }"
                >
                  <i class="fa-solid fa-key"></i>
                  {{ item?.permissions.length ? __('Change Permissions') : __('Add Permissions') }}
                </InertiaLinkButton>
              </TableActionCell>
            </template>
          </Table>
        </TableContainer>

        <Pagination :data="rolesWithPermissions" />

        <NoTableData v-show="!rolesWithPermissions.data.length" />
      </div>
      <!-- Table End -->
    </div>
  </AdminDashboardLayout>
</template>
