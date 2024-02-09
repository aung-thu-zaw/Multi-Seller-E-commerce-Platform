<script setup>
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue'
import Breadcrumb from '@/Components/Breadcrumbs/Breadcrumb.vue'
import BreadcrumbItem from '@/Components/Breadcrumbs/BreadcrumbItem.vue'
import TableContainer from '@/Components/Tables/TableContainer.vue'
import Table from '@/Components/Tables/Table.vue'
import Datepicker from 'vue3-datepicker'
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
import Pagination from '@/Components/Paginations/DashboardPagination.vue'
import { Head, router, useForm, usePage } from '@inertiajs/vue3'
import { __ } from '@/Services/translations-inside-setup.js'
import { inject, ref, watch } from 'vue'
import { useFormatFunctions } from '@/Composables/useFormatFunctions'
import { useResourceActions } from '@/Composables/useResourceActions'

const props = defineProps({ flashSale: Object, products: Object, flashSaleProducts: Object })

const swal = inject('$swal')

const { formatDate } = useFormatFunctions()

const endDate = ref(props.flashSale?.end_date ? new Date(props.flashSale?.end_date) : null)

const { form, processing, errors, editAction } = useResourceActions({
  end_date: props.flashSale?.end_date
})

watch(endDate, (newEndDate) => {
  form.end_date = newEndDate ? formatDate(newEndDate) : null
})

const addProductForm = useForm({
  product_id: null
})
const handleAddProduct = () => {
  addProductForm.post(
    route('admin.flash-sales.add-product', {
      flash_sale: props.flashSale?.id
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
      onFinish: () => (addProductForm.product_id = null)
    }
  )
}

const handleRemoveProduct = (productId) => {
  router.post(
    route('admin.flash-sales.remove-product', {
      flash_sale: props.flashSale?.id
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
  <Head :title="__('Flash Sales')" />

  <AdminDashboardLayout>
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <!-- Breadcrumb -->
        <Breadcrumb to="admin.flash-sales.edit" icon="fa-bolt-lightning" label="Flash Sales">
          <BreadcrumbItem label="Edit" />
        </Breadcrumb>
      </div>

      <div class="space-y-5">
        <!-- Form Start -->
        <div class="border p-10 bg-white rounded-md">
          <form
            @submit.prevent="
              editAction('Flash Sale', 'admin.flash-sales.update', {
                flash_sale: flashSale?.id
              })
            "
            class="space-y-4 md:space-y-6"
          >
            <div>
              <InputLabel :label="__('End Date')" required />

              <Datepicker
                id="end-date"
                class="block w-full p-4 font-semibold text-sm text-gray-800 border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-orange-300 focus:border-orange-400 transition-all rounded-md"
                :placeholder="__('Select Date')"
                v-model="endDate"
                required
              />

              <InputError :message="errors?.end_date" />
            </div>

            <InputError :message="errors?.captcha_token" />

            <FormButton :processing="processing">
              {{ __('Save Changes') }}
            </FormButton>
          </form>
        </div>
        <!-- Form End -->

        <!-- Form Start -->
        <div class="border p-10 bg-white rounded-md mb-10">
          <form @submit.prevent="handleAddProduct" class="space-y-4">
            <div>
              <InputLabel :label="__('Product')" required />

              <SelectBox
                name="product"
                :options="products"
                v-model="addProductForm.product_id"
                :placeholder="__('Select an option')"
              />

              <InputError :message="form.addProductForm?.end_date" />
            </div>

            <InputError :message="form.errors?.captcha_token" />

            <FormButton
              :processing="addProductForm.processing"
              :disabled="!addProductForm.product_id"
            >
              {{ __('Add Product') }}
            </FormButton>
          </form>
        </div>
        <!-- Form End -->

        <div class="border bg-white rounded-md p-5">
          <TableContainer>
            <Table :items="flashSaleProducts.data">
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

          <Pagination :data="flashSaleProducts" />

          <NoTableData v-show="!flashSaleProducts.data.length" />
        </div>
      </div>
    </div>
  </AdminDashboardLayout>
</template>
