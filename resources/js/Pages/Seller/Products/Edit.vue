<script setup>
import SellerDashboardLayout from '@/Layouts/SellerDashboardLayout.vue'
import Breadcrumb from '@/Components/Breadcrumbs/Breadcrumb.vue'
import BreadcrumbItem from '@/Components/Breadcrumbs/BreadcrumbItem.vue'
import PreviewImage from '@/Components/Forms/PreviewImage.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import Datepicker from 'vue3-datepicker'
import FileInput from '@/Components/Forms/Fields/FileInput.vue'
import SelectBox from '@/Components/Forms/Fields/SelectBox.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import GoBackButton from '@/Components/Buttons/GoBackButton.vue'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
import { useResourceActions } from '@/Composables/useResourceActions'
import { Head } from '@inertiajs/vue3'
import { computed, ref, watchEffect } from 'vue'
import { useImagePreview } from '@/Composables/useImagePreview'
import { useFormatFunctions } from '@/Composables/useFormatFunctions'

const props = defineProps({
  product: Object,
  categories: Object,
  storeProductCategories: Object,
  brands: Object
})

const editor = ClassicEditor

const productList = 'seller.products.index'

const { previewImage, setImagePreview } = useImagePreview(props.product?.image)

const handleChangeImage = (file) => {
  setImagePreview(file)
  form.image = file
}

const { formatDate } = useFormatFunctions()

const startDate = ref(
  props.product?.discount_start_date ? new Date(props.product.discount_start_date) : ''
)
const endDate = ref(
  props.product?.discount_end_date ? new Date(props.product.discount_end_date) : ''
)

const formattedStartDate = computed(() => formatDate(startDate.value))
const formattedEndDate = computed(() => formatDate(endDate.value))

const { form, processing, errors, editAction } = useResourceActions({
  brand_id: props.product?.brand_id,
  category_id: props.product?.category_id,
  store_product_category_id: props.product?.store_product_category_id,
  name: props.product?.name,
  description: props.product?.description,
  sku: props.product?.sku,
  qty: props.product?.qty,
  price: props.product?.price,
  discount: props.product?.discount,
  discount_start_date: props.product?.discount_start_date,
  discount_end_date: props.product?.discount_end_date,
  status: props.product?.status,
  image: props?.product?.image
})

watchEffect(() => {
  form.discount_start_date = formattedStartDate.value
})

watchEffect(() => {
  form.discount_end_date = formattedEndDate.value
})
</script>

<template>
  <Head :title="__('Edit :label', { label: __('Product') })" />
  <SellerDashboardLayout>
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb :to="productList" icon="fa-basket-shopping" label="Products">
          <BreadcrumbItem :label="product.name" />
          <BreadcrumbItem label="Edit" />
        </Breadcrumb>

        <div class="w-full flex items-center justify-end">
          <GoBackButton />
        </div>
      </div>

      <!-- Form Start -->
      <div class="border p-10 bg-white rounded-md">
        <form
          @submit.prevent="editAction('Product', 'seller.products.update', product?.slug)"
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
                :selected="form.category_id"
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
                :selected="form.store_product_category_id"
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
                :selected="form.brand_id"
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
            <InputLabel :label="__('SKU')" />

            <InputField
              type="text"
              name="product-sku"
              v-model="form.sku"
              :placeholder="__('Enter :label', { label: __('Product SKU') })"
            />

            <InputError :message="errors?.sku" />
          </div>

          <div class="grid grid-cols-2 gap-3">
            <div>
              <InputLabel :label="__('Quantity')" required />

              <InputField
                type="number"
                name="product-quantity"
                v-model="form.qty"
                :placeholder="__('Enter :label', { label: __('Product Quantity') })"
                required
              />

              <InputError :message="errors?.qty" />
            </div>

            <div>
              <InputLabel :label="__('Price')" required />

              <InputField
                type="text"
                name="product-price"
                v-model="form.price"
                :placeholder="__('Enter :label', { label: __('Product Price') })"
                required
              />

              <InputError :message="errors?.price" />
            </div>
          </div>

          <div class="grid grid-cols-3 gap-3">
            <div>
              <InputLabel :label="__('Discount Price')" />

              <InputField
                type="text"
                name="product-discount"
                v-model="form.discount"
                :placeholder="__('Enter :label', { label: __('Product Offer Price') })"
              />

              <InputError :message="errors?.discount" />
            </div>

            <div>
              <InputLabel :label="__('Discount Start Date')" />

              <Datepicker
                typeable
                class="block w-full p-4 font-semibold text-sm rounded-md text-gray-800 border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition-all"
                :placeholder="__('Enter :label', { label: __('Discount Start Date') })"
                v-model="startDate"
              />

              <InputError :message="errors?.discount_start_date" />
            </div>
            <div>
              <InputLabel :label="__('Discount End Date')" />

              <Datepicker
                typeable
                class="block w-full p-4 font-semibold text-sm rounded-md text-gray-800 border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition-all"
                :placeholder="__('Enter :label', { label: __('Discount End Date') })"
                v-model="endDate"
              />

              <InputError :message="errors?.discount_end_date" />
            </div>
          </div>

          <div>
            <InputLabel :label="__('Product Image')" />

            <FileInput
              name="product-image"
              v-model="form.image"
              text="PNG, JPG or JPEG ( Max File Size : 1.5 MB )"
              @update:modelValue="handleChangeImage"
            />

            <InputError :message="errors?.image" />
          </div>

          <InputError :message="errors?.captcha_token" />

          <FormButton type="submit" :processing="processing">
            {{ __('Save Changes') }}
          </FormButton>
        </form>
      </div>
      <!-- Form End -->
    </div>
  </SellerDashboardLayout>
</template>
