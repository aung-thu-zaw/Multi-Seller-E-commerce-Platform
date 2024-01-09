<script setup>
import SellerDashboardLayout from '@/Layouts/SellerDashboardLayout.vue'
import Breadcrumb from '@/Components/Breadcrumbs/Breadcrumb.vue'
import BreadcrumbItem from '@/Components/Breadcrumbs/BreadcrumbItem.vue'
import TableContainer from '@/Components/Tables/TableContainer.vue'
import Table from '@/Components/Tables/Table.vue'
import TableHeaderCell from '@/Components/Tables/TableCells/TableHeaderCell.vue'
import TableDataCell from '@/Components/Tables/TableCells/TableDataCell.vue'
import TableActionCell from '@/Components/Tables/TableCells/TableActionCell.vue'
import PreviewImage from '@/Components/Forms/PreviewImage.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import FileInput from '@/Components/Forms/Fields/FileInput.vue'
import SelectBox from '@/Components/Forms/Fields/SelectBox.vue'
import NormalButton from '@/Components/Buttons/NormalButton.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import GoBackButton from '@/Components/Buttons/GoBackButton.vue'
import MultipleFileInput from '@/Components/Forms/Fields/MultipleFileInput.vue'
import Datepicker from 'vue3-datepicker'
import { useResourceActions } from '@/Composables/useResourceActions'
import { Head, router } from '@inertiajs/vue3'
import { useImagePreview } from '@/Composables/useImagePreview'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
import { computed, ref, watch } from 'vue'
import { useFormatFunctions } from '@/Composables/useFormatFunctions'
import NoTableData from '@/Components/Tables/NoTableData.vue'

const props = defineProps({ product: Object, categories: Object, brands: Object })

const { formatDate } = useFormatFunctions()

const editor = ClassicEditor

const productHasVariants = ref(null)
const offerStartDate = ref(
  props.product?.offer_price_start_date ? new Date(props.product?.offer_price_start_date) : null
)
const offerEndDate = ref(
  props.product?.offer_price_end_date ? new Date(props.product?.offer_price_end_date) : null
)

const {
  previewImage,
  previewImages,
  setImagePreview,
  setMultipleImagePreviews,
  removePreviewImage
} = useImagePreview(props.product.image)

const removeImage = (index) => {
  removePreviewImage(index)
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
      preserveScroll: true
    }
  )
}

const transformProductToVariants = computed(() => {
  return props.product.skus.map((sku) => {
    const attributes = {}
    sku.attribute_options.forEach((attributeOption) => {
      const attributeName = attributeOption.attribute.name.toLowerCase()
      const attributeValue = attributeOption.value.toLowerCase()
      attributes[attributeName] = attributeValue
    })

    return {
      price: sku.price,
      offer_price: sku.offer_price,
      qty: sku.qty,
      attributes
    }
  })
})

const { form, processing, errors, editAction } = useResourceActions({
  brand_id: props.product?.brand_id,
  category_id: props.product?.category_id,
  name: props.product?.name,
  qty: props.product?.qty,
  price: props.product?.price,
  offer_price: props.product?.offer_price,
  offer_price_start_date: props.product?.offer_price_start_date,
  offer_price_end_date: props.product?.offer_price_end_date,
  description: props.product?.description,
  image: props.product?.image,
  images: props.product?.images,
  warranty_type: props.product?.warranty_type,
  warranty_policy: props.product?.warranty_policy,
  warranty_period: props.product?.warranty_period,
  return_day: props.product?.return_day,
  return_policy: props.product?.return_policy,
  variants: transformProductToVariants.value
})

watch(offerStartDate, (newStartDate) => {
  form.offer_price_start_date = newStartDate ? formatDate(newStartDate) : null
})

watch(offerEndDate, (newEndDate) => {
  form.offer_price_end_date = newEndDate ? formatDate(newEndDate) : null
})

const addNewProductVariant = () => {
  const emptyProductVariant = {
    price: null,
    offer_price: null,
    qty: null,
    attributes: {}
  }

  form.variants.unshift({ ...emptyProductVariant })
}

