<script setup>
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue'
import Breadcrumb from '@/Components/Breadcrumbs/Breadcrumb.vue'
import BreadcrumbItem from '@/Components/Breadcrumbs/BreadcrumbItem.vue'
import TableContainer from '@/Components/Tables/TableContainer.vue'
import Table from '@/Components/Tables/Table.vue'
import DashboardTableDataPerPageSelectBox from '@/Components/Forms/SelectBoxs/DashboardTableDataPerPageSelectBox.vue'
import GreenBadge from '@/Components/Badges/GreenBadge.vue'
import RedBadge from '@/Components/Badges/RedBadge.vue'
import TableHeaderCell from '@/Components/Tables/TableCells/TableHeaderCell.vue'
import TableDataCell from '@/Components/Tables/TableCells/TableDataCell.vue'
import TableActionCell from '@/Components/Tables/TableCells/TableActionCell.vue'
import NoTableData from '@/Components/Tables/NoTableData.vue'
import NormalButton from '@/Components/Buttons/NormalButton.vue'
import Pagination from '@/Components/Paginations/DashboardPagination.vue'
import { useResourceActions } from '@/Composables/useResourceActions'
import { Head, router, usePage } from '@inertiajs/vue3'
import { __ } from '@/Services/translations-inside-setup.js'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'
import axios from 'axios'

defineProps({ backupsPaginated: Object, overAllInformation: Object })

const backupList = 'admin.database-backups.index'

const { softDeleteAction } = useResourceActions()

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

const handleDownloadBackup = async (filename) => {
  try {
    const response = await axios.get(route('admin.database-backups.download', { file: filename }), {
      responseType: 'blob'
    })

    const url = window.URL.createObjectURL(new Blob([response.data]))
    const link = document.createElement('a')

    link.href = url
    link.setAttribute('download', filename)
    document.body.appendChild(link)
    link.click()
  } catch (error) {
    if (error) {
      toast.error(__(error), {
        autoClose: 2000
      })
    }
  }
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

      <div class="border bg-white rounded-md shadow px-5 pt-6 mb-5">
        <TableContainer>
          <Table :items="[overAllInformation]">
            <!-- Table Header -->
            <template #table-header>
              <TableHeaderCell label="Disk" />

              <TableHeaderCell label="Disk Health" />

              <TableHeaderCell label="Total Backups" />

              <TableHeaderCell label="Last Time Backup" />

              <TableHeaderCell label="Used Storage" />
            </template>

            <!-- Table Body -->
            <template #table-data="{ item }">
              <TableDataCell>
                {{ item?.disk }}
              </TableDataCell>
              <TableDataCell>
                <GreenBadge v-show="item.health === 'Healthy'">
                  <i class="fa-solid fa-circle-check"></i>
                  {{ item.health }}
                </GreenBadge>
                <RedBadge v-show="item.health === 'Not Healthy'">
                  <i class="fa-solid fa-circle-xmar"></i>
                  {{ item.health }}
                </RedBadge>
              </TableDataCell>

              <TableDataCell>
                {{ item?.amountOfBackups }}
              </TableDataCell>

              <TableDataCell>
                {{ item?.lastTimeBackup }}
              </TableDataCell>

              <TableDataCell>
                {{ item?.usedBackupStorage }}
              </TableDataCell>
            </template>
          </Table>
        </TableContainer>
      </div>

      <!-- Table Start -->
      <div class="border bg-white rounded-md shadow px-5 py-3">
        <div class="my-3 flex items-center justify-between overflow-auto w-full p-2">
          <!-- Create New Button -->
          <div class="w-full">
            <NormalButton v-show="can('database-backups.create')" @click="handleCreateANewBackup">
              <i class="fa-solid fa-file-circle-plus mr-1"></i>
              {{ __('Create A New :label', { label: __('Backup') }) }}
            </NormalButton>
          </div>

          <div class="flex items-center justify-end w-full md:space-x-5">
            <DashboardTableDataPerPageSelectBox :to="backupList" />
          </div>
        </div>

        <TableContainer>
          <Table :items="backupsPaginated.data">
            <!-- Table Header -->
            <template #table-header>
              <TableHeaderCell label="Location" />

              <TableHeaderCell label="File Name" />

              <TableHeaderCell label="Size" />

              <TableHeaderCell label="Created At" />

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
                  @click="handleDownloadBackup(item.filename)"
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
          </Table>
        </TableContainer>

        <Pagination :data="backupsPaginated" />

        <NoTableData v-show="!backupsPaginated.data" />
      </div>
      <!-- Table End -->
    </div>
  </AdminDashboardLayout>
</template>
