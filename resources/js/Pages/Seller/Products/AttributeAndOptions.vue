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
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import NormalButton from '@/Components/Buttons/NormalButton.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import GoBackButton from '@/Components/Buttons/GoBackButton.vue'
import { Head, router, useForm, usePage } from '@inertiajs/vue3'
import { inject, ref } from 'vue'
import { __ } from '@/Services/translations-inside-setup.js'

const props = defineProps({ product: Object })

const swal = inject('$swal')

const productList = 'seller.products.index'

const option = ref(null)

const createOption = (e) => {
  if (e.key === ',') {
    option.value = option.value.split(',').join('').toLowerCase()
    option.value !== '' ? form.options.push(option.value) : null
    option.value = ''
  }
  form.options = [...new Set(form.options)]
}

const removeOption = (removeOption) => {
  form.options = form.options.filter((option) => {
    return option !== removeOption
  })
}

const form = useForm({
  attribute: null,
  options: []
})

const handleAttributesAndOptions = () => {
  form.post(route('seller.product.attribute-and-options.store', { product: props.product?.slug }), {
    preserveState: true,
    preserveScroll: true,
    onSuccess: () => {
      form.attribute = null
      form.options = []
      const successMessage = usePage().props.flash.success
      if (successMessage) {
        swal({
          icon: 'success',
          title: __(successMessage)
        })
      }
    }
  })
}

const handleDeleteAttributeAndOptions = (attribute) => {
  router.delete(
    route('seller.product.attribute-and-options.destroy', {
      attribute: attribute?.id
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
      }
    }
  )
}

const handleDeleteOption = (option) => {
  router.delete(
    route('seller.options.destroy', {
      option: option?.id
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
      }
    }
  )
}
</script>

<template>
  <Head :title="__('Create :label', { label: __('Attributes And Options') })" />

  <SellerDashboardLayout>
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb :to="productList" icon="fa-basket-shopping" label="Products">
          <BreadcrumbItem :label="product?.name" />
          <BreadcrumbItem label="Attributes And Options" />
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
        <form @submit.prevent="handleAttributesAndOptions" class="space-y-4 md:space-y-6">
          <div class="grid lg:grid-cols-2 gap-3 w-full">
            <div>
              <InputLabel :label="__('Attribute Name')" required />

              <InputField
                type="text"
                name="attribute-name"
                :placeholder="
                  __('Enter :label', {
                    label: __('Attribute Name' + ' ( Eg. color )')
                  })
                "
                v-model="form.attribute"
                autofocus
                required
              />

              <InputError :message="form.errors?.attribute" />
            </div>

            <div>
              <InputLabel :label="__('Options')" required />

              <InputField
                type="text"
                name="option-name"
                :placeholder="
                  __('Enter :label', { label: __('Options' + ' ( Eg. red, green, blue, etc... )') })
                "
                v-model="option"
                @keyup="createOption"
              />

              <span class="text-xs font-medium text-gray-600"
                >Separate different options by pressing the comma key</span
              >

              <div class="flex items-center space-x-3">
                <div
                  v-for="(option, index) in form.options"
                  :key="index"
                  class="space-x-3 bg-blue-600 inline-block px-2.5 text-xs font-bold py-1.5 rounded-sm text-white my-3"
                >
                  <span>{{ option }}</span>
                  <span @click="removeOption(option)" class="cursor-pointer hover:text-blue-200">
                    <i class="fa-solid fa-circle-xmark"></i>
                  </span>
                </div>
              </div>

              <InputError :message="form.errors?.options" />
            </div>
          </div>

          <div class="w-[150px] ml-auto">
            <FormButton>
              {{ __('Save') }}
            </FormButton>
          </div>
        </form>
      </div>
      <!-- Form End -->

      <div class="border bg-white rounded-md p-5">
        <TableContainer>
          <Table :items="product.attributes">
            <!-- Table Header -->
            <template #table-header>
              <TableHeaderCell label="Attribute" />

              <TableHeaderCell label="Options" />

              <TableHeaderCell label="Actions" />
            </template>

            <!-- Table Body -->
            <template #table-data="{ item }">
              <TableDataCell>
                {{ item?.name }}
              </TableDataCell>

              <TableDataCell>
                <div class="space-x-2 min-w-[300px]">
                  <div
                    v-for="option in item?.options"
                    :key="option.id"
                    class="space-x-3 bg-blue-600 inline-block px-2.5 text-xs font-bold py-1.5 rounded-sm text-white my-3"
                  >
                    <span>{{ option.value }}</span>
                    <span
                      @click="handleDeleteOption(option)"
                      class="cursor-pointer hover:text-blue-200"
                    >
                      <i class="fa-solid fa-circle-xmark"></i>
                    </span>
                  </div>
                </div>
              </TableDataCell>

              <TableActionCell>
                <NormalButton
                  @click="handleDeleteAttributeAndOptions(item)"
                  class="bg-red-600 text-white ring-2 ring-red-300"
                >
                  <i class="fa-solid fa-trash-can"></i>
                  {{ __('Delete') }}
                </NormalButton>
              </TableActionCell>
            </template>
          </Table>
        </TableContainer>

        <NoTableData v-show="!product.attributes.length" />
      </div>
    </div>
  </SellerDashboardLayout>
</template>
