<script setup>
import SellerDashboardLayout from '@/Layouts/SellerDashboardLayout.vue'
import Breadcrumb from '@/Components/Breadcrumbs/Breadcrumb.vue'
import BreadcrumbItem from '@/Components/Breadcrumbs/BreadcrumbItem.vue'
import TableContainer from '@/Components/Tables/TableContainer.vue'
import Table from '@/Components/Tables/Table.vue'
import TableHeaderCell from '@/Components/Tables/TableCells/TableHeaderCell.vue'
import TableDataCell from '@/Components/Tables/TableCells/TableDataCell.vue'
import TableActionCell from '@/Components/Tables/TableCells/TableActionCell.vue'
import NoTableData from '@/Components/Tables/NoTableData.vue'
import ImageCell from '@/Components/Tables/TableCells/TableImageCell.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import MultipleFileInput from '@/Components/Forms/Fields/MultipleFileInput.vue'
import NormalButton from '@/Components/Buttons/NormalButton.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import GoBackButton from '@/Components/Buttons/GoBackButton.vue'
import { Head, router, useForm, usePage } from '@inertiajs/vue3'
import { useImagePreview } from '@/Composables/useImagePreview'
import { inject } from 'vue'
import { __ } from '@/Services/translations-inside-setup.js'

const props = defineProps({ product: Object })

const swal = inject('$swal')

const productList = 'seller.products.index'

const { previewImages } = useImagePreview()

const form = useForm({
  images: []
})

const handleProductImages = () => {
  form.post(route('seller.product.images.upload', { product: props.product?.slug }), {
    preserveState: true,
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
    onFinish: () => (previewImages.value = [])
  })
}
</script>

<template>
  <Head :title="__('Create :label', { label: __('Product Images') })" />

  <SellerDashboardLayout>
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb :to="productList" icon="fa-basket-shopping" label="Products">
          <BreadcrumbItem :label="product?.name" />
          <BreadcrumbItem label="Product Variants" />
        </Breadcrumb>

        <div class="flex items-center justify-end w-auto">
          <GoBackButton />
        </div>
      </div>

      <!-- Form Start -->
      <div class="border p-10 bg-white rounded-md mb-10">
        <!-- <div class="w-full flex items-center justify-end">
          <button
            class="font-bold text-xs text-orange-600 bg-orange-100 hover:bg-orange-200 px-3 py-2 rounded-full duration-500"
          >
            <i class="fa-solid fa-plus"></i>
            Add Variants
          </button>
        </div> -->
        <form @submit.prevent="handleProductImages" class="space-y-4 md:space-y-6">
          <div class="grid lg:grid-cols-2 gap-3 w-full">
            <div>
              <InputLabel :label="__('Attribute Name')" required />

              <InputField
                type="text"
                name="product-variant-attribute-name"
                :placeholder="
                  __('Enter :label', {
                    label: __('Attribute Name' + ' ( Eg. color )')
                  })
                "
                autofocus
                required
              />

              <!-- <InputError message="" /> -->
            </div>

            <div>
              <InputLabel :label="__('Options')" required />

              <InputField
                type="text"
                name="product-variant-option-name"
                :placeholder="
                  __('Enter :label', { label: __('Options' + ' ( Eg. red, green, blue, etc... )') })
                "
                autofocus
                required
              />
              <span class="text-xs font-medium text-gray-600"
                >Separate different options by pressing the comma key</span
              >

              <!-- <InputError message="" /> -->
            </div>
          </div>

          <div class="w-[150px] ml-auto">
            <FormButton :processing="processing">
              {{ __('Create') }}
            </FormButton>
          </div>

          <!-- <div class="space-x-3 flex items-center ml-3 mt-6">
              <button class="text-emerald-600 hover:text-emerald-700">
                <i class="fa-solid fa-check"></i>
              </button>
              <button class="text-red-600 hover:text-red-700">
                <i class="fa-solid fa-trash-can"></i>
              </button>
            </div>

            <div class="space-x-3 flex items-center ml-3 mt-6">
              <button class="text-blue-600 hover:text-blue-700">
                <i class="fa-solid fa-edit"></i>
              </button>
              <button class="text-red-600 hover:text-red-700">
                <i class="fa-solid fa-trash-can"></i>
              </button>
            </div> -->
        </form>
      </div>
      <!-- Form End -->

      <div class="border bg-white rounded-md p-5">
        <TableContainer>
          <Table :items="{}">
            <!-- Table Header -->
            <template #table-header>
              <TableHeaderCell label="Image" />

              <TableHeaderCell label="Size" />

              <TableHeaderCell label="Color" />

              <TableHeaderCell label="SKU" />

              <TableHeaderCell label="Quantity" />

              <TableHeaderCell label="Price" />

              <TableHeaderCell label="Actions" />
            </template>

            <!-- Table Body -->
            <template #table-data="{ item }">
              <ImageCell :src="item?.image" />

              <TableDataCell> 5xl </TableDataCell>

              <TableDataCell> Red </TableDataCell>

              <TableDataCell> PRODUCT-12345 </TableDataCell>

              <TableDataCell> 10 </TableDataCell>

              <TableDataCell> 20 </TableDataCell>

              <TableActionCell>
                <NormalButton
                  @click="handleDeleteProductImageInBackendDatabase(item)"
                  class="bg-blue-600 text-white ring-2 ring-blue-300"
                >
                  <i class="fa-solid fa-edit"></i>
                  {{ __('Edit') }}
                </NormalButton>
                <NormalButton
                  @click="handleDeleteProductImageInBackendDatabase(item)"
                  class="bg-red-600 text-white ring-2 ring-red-300"
                >
                  <i class="fa-solid fa-trash-can"></i>
                  {{ __('Delete') }}
                </NormalButton>
              </TableActionCell>
            </template>
          </Table>
        </TableContainer>

        <!-- <NoTableData v-show="!product.product_images.length" /> -->
      </div>
    </div>
  </SellerDashboardLayout>
</template>
