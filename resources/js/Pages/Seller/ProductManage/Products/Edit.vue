<script setup>
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue'
import Breadcrumb from '@/Components/Breadcrumbs/Breadcrumb.vue'
import BreadcrumbItem from '@/Components/Breadcrumbs/BreadcrumbItem.vue'
import PreviewImage from '@/Components/Forms/PreviewImage.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import SelectBox from '@/Components/Forms/Fields/SelectBox.vue'
import FileInput from '@/Components/Forms/Fields/FileInput.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import GoBackButton from '@/Components/Buttons/GoBackButton.vue'
import Datepicker from 'vue3-datepicker'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
import { useImagePreview } from '@/Composables/useImagePreview'
import { useResourceActions } from '@/Composables/useResourceActions'
import { Head } from '@inertiajs/vue3'
import { useFormatFunctions } from '@/Composables/useFormatFunctions'
import { ref, watch } from 'vue'

const props = defineProps({ product: Object, categories: Object, brands: Object, stores: Object })

const editor = ClassicEditor

const { previewImage, setImagePreview } = useImagePreview(props.product?.image)

const { formatDate } = useFormatFunctions()

const offerStartDate = ref(
  props.product?.offer_price_start_date ? new Date(props.product?.offer_price_start_date) : null
)

const offerEndDate = ref(
  props.product?.offer_price_end_date ? new Date(props.product?.offer_price_end_date) : null
)

const { form, processing, errors, editAction } = useResourceActions({
  brand_id: props.product?.brand_id,
  category_id: props.product?.category_id,
  store_id: props.product?.store_id,
  name: props.product?.name,
  qty: props.product?.qty,
  price: props.product?.price,
  offer_price: props.product?.offer_price,
  offer_price_start_date: props.product?.offer_price_start_date,
  offer_price_end_date: props.product?.offer_price_end_date,
  description: props.product?.description,
  image: props.product?.image,
  warranty_type: props.product?.warranty_type,
  warranty_policy: props.product?.warranty_policy,
  warranty_period: props.product?.warranty_period,
  return_day: props.product?.return_day,
  return_policy: props.product?.return_policy,
  status: props.product?.status
})

watch(offerStartDate, (newStartDate) => {
  form.offer_price_start_date = newStartDate ? formatDate(newStartDate) : null
})

watch(offerEndDate, (newEndDate) => {
  form.offer_price_end_date = newEndDate ? formatDate(newEndDate) : null
})
</script>

