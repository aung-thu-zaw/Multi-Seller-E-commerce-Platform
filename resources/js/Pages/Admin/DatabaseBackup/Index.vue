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
import TableHeaderCell from '@/Components/Tables/TableCells/TableHeaderCell.vue'
import TableDataCell from '@/Components/Tables/TableCells/TableDataCell.vue'
import TableActionCell from '@/Components/Tables/TableCells/TableActionCell.vue'
import NoTableData from '@/Components/Tables/NoTableData.vue'
import BulkActionButton from '@/Components/Buttons/BulkActionButton.vue'
import NormalButton from '@/Components/Buttons/NormalButton.vue'
import Pagination from '@/Components/Paginations/DashboardPagination.vue'
import { useResourceActions } from '@/Composables/useResourceActions'
import { Head, router, usePage } from '@inertiajs/vue3'
import { __ } from '@/Services/translations-inside-setup.js'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'

defineProps({ backups: Object })

const backupList = 'admin.database-backups.index'

const { softDeleteAction, softDeleteSelectedAction } = useResourceActions()

const handleDownloadFile = (filename) => {
  router.get(
    route('admin.database-backups.download', { file: filename }),
    {},
    {
      onSuccess: () => {
        const successMessage = usePage().props.flash.success
        if (successMessage) {
          toast.success(__(successMessage), {
            autoClose: 2000
          })
        }
        const errorMessage = usePage().props.flash.error
        if (errorMessage) {
          toast.error(__(errorMessage), {
            autoClose: 2000
          })
        }
      }
    }
  )
}

const handleCreateANewBackup = () => {
  router.post(
    route('admin.database-backups.backup'),
    {},
    {
      onSuccess: () => {
        const successMessage = usePage().props.flash.success
        if (successMessage) {
          toast.success(__(successMessage), {
            autoClose: 2000
          })
        }
        const errorMessage = usePage().props.flash.error
        if (errorMessage) {
          toast.error(__(errorMessage), {
            autoClose: 2000
          })
        }
      }
    }
  )
}
</script>

<template>
  <Head :title="__('Database Backups')" />

  <AdminDashboardLayout>
    <!-- Breadcrumb And Trash Button  -->
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb :to="backupList" icon="fa-database" label="Database Backups">
          <BreadcrumbItem label="List" />
        </Breadcrumb>
      </div>

      <div class="flex items-center justify-between mb-3">
        <!-- Create New Button -->
        <NormalButton v-show="can('database-backups.create')" @click="handleCreateANewBackup">
          <i class="fa-solid fa-file-circle-plus mr-1"></i>
          {{ __('Create A New :label', { label: __('Backup') }) }}
        </NormalButton>
      </div>

      <!-- Table Start -->
      <div class="border bg-white rounded-md shadow px-5 py-3">
        <div
          class="my-3 flex flex-col sm:flex-row space-y-5 sm:space-y-0 items-center justify-between overflow-auto p-2"
        >
          <DashboardTableDataSearchBox
            :placeholder="__('Search by :label', { label: __('Url') })"
            :to="backupList"
          />

          <div class="flex items-center justify-end w-full md:space-x-5">
            <DashboardTableDataPerPageSelectBox :to="backupList" />

            <DashboardTableFilter
              :to="backupList"
              :filterBy="['created', 'status']"
              :options="[
                {
                  label: 'Show',
                  value: 'show'
                },
                {
                  label: 'Hide',
                  value: 'hide'
                }
              ]"
            />
          </div>
        </div>

        <!-- Filtered By -->
        <FilteredBy :to="backupList" />

        <TableContainer>
          <ActionTable :items="backups">
            <!-- Table Actions -->
            <!-- <template #bulk-actions="{ selectedItems }">
              <BulkActionButton
                v-show="can('database-backups.delete')"
                @click="
                  softDeleteSelectedAction(
                    'Database Backups',
                    'admin.database-backups.destroy.selected',
                    selectedItems
                  )
                "
                class="text-red-600"
              >
                <i class="fa-solid fa-trash-can"></i>
                {{ __('Delete Selected') }} ({{ selectedItems.length }})
              </BulkActionButton>
            </template> -->

            <!-- Table Header -->
            <template #table-header>
              <TableHeaderCell label="Location" />

              <TableHeaderCell label="File Name" />

              <TableHeaderCell label="Size" />

              <TableHeaderCell label="Date" />

              <TableHeaderCell label="Actions" />
            </template>

            <!-- Table Body -->
            <template #table-data="{ item }">
              <TableDataCell>
                {{ item?.location }}
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[200px]">
                  {{ item?.filename }}
                </div>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[100px]">
                  {{ item?.size }}
                </div>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[250px]">
                  {{ item?.date }}
                </div>
              </TableDataCell>

              <TableActionCell>
                <NormalButton
                  v-show="can('database-backups.download')"
                  @click="handleDownloadFile(item.filename)"
                  class="bg-yellow-600 text-white ring-2 ring-yellow-300"
                >
                  <i class="fa-solid fa-download"></i>
                  {{ __('Download') }}
                </NormalButton>

                <NormalButton
                  v-show="can('database-backups.delete')"
                  @click="
                    softDeleteAction('Database Backup', 'admin.database-backups.destroy', {
                      file: item?.filename
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

        <!-- <Pagination :data="backups" /> -->

        <NoTableData v-show="!backups.length" />
      </div>
      <!-- Table End -->
    </div>
  </AdminDashboardLayout>
</template>
