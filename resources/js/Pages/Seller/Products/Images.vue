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
import PreviewImage from '@/Components/Forms/PreviewImage.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
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

const { previewImages, setMultipleImagePreviews, removePreviewImage } = useImagePreview()

const handleChangeOptionalImages = (files) => {
  setMultipleImagePreviews(files)
  form.images = files
}

// Remove Image
const removeImage = (index) => {
  // Remove Image For Frontend Preview
  removePreviewImage(index)
  // Remove Image For Backend Request Data
  const optionalImagesArray = Array.from(form.images)

  if (index >= 0 && index < optionalImagesArray.length) {
    optionalImagesArray.splice(index, 1)
    form.images = optionalImagesArray
  }
}

// Delete Image In Backend Database
const handleDeleteProductImageInBackendDatabase = (image) => {
  router.delete(
    route('seller.product.images.destroy', {
      product_image: image
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
          <BreadcrumbItem label="Product Images" />
        </Breadcrumb>

        <div class="w-full flex items-center justify-end">
          <GoBackButton />
        </div>
      </div>

      <!-- Form Start -->
      <div class="border p-10 bg-white rounded-md mb-10">
        <form @submit.prevent="handleProductImages" class="space-y-4">
          <PreviewImage v-show="!previewImages.length" />

          <div
            v-for="(previewImage, index) in previewImages"
            :key="index"
            class="relative inline-block mx-2"
          >
            <img
              :src="previewImage"
              :alt="'optional-images' + index"
              class="w-28 h-28 object-cover rounded-md ring-2 ring-gray-200"
            />
            <span
              @click="removeImage(index)"
              class="absolute top-2 right-2 bg-black bg-opacity-40 text-white text-xs p-2 rounded-md hover:bg-opacity-60 cursor-pointer"
            >
              <i class="fa-solid fa-trash-can"></i>
            </span>
          </div>

          <div>
            <InputLabel :label="__('Product Image') + ' ( Supported Multiple Image )'" required />

            <MultipleFileInput
              name="product-images"
              text="PNG, JPG or JPEG ( Max File Size : 1.5 MB )"
              v-model="form.images"
              @update:modelValue="handleChangeOptionalImages"
              required
            />

            <InputError :message="form.errors?.images" />
          </div>

          <InputError :message="form.errors?.captcha_token" />

          <FormButton type="submit" :processing="form.processing">
            {{ __('Upload') }}
          </FormButton>
        </form>
      </div>
      <!-- Form End -->

      <div class="border bg-white rounded-md shadow p-5">
        <TableContainer>
          <Table :items="product.product_images">
            <!-- Table Header -->
            <template #table-header>
              <TableHeaderCell label="Image" />

              <TableHeaderCell label="Actions" />
            </template>

            <!-- Table Body -->
            <template #table-data="{ item }">
              <TableDataCell>
                <div class="w-32 h-32 border border-slate-300 overflow-hidden rounded-md">
                  <img :src="item?.image" class="w-full h-full object-cover" />
                </div>
              </TableDataCell>

              <TableActionCell>
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

        <NoTableData v-show="!product.product_images.length" />
      </div>
    </div>
  </SellerDashboardLayout>
</template>