<template>
  <Head :title="__('Edit :label', { label: __('Product') })" />

  <AdminDashboardLayout>
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb to="admin.products.index" icon="fa-basket-shopping" label="Products">
          <BreadcrumbItem :label="product.name" />
          <BreadcrumbItem label="Edit" />
        </Breadcrumb>

        <div class="w-auto flex items-center justify-end">
          <GoBackButton />
        </div>
      </div>

      <!-- Form Start -->
      <div class="border p-10 bg-white rounded-md">
        <form
          @submit.prevent="
            editAction('Product', 'admin.products.update', { product: product?.slug })
          "
          class="space-y-4 md:space-y-6"
        >
          <PreviewImage :src="previewImage" class="mb-3 mr-3" />

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

          <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
            <div>
              <InputLabel :label="__('Seller')" required />

              <SelectBox
                name="store"
                :options="stores"
                v-model="form.store_id"
                :placeholder="__('Select an option')"
                :selected="form.store_id"
                required
              />

              <InputError :message="errors?.store_id" />
            </div>

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

            <div>
              <InputLabel :label="__('Brand')" />

              <SelectBox
                name="brand"
                :options="brands"
                v-model="form.brand_id"
                :selected="form.brand_id"
                :placeholder="__('Select an option')"
              />

              <InputError :message="errors?.brand_id" />
            </div>
          </div>

          <div class="grid grid-cols-2 gap-5">
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

            <div>
              <InputLabel :label="__('Quantity')" required />

              <InputField
                type="text"
                name="product-quantity"
                v-model="form.qty"
                :placeholder="__('Enter :label', { label: __('Product Quantity') })"
                required
              />

              <InputError :message="errors?.qty" />
            </div>
          </div>

          <div class="grid grid-cols-3 gap-5">
            <div>
              <InputLabel :label="__('Discount Price')" />

              <InputField
                type="text"
                name="product-discount"
                v-model="form.offer_price"
                :placeholder="__('Enter :label', { label: __('Product Offer Price') })"
              />

              <InputError :message="errors?.offer_price" />
            </div>
            <div>
              <InputLabel :label="__('Discount Start Date')" />

              <Datepicker
                typeable
                class="block w-full p-4 font-semibold text-sm rounded-md text-gray-800 border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-orange-300 focus:border-orange-400 transition-all"
                :placeholder="__('Enter :label', { label: __('Discount Start Date') })"
                v-model="offerStartDate"
                :disabled="!form.offer_price"
              />

              <InputError :message="errors?.offer_price_start_date" />
            </div>
            <div>
              <InputLabel :label="__('Discount End Date')" />

              <Datepicker
                typeable
                class="block w-full p-4 font-semibold text-sm rounded-md text-gray-800 border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-orange-300 focus:border-orange-400 transition-all"
                :placeholder="__('Enter :label', { label: __('Discount End Date') })"
                v-model="offerEndDate"
                :disabled="!form.offer_price"
              />

              <InputError :message="errors?.offer_price_end_date" />
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

          <div class="grid grid-cols-2 gap-5">
            <div>
              <InputLabel :label="__('Warranty Type')" />

              <SelectBox
                name="warranty-type"
                :options="[
                  {
                    label: 'Seller Warranty',
                    value: 'seller warranty'
                  },
                  {
                    label: 'Brand Warranty',
                    value: 'brand warranty'
                  },
                  {
                    label: 'Local Warranty',
                    value: 'local warranty'
                  }
                ]"
                v-model="form.warranty_type"
                :placeholder="__('Select an option')"
                :selected="form.warranty_type"
              />

              <InputError :message="errors?.warranty_type" />
            </div>
            <div>
              <InputLabel :label="__('Warranty Period')" />

              <SelectBox
                name="warranty-period"
                :options="[
                  {
                    label: '1 Month',
                    value: '1 month'
                  },
                  {
                    label: '2 Months',
                    value: '2 months'
                  },
                  {
                    label: '3 Months',
                    value: '3 months'
                  },
                  {
                    label: '4 Months',
                    value: '4 months'
                  },
                  {
                    label: '5 Months',
                    value: '5 months'
                  },
                  {
                    label: '6 Months',
                    value: '6 months'
                  },
                  {
                    label: '7 Months',
                    value: '7 months'
                  },
                  {
                    label: '8 Months',
                    value: '8 months'
                  },
                  {
                    label: '9 Months',
                    value: '9 months'
                  },
                  {
                    label: '10 Months',
                    value: '10 months'
                  },
                  {
                    label: '11 Months',
                    value: '11 months'
                  },
                  {
                    label: '12 Months',
                    value: '12 months'
                  },
                  {
                    label: '1 Year',
                    value: '1 year'
                  },
                  {
                    label: '2 Years',
                    value: '2 years'
                  },
                  {
                    label: '3 Years',
                    value: '3 years'
                  },
                  {
                    label: '4 Years',
                    value: '4 years'
                  },
                  {
                    label: '5 Years',
                    value: '5 years'
                  }
                ]"
                v-model="form.warranty_period"
                :placeholder="__('Select an option')"
                :disabled="!form.warranty_type"
                :selected="form.warranty_period"
              />

              <InputError :message="errors?.warranty_period" />
            </div>
          </div>

          <div>
            <InputLabel :label="__('Warranty Policy')" />

            <InputField
              type="text"
              name="warranty-policy"
              v-model="form.warranty_policy"
              :placeholder="__('Enter :label', { label: __('Warranty Policy') })"
              :disabled="!form.warranty_type"
            />

            <InputError :message="errors?.warranty_policy" />
          </div>

          <div>
            <InputLabel :label="__('Return Day')" />

            <SelectBox
              name="warranty-period"
              :options="[
                {
                  label: '7 Days',
                  value: '7 days'
                },
                {
                  label: '14 Days',
                  value: '14 days'
                }
              ]"
              v-model="form.return_day"
              :placeholder="__('Select an option')"
            />

            <InputError :message="errors?.return_day" />
          </div>

          <div>
            <InputLabel :label="__('Return Policy')" />

            <InputField
              type="text"
              name="return-policy"
              v-model="form.return_policy"
              :placeholder="__('Enter :label', { label: __('Return Policy') })"
              :disabled="!form.return_day"
            />

            <InputError :message="errors?.return_policy" />
          </div>

          <div>
            <InputLabel :label="__('Product Image') + ' ( Main Image )'" required />

            <FileInput
              name="product-image"
              v-model="form.image"
              text="PNG, JPG or JPEG ( Max File Size : 1.5 MB )"
              @update:modelValue="setImagePreview"
              required
            />

            <InputError :message="errors?.image" />
          </div>

          <InputError :message="errors?.captcha_token" />

          <FormButton :processing="processing">
            {{ __('Save Changes') }}
          </FormButton>
        </form>
      </div>
      <!-- Form End -->
    </div>
  </AdminDashboardLayout>
</template>
