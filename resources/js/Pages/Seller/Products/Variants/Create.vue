<script setup>
import SellerDashboardLayout from '@/Layouts/SellerDashboardLayout.vue'
import Breadcrumb from '@/Components/Breadcrumbs/Breadcrumb.vue'
import BreadcrumbLinkItem from '@/Components/Breadcrumbs/BreadcrumbLinkItem.vue'
import BreadcrumbItem from '@/Components/Breadcrumbs/BreadcrumbItem.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import GoBackButton from '@/Components/Buttons/GoBackButton.vue'
import { useResourceActions } from '@/Composables/useResourceActions'
import { Head, Link } from '@inertiajs/vue3'
import { useFormatFunctions } from '@/Composables/useFormatFunctions'
import { computed, ref, watchEffect } from 'vue'

const props = defineProps({ product: Object })

const productList = 'seller.products.index'

const { formatDate } = useFormatFunctions()

const startDate = ref(null)
const endDate = ref(null)

const formattedStartDate = computed(() => formatDate(startDate.value))
const formattedEndDate = computed(() => formatDate(endDate.value))

const { form, processing, errors, createAction } = useResourceActions({
  product_id: props.product?.id,
  qty: null,
  price: null,
  discount: null,
  discount_start_date: null,
  discount_end_date: null
})

watchEffect(() => {
  form.discount_start_date = formattedStartDate.value
})

watchEffect(() => {
  form.discount_end_date = formattedEndDate.value
})
</script>

<template>
  <Head :title="__('Create :label', { label: __('Product Variant') })" />

  <SellerDashboardLayout>
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb :to="productList" icon="fa-basket-shopping" label="Products">
          <BreadcrumbItem :label="product?.name" />
          <BreadcrumbLinkItem
            label="Product Variants"
            to="seller.product.variants"
            :targetIdentifier="product?.slug"
          />
          <BreadcrumbItem label="Create" />
        </Breadcrumb>

        <div class="w-auto flex items-center justify-end">
          <GoBackButton />
        </div>
      </div>

      <!-- Form Start -->
      <div class="border p-10 bg-white rounded-md">
        <div v-show="!product.attributes.length" class="my-5">
          <p class="font-semibold text-sm text-gray-800 text-center">
            You need to create attribute and option first.
            <Link
              :href="route('seller.product.attribute-and-options', product?.slug)"
              class="font-bold text-blue-600 underline"
            >
              Here
            </Link>
          </p>
        </div>

        <form
          v-show="product.attributes.length"
          @submit.prevent="
            createAction('Product Variant', 'seller.product-variants.store', {
              product: product?.slug
            })
          "
          class="space-y-4 md:space-y-6"
        >
          <div v-for="attribute in product.attributes" :key="attribute.id">
            <InputLabel :label="__(attribute.name)" required />
            <select
              class="block w-full p-4 font-semibold text-sm text-gray-800 border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-blue-300 focus:border-blue-400 rounded-md transition-all"
            >
              <option value="" selected disabled>{{ __('Select an option') }}</option>
              <option v-for="option in attribute.options" :key="option.id" :value="option.value">
                {{ option.value }}
              </option>
            </select>

            <!-- <InputError :message="errors?.qty" /> -->
          </div>

          <div class="grid grid-cols-3 gap-3">
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
                type="number"
                name="product-price"
                v-model="form.price"
                :placeholder="__('Enter :label', { label: __('Product Price') })"
                required
              />

              <InputError :message="errors?.qty" />
            </div>

            <div>
              <InputLabel :label="__('SKU')" />

              <InputField
                type="text"
                name="product-sku"
                v-model="form.price"
                :placeholder="__('Enter :label', { label: __('Product SKU') })"
                required
              />

              <InputError :message="errors?.qty" />
            </div>
          </div>

          <InputError :message="errors?.captcha_token" />

          <FormButton :processing="processing">
            {{ __('Create') }}
          </FormButton>
        </form>
      </div>
      <!-- Form End -->
    </div>
  </SellerDashboardLayout>
</template>
