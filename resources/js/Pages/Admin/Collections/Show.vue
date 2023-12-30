<script setup>
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue'
import Breadcrumb from '@/Components/Breadcrumbs/Breadcrumb.vue'
import BreadcrumbItem from '@/Components/Breadcrumbs/BreadcrumbItem.vue'
import TableContainer from '@/Components/Tables/TableContainer.vue'
import Table from '@/Components/Tables/Table.vue'
import TableHeaderCell from '@/Components/Tables/TableCells/TableHeaderCell.vue'
import TableDataCell from '@/Components/Tables/TableCells/TableDataCell.vue'
import TableActionCell from '@/Components/Tables/TableCells/TableActionCell.vue'
import ImageCell from '@/Components/Tables/TableCells/TableImageCell.vue'
import NoTableData from '@/Components/Tables/NoTableData.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import SelectBox from '@/Components/Forms/Fields/SelectBox.vue'
import NormalButton from '@/Components/Buttons/NormalButton.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import GoBackButton from '@/Components/Buttons/GoBackButton.vue'
import Pagination from '@/Components/Paginations/DashboardPagination.vue'
import { Head, router, useForm, usePage } from '@inertiajs/vue3'
import { __ } from '@/Services/translations-inside-setup.js'
import { inject } from 'vue'

const props = defineProps({ collection: Object, collectionProducts: Object, products: Object })

const swal = inject('$swal')

const form = useForm({
  product_id: null
})

const handleAddProduct = () => {
  form.post(
    route('admin.collections.add-product', {
      collection: props.collection?.slug
    }),
    {
      preserveScroll: true,
      onSuccess: () => {
        const successMessage = usePage().props.flash.success
        if (successMessage) {
          swal({
            icon: 'success',
            title: __(successMessage)
          })
        }
      },
      onFinish: () => (form.product_id = null)
    }
  )
}

const handleRemoveProduct = (productId) => {
  router.post(
    route('admin.collections.remove-product', {
      collection: props.collection?.slug
    }),
    {
      product_id: productId
    },
    {
      preserveScroll: true,
      onSuccess: () => {
        const successMessage = usePage().props.flash.success
        if (successMessage) {
          swal({
            icon: 'success',
            title: __(successMessage)
          })
        }
      },
      onFinish: () => (form.product_id = null)
    }
  )
}
</script>

<template>
  <Head :title="__('Add Products To Collection')" />

  <AdminDashboardLayout>
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb to="admin.collections.index" icon="fa-box" label="Collections">
          <BreadcrumbItem :label="collection?.name" />
          <BreadcrumbItem label="Add Products" />
        </Breadcrumb>

        <div class="flex items-center justify-end w-auto">
          <GoBackButton />
        </div>
      </div>

      <!-- Form Start -->
      <div class="border p-10 bg-white rounded-md mb-10">
        <form @submit.prevent="handleAddProduct" class="space-y-4">
          <div>
            <InputLabel :label="__('Product')" required />

            <SelectBox
              name="product"
              :options="products"
              v-model="form.product_id"
              :placeholder="__('Select an option')"
            />

            <InputError :message="form.errors?.product_id" />
          </div>

          <InputError :message="form.errors?.captcha_token" />

          <FormButton :processing="form.processing" :disabled="!form.product_id">
            {{ __('Add Product') }}
          </FormButton>
        </form>
      </div>
      <!-- Form End -->

      <div class="border bg-white rounded-md p-5">
        <TableContainer>
          <Table :items="collectionProducts.data">
            <!-- Table Header -->
            <template #table-header>
              <TableHeaderCell label="Image" />
              <TableHeaderCell label="Name" />
              <TableHeaderCell label="Actions" />
            </template>

            <!-- Table Body -->
            <template #table-data="{ item }">
              <ImageCell :src="item?.image" />

              <TableDataCell>
                <div class="min-w-[200px] w-auto max-w-[400px]">
                  {{ item?.name }}
                </div>
              </TableDataCell>

              <TableActionCell>
                <NormalButton
                  @click="handleRemoveProduct(item?.id)"
                  class="bg-red-600 text-white ring-2 ring-red-300"
                >
                  <i class="fa-solid fa-trash-can"></i>
                  {{ __('Remove') }}
                </NormalButton>
              </TableActionCell>
            </template>
          </Table>
        </TableContainer>

        <Pagination :data="collectionProducts" />

        <NoTableData v-show="!collectionProducts.data.length" />
      </div>
    </div>
  </AdminDashboardLayout>
</template>