const getUniqueAttributes = computed(() => {
  const attributes = []

  // Loop through product variants to collect attributes
  for (const sku of props.product.skus) {
    for (const attribute_option of sku.attribute_options) {
      // Check if the "attribute" property exists and has a "name" property
      if (attribute_option.attribute && attribute_option.attribute.name) {
        const attributeName = attribute_option.attribute.name

        // Check if the attributeName is not already in the attributes array
        if (!attributes.includes(attributeName)) {
          attributes.push(attributeName)
        }
      }
    }
  }

  return attributes
})

const getAttributeOptions = (attribute) => {
  const attributeOptionsSet = new Set()

  // Loop through product variants to collect attribute options for the specified attribute
  for (const sku of props.product.skus) {
    for (const attribute_option of sku.attribute_options) {
      // Check if the "attribute" property exists and has a "name" property
      if (attribute_option.attribute && attribute_option.attribute.name) {
        const attributeName = attribute_option.attribute.name

        // If the current attribute matches the specified attribute, add its value to the set
        if (attributeName === attribute) {
          attributeOptionsSet.add(attribute_option.value)
        }
      }
    }
  }

  // Convert the set to an array before returning
  const attributeOptions = Array.from(attributeOptionsSet)
  return attributeOptions
}

const deleteProductVariant = (index) => {
  form.variants.splice(index, 1)
}
</script>

