<script setup>
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue'
import Breadcrumb from '@/Components/Breadcrumbs/Breadcrumb.vue'
import BreadcrumbItem from '@/Components/Breadcrumbs/BreadcrumbItem.vue'
import TableContainer from '@/Components/Tables/TableContainer.vue'
import Table from '@/Components/Tables/Table.vue'
import TableHeaderCell from '@/Components/Tables/TableCells/TableHeaderCell.vue'
import TableDataCell from '@/Components/Tables/TableCells/TableDataCell.vue'
import TableActionCell from '@/Components/Tables/TableCells/TableActionCell.vue'
import NoTableData from '@/Components/Tables/NoTableData.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import NormalButton from '@/Components/Buttons/NormalButton.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import GoBackButton from '@/Components/Buttons/GoBackButton.vue'
import { Head, useForm } from '@inertiajs/vue3'
import { inject, ref } from 'vue'
import { __ } from '@/Services/translations-inside-setup.js'

const props = defineProps({ product: Object, productVariants: Object, variantTypes: Object })

// const swal = inject('$swal')

const productList = 'admin.products.index'

const variantValue = ref(null)

const createVariantValues = (e) => {
  if (e.key === ',') {
    variantValue.value = variantValue.value.split(',').join('').toLowerCase()
    variantValue.value !== '' ? form.variant_values.push(variantValue.value) : null
    variantValue.value = ''
  }
  form.variant_values = [...new Set(form.variant_values)]
}

const removeVariantValue = (removeValue) => {
  form.variant_values = form.variant_values.filter((value) => {
    return value !== removeValue
  })
}

// const getVariantValue = (variant, variantType) => {
//   const foundValue = variant.variant_values.find(
//     (value) => value.variant_type.name === variantType.name
//   )
//   return foundValue ? foundValue.value : '-'
// }

const getVariantValue = (variant, variantType) => {
  if (!variant || !variant.variant_values) {
    return '-'
  }

  const foundValue = variant.variant_values.find(
    (value) => value.variant_type.name === variantType.name
  )

  return foundValue ? foundValue.value : '-'
}

const form = useForm({
  variant_type: null,
  variant_values: null
})

const handleCreateProductVariants = () => {
  form.post(route('admin.product-variants.store', { product: props.product?.slug }), {
    onSuccess: () => {
      form.reset()
    }
  })
}
</script>

<template>
  <Head :title="__('Create :label', { label: __('Product Variants') })" />

  <AdminDashboardLayout>
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
        <form @submit.prevent="handleCreateProductVariants" class="space-y-4">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
              <InputLabel :label="__('Variant Type')" required />

              <InputField
                type="text"
                name="product-variant-type"
                v-model="form.variant_type"
                :placeholder="
                  __('Enter :label', { label: __('Product Variant Type') }) + '( Eg. color )'
                "
                required
              />

              <InputError :message="form.errors?.variant_type" />
            </div>

            <div>
              <InputLabel :label="__('Variant Value')" required />

              <InputField
                type="text"
                name="product-variant-value"
                v-model="variantValue"
                :placeholder="
                  __('Enter :label', { label: __('Product Variant Value') }) +
                  '( Eg. red, green, blue )'
                "
                @keyup="createVariantValues"
              />

              <span class="text-xs font-medium text-gray-600">
                Separate different options by pressing the comma key
              </span>

              <div class="flex items-center space-x-3">
                <div
                  v-for="(value, index) in form.variant_values"
                  :key="index"
                  class="space-x-3 bg-orange-600 inline-block px-2.5 text-xs font-bold py-1.5 rounded-sm text-white my-3"
                >
                  <span>{{ value }}</span>
                  <span
                    @click="removeVariantValue(value)"
                    class="cursor-pointer hover:text-orange-200"
                  >
                    <i class="fa-solid fa-circle-xmark"></i>
                  </span>
                </div>
              </div>

              <InputError :message="form.errors?.variant_values" />
            </div>
          </div>

          <InputError :message="form.errors?.captcha_token" />

          <FormButton :processing="form.processing">
            {{ __('Create') }}
          </FormButton>
        </form>
      </div>
      <!-- Form End -->

      <div class="border bg-white rounded-md p-5">
        <TableContainer>
          <Table :items="productVariants">
            <!-- Table Header -->
            <template #table-header>
              <TableHeaderCell label="Product" />

              <TableHeaderCell
                v-for="variantType in variantTypes"
                :key="variantType.id"
                :label="variantType.name"
              />

              <TableHeaderCell label="SKU" />
              <TableHeaderCell label="Price" />
              <TableHeaderCell label="Qty" />
              <TableHeaderCell label="Offer Price" />
              <TableHeaderCell label="Actions" />
            </template>

            <!-- Table Body -->
            <template #table-data="{ item }">
              <TableDataCell>
                <div class="min-w-[200px] w-auto max-w-[400px]">
                  {{ product?.name }}
                </div>
              </TableDataCell>

              <TableDataCell v-for="variantType in variantTypes" :key="variantType.id">
                <div class="min-w-[100px]">
                  {{ getVariantValue(item, variantType) }}
                </div>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[300px]">
                  <input
                    type="text"
                    v-model="item.sku"
                    class="rounded-md p-2 w-full text-sm font-semibold text-gray-600 border border-gray-300 bg-gray-50 focus:ring-2 transition-all focus:ring-orange-300 focus:border-orange-400"
                  />
                </div>
              </TableDataCell>

              <TableDataCell>
                <!-- <InputField
                  type="text"
                  name="variant-price"
                  v-model="item.price"
                  :placeholder="__('Enter :label', { label: __('Product Variant Price') })"
                /> -->
                <div class="min-w-[150px]">
                  <input
                    type="text"
                    v-model="item.price"
                    class="rounded-md p-2 w-full text-sm font-semibold text-gray-600 border border-gray-300 bg-gray-50 focus:ring-2 transition-all focus:ring-orange-300 focus:border-orange-400"
                  />
                </div>

                <!-- {{ item?.price }} -->
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[150px]">
                  <input
                    type="text"
                    v-model="item.qty"
                    class="rounded-md p-2 w-full text-sm font-semibold text-gray-600 border border-gray-300 bg-gray-50 focus:ring-2 transition-all focus:ring-orange-300 focus:border-orange-400"
                  />
                </div>
              </TableDataCell>

              <TableDataCell>
                <div class="min-w-[150px]">
                  <input
                    type="text"
                    v-model="item.offer_price"
                    class="rounded-md p-2 w-full text-sm font-semibold text-gray-600 border border-gray-300 bg-gray-50 focus:ring-2 transition-all focus:ring-orange-300 focus:border-orange-400"
                  />
                </div>
              </TableDataCell>

              <TableActionCell>
                <NormalButton class="bg-blue-600 text-white ring-2 ring-blue-300">
                  <i class="fa-solid fa-save"></i>
                  {{ __('Save') }}
                </NormalButton>
                <NormalButton class="bg-red-600 text-white ring-2 ring-red-300">
                  <i class="fa-solid fa-trash-can"></i>
                  {{ __('Delete') }}
                </NormalButton>
              </TableActionCell>
            </template>
          </Table>
        </TableContainer>

        <NoTableData v-show="!product.product_variants.length" />
      </div>
    </div>
  </AdminDashboardLayout>
</template>
