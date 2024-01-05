<script setup>
import SellerDashboardLayout from '@/Layouts/SellerDashboardLayout.vue'
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
import { useImagePreview } from '@/Composables/useImagePreview'
import { useResourceActions } from '@/Composables/useResourceActions'
import { Head } from '@inertiajs/vue3'

const { previewImage, setImagePreview } = useImagePreview()

const { form, processing, errors, createAction } = useResourceActions({
  url: null,
  status: null,
  image: null
})
</script>

<template>
  <Head :title="__('Create :label', { label: __('Product Banner') })" />

  <SellerDashboardLayout>
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb to="seller.store-product-banners.index" icon="fa-ad" label="Product Banners">
          <BreadcrumbItem label="Create" />
        </Breadcrumb>

        <div class="w-auto flex items-center justify-end">
          <GoBackButton />
        </div>
      </div>

      <!-- Form Start -->
      <div class="border p-10 bg-white rounded-md">
        <form
          @submit.prevent="createAction('Product Banner', 'seller.store-product-banners.store')"
          class="space-y-4 md:space-y-6"
        >
          <PreviewImage :src="previewImage" />

          <div>
            <InputLabel :label="__('Product Banner Url')" required />

            <InputField
              type="text"
              name="product-banner-url"
              v-model="form.url"
              :placeholder="__('Enter :label', { label: __('Product Banner Url') })"
              autofocus
              required
            />

            <InputError :message="errors?.url" />
          </div>

          <div>
            <InputLabel :label="__('Status')" required />
            <SelectBox
              name="status"
              :options="[
                {
                  label: 'Show',
                  value: 'show'
                },
                {
                  label: 'Hide',
                  value: 'hide'
                }
              ]"
              v-model="form.status"
              :placeholder="__('Select an option')"
              required
            />

            <InputError :message="errors?.status" />
          </div>

          <div>
            <InputLabel :label="__('Product Banner Image')" required />

            <FileInput
              name="slider-banner-image"
              text="PNG, JPG or JPEG ( Max File Size : 1.5 MB )"
              v-model="form.image"
              @update:modelValue="setImagePreview"
              required
            />

            <InputError :message="errors?.image" />
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