<template>
  <Head :title="__('Edit :label', { label: __('Product') })" />

  <SellerDashboardLayout>
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
            editAction('Product', 'seller.product-manage.update', { product: product?.slug })
          "
          class="space-y-4 md:space-y-6"
        >
          <div class="flex items-center flex-wrap">
            <PreviewImage :src="previewImage" class="ml-2" />

            <div
              v-for="image in product.product_images"
              :key="image.id"
              class="relative inline-block m-2"
            >
              <img
                :src="image.image"
                :alt="'optional-images' + id"
                class="w-32 h-32 object-cover rounded-md ring-2 ring-gray-200"
              />
              <span
                @click="handleDeleteProductImageInBackendDatabase(image)"
                class="absolute top-2 right-2 bg-black bg-opacity-40 text-white text-xs p-2 rounded-md hover:bg-opacity-60 cursor-pointer"
              >
                <i class="fa-solid fa-trash-can"></i>
              </span>
            </div>

            <div
              v-for="(previewImage, index) in previewImages"
              :key="index"
              class="relative inline-block m-2"
            >
              <img
                :src="previewImage"
                :alt="'optional-images' + index"
                class="w-32 h-32 object-cover rounded-md ring-2 ring-gray-200"
              />
              <span
                @click="removeImage(index)"
                class="absolute top-2 right-2 bg-black bg-opacity-40 text-white text-xs p-2 rounded-md hover:bg-opacity-60 cursor-pointer"
              >
                <i class="fa-solid fa-trash-can"></i>
              </span>
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <div>
              <InputLabel :label="__('Product Image') + ' ( Main Image )'" required />

              <FileInput
                name="product-image"
                v-model="form.image"
                text="PNG, JPG or JPEG ( Max File Size : 1.5 MB )"
                @update:modelValue="setImagePreview"
              />

              <InputError :message="errors?.image" />
            </div>

            <div>
              <InputLabel :label="__('Product Image') + ' ( Supported Multiple Image )'" required />

              <MultipleFileInput
                name="product-images"
                text="PNG, JPG or JPEG ( Max File Size : 1.5 MB )"
                v-model="form.images"
                @update:modelValue="setMultipleImagePreviews"
                :required="!product.product_images.length"
              />

              <InputError :message="form.errors?.images" />
            </div>
          </div>

          <hr />

          <div>
            <InputLabel :label="__('Product Name')" required />

            <InputField
              type="text"
              name="product-name"
              v-model="form.name"
              :placeholder="__('Enter :label', { label: __('Product Name') })"
              required
            />

            <InputError :message="errors?.name" />
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <div>
              <InputLabel :label="__('Category')" required />

              <SelectBox
                name="category_id"
                :options="categories"
                v-model="form.category_id"
                :placeholder="__('Select an option')"
                required
                :selected="form.category_id"
              />

              <InputError :message="errors?.category_id" />
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

          <div class="grid grid-cols-3 gap-5">
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
                :selected="form.return_day"
              />

              <InputError :message="errors?.return_day" />
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

          <hr />

          <div class="mb-5">
            <h1 class="font-bold text-md text-gray-700">
              <i class="fa-solid fa-boxes-stacked"></i>
              Product Variants
            </h1>

            <div v-show="product.skus.length">
              <div class="flex items-center justify-end mb-5">
                <button
                  @click="addNewProductVariant"
                  type="button"
                  class="font-bold text-blue-600 text-xs"
                >
                  <i class="fa-solid fa-plus"></i>
                  Add New Product Variant
                </button>
              </div>

              <!-- Table  -->
              <TableContainer>
                <Table :items="form.variants">
                  <!-- Table Header -->
                  <template #table-header>
                    <TableHeaderCell
                      v-for="attribute in getUniqueAttributes"
                      :key="attribute"
                      :label="attribute"
                    />
                    <TableHeaderCell label="Qty" />
                    <TableHeaderCell label="Price" />
                    <TableHeaderCell label="Discount Price" />
                    <TableHeaderCell label="Actions" />
                  </template>
                  <!-- Table Body -->
                  <template #table-data="{ index }">
                    <TableDataCell v-for="attribute in getUniqueAttributes" :key="attribute">
                      <div class="min-w-[150px]">
                        <select
                          class="rounded-md p-2 w-full text-sm font-semibold text-gray-600 border border-gray-300 bg-gray-50 focus:ring-2 transition-all focus:ring-orange-300 focus:border-orange-400"
                          v-model="form.variants[index].attributes[attribute]"
                        >
                          <option>{{ __('Select an option') }}</option>
                          <option
                            v-for="option in getAttributeOptions(attribute)"
                            :key="option"
                            :value="option"
                            :selected="selectedOption === option"
                          >
                            {{ option }}
                          </option>
                        </select>
                      </div>
                    </TableDataCell>

                    <TableDataCell>
                      <div class="min-w-[150px]">
                        <input
                          type="text"
                          v-model="form.variants[index].qty"
                          class="rounded-md p-2 w-full text-sm font-semibold text-gray-600 border border-gray-300 bg-gray-50 focus:ring-2 transition-all focus:ring-orange-300 focus:border-orange-400"
                        />
                      </div>
                    </TableDataCell>

                    <TableDataCell>
                      <div class="min-w-[150px]">
                        <input
                          type="text"
                          v-model="form.variants[index].price"
                          class="rounded-md p-2 w-full text-sm font-semibold text-gray-600 border border-gray-300 bg-gray-50 focus:ring-2 transition-all focus:ring-orange-300 focus:border-orange-400"
                        />
                      </div>
                    </TableDataCell>

                    <TableDataCell>
                      <div class="min-w-[150px]">
                        <input
                          type="text"
                          v-model="form.variants[index].offer_price"
                          class="rounded-md p-2 w-full text-sm font-semibold text-gray-600 border border-gray-300 bg-gray-50 focus:ring-2 transition-all focus:ring-orange-300 focus:border-orange-400"
                        />
                      </div>
                    </TableDataCell>

                    <TableActionCell>
                      <NormalButton
                        @click="deleteProductVariant(index)"
                        class="bg-red-600 text-white ring-2 ring-red-300"
                      >
                        <i class="fa-solid fa-trash-can"></i>
                        {{ __('Delete') }}
                      </NormalButton>
                    </TableActionCell>
                  </template>
                </Table>
              </TableContainer>

              <NoTableData v-show="form.variants.length <= 0" />
            </div>
          </div>

          <InputError :message="errors?.captcha_token" />

          <FormButton :processing="processing">
            {{ __('Save Changes') }}
          </FormButton>
        </form>
      </div>
      <!-- Form End -->
    </div>
  </SellerDashboardLayout>
</template>
