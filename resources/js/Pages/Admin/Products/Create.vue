<script setup>
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue'
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
import { Head } from '@inertiajs/vue3'
import { useImagePreview } from '@/Composables/useImagePreview'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
import { ref, watch } from 'vue'
import { useFormatFunctions } from '@/Composables/useFormatFunctions'
import NoTableData from '@/Components/Tables/NoTableData.vue'

defineProps({ categories: Object, brands: Object, stores: Object })

const { formatDate } = useFormatFunctions()

const editor = ClassicEditor

const productHasVariants = ref(null)
const offerStartDate = ref(null)
const offerEndDate = ref(null)

const productList = 'admin.products.index'

const {
  previewImage,
  setImagePreview,
  previewImages,
  setMultipleImagePreviews,
  removePreviewImage
} = useImagePreview()

const removeImage = (index) => {
  removePreviewImage(index)
  const optionalImagesArray = Array.from(form.images)

  if (index >= 0 && index < optionalImagesArray.length) {
    optionalImagesArray.splice(index, 1)
    form.images = optionalImagesArray
  }
}

const { form, processing, errors, createAction } = useResourceActions({
  brand_id: null,
  store_id: null,
  category_id: null,
  name: null,
  qty: null,
  price: null,
  offer_price: null,
  offer_price_start_date: null,
  offer_price_end_date: null,
  description: null,
  image: null,
  images: null,
  warranty_type: null,
  warranty_policy: null,
  warranty_period: null,
  return_day: null,
  return_policy: null,
  attribute_options: [],
  variants: []
})

watch(offerStartDate, (newStartDate) => {
  form.offer_price_start_date = newStartDate ? formatDate(newStartDate) : null
})

watch(offerEndDate, (newEndDate) => {
  form.offer_price_end_date = newEndDate ? formatDate(newEndDate) : null
})

const variantAttributesAndOptions = ref([])

const addNewVariantAttributeAndOptions = () => {
  variantAttributesAndOptions.value.push({
    attribute: '',
    options: [],
    isEditing: true,
    isNew: true
  })
}

const saveVariantAttributeAndOptions = (index) => {
  const currentVariant = variantAttributesAndOptions.value[index]

  const attributeInput = currentVariant.attribute.toLowerCase()

  const optionInput =
    typeof currentVariant.options !== 'string'
      ? currentVariant.options.join(',')
      : currentVariant.options

  const filteredOptions = optionInput
    .split(',')
    .map((option) => option.trim().toLowerCase())
    .filter((option) => option !== '')

  // Check if the attribute already exists in form.attribute_options
  const existingAttributeIndex = form.attribute_options.findIndex(
    (attr) => attr.attribute.toLowerCase() === attributeInput.toLowerCase()
  )

  if (existingAttributeIndex !== -1) {
    // Update options for the existing attribute
    form.attribute_options[existingAttributeIndex].options = [...new Set(filteredOptions)]
  } else {
    // Add attributes and options directly to form.attribute_options
    form.attribute_options.push({
      attribute: attributeInput.toLowerCase(),
      options: filteredOptions
    })
  }

  currentVariant.attribute = attributeInput
  currentVariant.options = filteredOptions
  currentVariant.isEditing = false
  currentVariant.isNew = false
}

const cancelVariantAttributeAndOptions = (index) => {
  variantAttributesAndOptions.value.splice(index, 1)
}

const editVariantAttributeAndOptions = (index) => {
  const currentVariant = variantAttributesAndOptions.value[index]

  currentVariant.isEditing = true
}

const deleteVariantAttributeAndOptions = (index) => {
  const deletedVariant = variantAttributesAndOptions.value[index]

  // Remove the attribute and options from form.attribute_options
  const deletedAttributeIndex = form.attribute_options.findIndex(
    (attr) => attr.attribute.toLowerCase() === deletedVariant.attribute.toLowerCase()
  )

  if (deletedAttributeIndex !== -1) {
    form.attribute_options.splice(deletedAttributeIndex, 1)
  }

  variantAttributesAndOptions.value.splice(index, 1)
}

