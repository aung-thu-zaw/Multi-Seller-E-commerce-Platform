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
import { useImagePreview } from '@/Composables/useImagePreview'
import { useResourceActions } from '@/Composables/useResourceActions'
import { Head } from '@inertiajs/vue3'

const props = defineProps({ campaignBanner: Object })

const { previewImage, setImagePreview } = useImagePreview(props.campaignBanner?.image)

const { form, processing, errors, editAction } = useResourceActions({
  url: props.campaignBanner?.url,
  status: props.campaignBanner?.status,
  logo: props.campaignBanner?.logo
})
</script>

<template>
  <Head :title="__('Edit :label', { label: __('Campaign Banner') })" />

  <AdminDashboardLayout>
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb to="admin.campaign-banners.index" icon="fa-ad" label="Campaign Banners">
          <BreadcrumbItem :label="campaignBanner.url" />
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
            editAction('Campaign Banner', 'admin.campaign-banners.update', {
              campaign_banner: campaignBanner?.id
            })
          "
          class="space-y-4 md:space-y-6"
        >
          <PreviewImage :src="previewImage" />

          <div>
            <InputLabel :label="__('Campaign Banner Url')" required />

            <InputField
              type="text"
              name="slider-banner-url"
              v-model="form.url"
              :placeholder="__('Enter :label', { label: __('Campaign Banner Url') })"
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
              :selected="form.status"
              required
            />

            <InputError :message="errors?.status" />
          </div>

          <div>
            <InputLabel :label="__('Campaign Banner Image')" />

            <FileInput
              name="slider-banner-image"
              text="PNG, JPG or JPEG ( Max File Size : 1.5 MB )"
              v-model="form.image"
              @update:modelValue="setImagePreview"
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
