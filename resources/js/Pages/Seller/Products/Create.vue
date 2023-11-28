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
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'

defineProps({ categories: Object, storeProductCategories: Object, brands: Object })

const editor = ClassicEditor

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

        <div class="w-auto flex items-center justify-end">
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
              'grid-cols-3': storeProductCategories.length,
              'grid-cols-2': !storeProductCategories.length
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

            <div v-show="storeProductCategories.length">
              <InputLabel :label="__('Store Product Category')" />

              <SelectBox
                name="store_product_category_id"
                :options="storeProductCategories"
                v-model="form.store_product_category_id"
                :placeholder="__('Select an option')"
              />

              <InputError :message="errors?.store_product_category_id" />
            </div>

            <div>
              <InputLabel :label="__('Brand')" />

              <SelectBox
                name="brand"
                :options="brands"
                v-model="form.brand_id"
                :placeholder="__('Select an option')"
              />

              <InputError :message="errors?.brand_id" />
            </div>
          </div>

          <div>
            <InputLabel :label="__('Description')" required />

            <ckeditor
              :editor="editor"
              v-model="form.description"
              :config="{
                placeholder: __('Enter :label', { label: __('Product Description') })
              }"
            ></ckeditor>
            <InputError :message="errors?.description" />
          </div>

          <div>
            <InputLabel :label="__('Product Image')" required />

            <FileInput
              name="product-image"
              v-model="form.image"
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