const isEditingAllowed = (variant) => variant.isEditing

const getUniqueAttributes = () =>
  Array.from(new Set(variantAttributesAndOptions.value.map((v) => v.attribute)))

const getAttributeOptions = (attribute) => {
  const variantWithAttribute = variantAttributesAndOptions.value.find(
    (variant) => variant.attribute === attribute
  )
  return variantWithAttribute ? variantWithAttribute.options : []
}

const addNewProductVariant = () => {
  const emptyProductVariant = {
    price: null,
    offer_price: null,
    qty: null,
    attributes: {}
  }

  form.variants.unshift({ ...emptyProductVariant })
}

const deleteProductVariant = (index) => {
  form.variants.splice(index, 1)
}

const handleAttributeOptionChange = (index, attribute, selectedOption) => {
  const currentVariant = form.variants[index]
  currentVariant.attributes[attribute] = selectedOption.toLowerCase()
}
</script>

<template>
  <Head :title="__('Create :label', { label: __('Product') })" />

  <AdminDashboardLayout>
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
          @submit.prevent="createAction('Product', 'admin.product-manage.store')"
          class="space-y-4 md:space-y-6"
        >
          <div class="flex items-center flex-wrap">
            <PreviewImage :src="previewImage" class="ml-2" />

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
                required
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
                required
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

          <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
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
              <InputLabel :label="__('Brand')" />

              <SelectBox
                name="brand"
                :options="brands"
                v-model="form.brand_id"
                :placeholder="__('Select an option')"
              />

              <InputError :message="errors?.brand_id" />
            </div>

            <div>
              <InputLabel :label="__('Store')" />

              <SelectBox
                name="store"
                :options="stores"
                v-model="form.store_id"
                :placeholder="__('Select an option')"
              />

              <InputError :message="errors?.store_id" />
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

          <div v-show="productHasVariants === null" class="w-full">
            <p class="text-center text-sm font-semibold text-orange-600 mb-5">
              Does your product have variants?
            </p>

            <div class="flex items-center justify-center space-x-5 w-full">
              <button
                type="button"
                @click="productHasVariants = true"
                class="text-sm font-bold text-gray-600 hover:text-orange-600"
              >
                Yes
              </button>
              <button
                type="button"
                @click="productHasVariants = false"
                class="text-sm font-bold text-gray-600 hover:text-orange-600"
              >
                No
              </button>
            </div>
          </div>

          <div v-show="productHasVariants === false" class="space-y-6">
            <div class="grid grid-cols-2 gap-5">
              <div>
                <InputLabel :label="__('Price')" required />

                <InputField
                  type="text"
                  name="product-price"
                  v-model="form.price"
                  :placeholder="__('Enter :label', { label: __('Product Price') })"
                  :required="!productHasVariants"
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
                  :required="!productHasVariants"
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
          </div>

          <hr />

          <div v-show="productHasVariants === true">
            <div>
              <div class="mb-5 flex items-center justify-between">
                <h1 class="font-bold text-md text-gray-700">
                  <i class="fa-solid fa-boxes-stacked"></i>
                  Product Variants
                </h1>

                <button
                  @click="addNewVariantAttributeAndOptions"
                  type="button"
                  class="font-bold text-blue-600 text-xs"
                >
                  <i class="fa-solid fa-plus"></i>
                  Add Attribute And Options
                </button>
              </div>

              <div v-if="variantAttributesAndOptions.length === 0" class="py-5">
                <p class="text-gray-600 text-sm font-bold text-center">
                  <i class="fa-solid fa-circle-info"></i>
                  To create product variants, add at least one variant attribute and option.
                </p>
              </div>

              <div
                v-for="(attributeAndOptions, index) in variantAttributesAndOptions"
                :key="index"
                class="flex items-end justify-between space-x-3 mb-5"
              >
                <div class="grid grid-cols-2 gap-5 w-full">
                  <div>
                    <InputLabel :label="__('Attribute')" required />

                    <InputField
                      type="text"
                      :name="'attribute-' + index"
                      :id="'attribute-' + index"
                      v-model="attributeAndOptions.attribute"
                      :placeholder="
                        __('Enter :label', { label: __('Attribute') + ' ( Eg. color )' })
                      "
                      :disabled="!isEditingAllowed(attributeAndOptions)"
                    />

                    <InputError :message="errors?.attribute" />
                  </div>

                  <div>
                    <InputLabel :label="__('Options')" required />

                    <InputField
                      type="text"
                      :name="'option-' + index"
                      :id="'option-' + index"
                      v-model="attributeAndOptions.options"
                      :placeholder="
                        __('Enter :label', { label: __('Option') + ' ( Eg. red, green, blue )' })
                      "
                      :disabled="!isEditingAllowed(attributeAndOptions)"
                    />

                    <InputError :message="errors?.option" />
                  </div>
                </div>

                <div
                  v-if="isEditingAllowed(attributeAndOptions)"
                  class="flex items-center space-x-3 pb-2"
                >
                  <NormalButton @click="saveVariantAttributeAndOptions(index)">Save</NormalButton>
                  <NormalButton
                    v-if="attributeAndOptions.isNew"
                    @click="cancelVariantAttributeAndOptions(index)"
                    class="bg-gray-600 ring-2 ring-gray-300 hover:bg-gray-700 text-white"
                  >
                    Cancel
                  </NormalButton>
                </div>
                <div v-else class="flex items-center space-x-3 pb-2">
                  <NormalButton @click="editVariantAttributeAndOptions(index)"> Edit </NormalButton>
                  <NormalButton
                    @click="deleteVariantAttributeAndOptions(index)"
                    class="bg-red-600 ring-2 ring-red-300 hover:bg-red-700 text-white"
                  >
                    Delete
                  </NormalButton>
                </div>
              </div>
            </div>

            <!-- Table  -->
            <div>
              <div class="flex items-center justify-end mb-5">
                <button
                  @click="addNewProductVariant"
                  type="button"
                  class="font-bold text-blue-600 text-xs"
                  :disabled="variantAttributesAndOptions.length === 0"
                >
                  <i class="fa-solid fa-plus"></i>
                  Add New Product Variant
                </button>
              </div>
              <TableContainer>
                <Table :items="form.variants">
                  <!-- Table Header -->
                  <template #table-header>
                    <TableHeaderCell
                      v-for="attribute in getUniqueAttributes()"
                      :key="attribute"
                      :label="attribute"
                    />
                    <TableHeaderCell label="Qty" />
                    <TableHeaderCell label="Price" />
                    <TableHeaderCell label="Discount Price" />
                    <TableHeaderCell label="Actions" />
                  </template>
                  <!-- Table Body -->
                  <template #table-data="{ index }" v-if="form.variants.length > 0">
                    <TableDataCell v-for="attribute in getUniqueAttributes()" :key="attribute">
                      <div class="min-w-[150px]">
                        <select
                          class="rounded-md p-2 w-full text-sm font-semibold text-gray-600 border border-gray-300 bg-gray-50 focus:ring-2 transition-all focus:ring-orange-300 focus:border-orange-400"
                          v-model="form.variants[index].attributes[attribute]"
                          @change="
                            handleAttributeOptionChange(index, attribute, $event.target.value)
                          "
                        >
                          <option>{{ __('Select an option') }}</option>
                          <option
                            v-for="option in getAttributeOptions(attribute)"
                            :key="option"
                            :value="option"
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

          <FormButton type="submit" :processing="processing">
            {{ __('Create') }}
          </FormButton>
        </form>
      </div>
      <!-- Form End -->
    </div>
  </AdminDashboardLayout>
</template>
