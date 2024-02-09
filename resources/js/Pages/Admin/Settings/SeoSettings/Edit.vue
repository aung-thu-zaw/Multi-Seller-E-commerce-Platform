<script setup>
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue'
import Breadcrumb from '@/Components/Breadcrumbs/Breadcrumb.vue'
import BreadcrumbItem from '@/Components/Breadcrumbs/BreadcrumbItem.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import TextAreaField from '@/Components/Forms/Fields/TextAreaField.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import { useResourceActions } from '@/Composables/useResourceActions'
import { Head } from '@inertiajs/vue3'

const props = defineProps({ seoSetting: Object })

const { form, processing, errors, editAction } = useResourceActions({
  meta_title: props.seoSetting?.meta_title,
  meta_keyword: props.seoSetting?.meta_keyword,
  meta_description: props.seoSetting?.meta_description
})
</script>

<template>
  <Head :title="__('Seo Settings')" />

  <AdminDashboardLayout>
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <!-- Breadcrumb -->
        <Breadcrumb to="admin.seo-settings.edit" icon="fa-magnifying-glass" label="Seo Settings">
          <BreadcrumbItem label="Edit" />
        </Breadcrumb>
      </div>

      <!-- Form Start -->
      <div class="border p-10 bg-white rounded-md">
        <form
          @submit.prevent="
            editAction('Seo Setting', 'admin.seo-settings.update', {
              seo_setting: seoSetting?.id
            })
          "
          class="space-y-4 md:space-y-6"
        >
          <div>
            <InputLabel :label="__('Meta Title')" />

            <InputField
              type="text"
              name="meta-title"
              v-model="form.meta_title"
              :placeholder="__('Enter :label', { label: __('Meta Title') })"
            />

            <InputError :message="errors?.meta_title" />
          </div>

          <div>
            <InputLabel :label="__('Meta Keywords')" />

            <InputField
              type="text"
              name="meta-keyword"
              v-model="form.meta_keyword"
              :placeholder="__('Enter :label', { label: __('Meta Keywords') })"
            />

            <InputError :message="errors?.meta_keyword" />
          </div>

          <div>
            <InputLabel :label="__('Meta Description')" />

            <TextAreaField
              name="meta-description"
              v-model="form.meta_description"
              :placeholder="__('Enter :label', { label: __('Meta Description') })"
            />

            <InputError :message="errors?.meta_description" />
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
