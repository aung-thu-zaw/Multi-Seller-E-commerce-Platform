<script setup>
import SellerDashboardLayout from '@/Layouts/SellerDashboardLayout.vue'
import Breadcrumb from '@/Components/Breadcrumbs/Breadcrumb.vue'
import BreadcrumbItem from '@/Components/Breadcrumbs/BreadcrumbItem.vue'
import PreviewImage from '@/Components/Forms/PreviewImage.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import FileInput from '@/Components/Forms/Fields/FileInput.vue'
import SelectBox from '@/Components/Forms/Fields/SelectBox.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import GoBackButton from '@/Components/Buttons/GoBackButton.vue'
import { useResourceActions } from '@/Composables/useResourceActions'
import { Head } from '@inertiajs/vue3'
import { useImagePreview } from '@/Composables/useImagePreview'

defineProps({ categories: Object, storeProductCategories: Object, brands: Object })

const productList = 'seller.products.index'

const { previewImage, setImagePreview } = useImagePreview()

const handleChangeImage = (file) => {
  setImagePreview(file)
  form.image = file
}

const { form, processing, errors, createAction } = useResourceActions({
  brand_id: null,
  category_id: null,
  store_product_category_id: null,
  name: null,
  description: null,
  sku: null,
  qty: null,
  price: null,
  discount: null,
  discount_start_date: null,
  discount_end_date: null,
  status: 'draft',
  image: null
})
</script>

<template>
  <Head :title="__('Create :label', { label: __('Product') })" />

  <SellerDashboardLayout>
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb :to="productList" icon="fa-basket-shopping" label="Products">
          <BreadcrumbItem label="Create" />
        </Breadcrumb>

        <div class="w-full flex items-center justify-end">
          <GoBackButton />
        </div>
      </div>

      <!-- Form Start -->
      <div class="border p-10 bg-white rounded-md">
        <form
          @submit.prevent="createAction('Product', 'seller.products.store')"
          class="space-y-4 md:space-y-6"
        >
          <PreviewImage :src="previewImage" />

          <div>
            <InputLabel :label="__('Product Name')" required />

            <InputField
              type="text"
              name="product-name"
              v-model="form.name"
              :placeholder="__('Enter :label', { label: __('Product Name') })"
              autofocus
              required
            />

            <InputError :message="errors?.name" />
          </div>

          <div
            class="grid gap-3"
            :class="{
              'grid-cols-2': storeProductCategories.length,
              'grid-cols-1': !storeProductCategories.length
            }"
          >
            <div>
              <InputLabel :label="__('Category')" required />

              <SelectBox
                name="category_id"
                :options="categories"
                v-model="form.category_id"
                :placeholder="__('Select an option')"
                required
              />

              <InputError :message="errors?.category_id" />
            </div>

            <div>
              <InputLabel :label="__('Store Product Category')" required />

              <SelectBox
                name="store_product_category_id"
                :options="storeProductCategories"
                v-model="form.store_product_category_id"
                :placeholder="__('Select an option')"
                required
              />

              <InputError :message="errors?.store_product_category_id" />
            </div>
          </div>

          <div>
            <InputLabel :label="__('Image')" required />

            <FileInput
              name="brand-logo"
              v-model="form.logo"
              text="PNG, JPG or JPEG ( Max File Size : 1.5 MB )"
              @update:modelValue="handleChangeImage"
              required
            />

            <InputError :message="errors?.image" />
          </div>

          <InputError :message="errors?.captcha_token" />

          <FormButton type="submit" :processing="processing">
            {{ __('Create') }}
          </FormButton>
        </form>
      </div>
      <!-- Form End -->
    </div>
  </SellerDashboardLayout>
</template>
