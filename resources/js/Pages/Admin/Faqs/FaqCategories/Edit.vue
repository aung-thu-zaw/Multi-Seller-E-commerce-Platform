<script setup>
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue'
import Breadcrumb from '@/Components/Breadcrumbs/Breadcrumb.vue'
import BreadcrumbItem from '@/Components/Breadcrumbs/BreadcrumbItem.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import GoBackButton from '@/Components/Buttons/GoBackButton.vue'
import { useResourceActions } from '@/Composables/useResourceActions'
import { Head } from '@inertiajs/vue3'

const props = defineProps({ faqCategory: Object })

const { form, processing, errors, editAction } = useResourceActions({
  name: props.faqCategory?.name
})
</script>

<template>
  <Head :title="__('Edit :label', { label: __('Faq Category') })" />

  <AdminDashboardLayout>
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb to="admin.categories.index" icon="fa-list" label="Faq Categories">
          <BreadcrumbItem :label="faqCategory.name" />
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
            editAction('Faq Category', 'admin.faq-categories.update', {
              faq_category: faqCategory?.slug
            })
          "
          class="space-y-4 md:space-y-6"
        >
          <div>
            <InputLabel :label="__('Category Name')" required />

            <InputField
              type="text"
              name="category-name"
              v-model="form.name"
              :placeholder="__('Enter :label', { label: __('Category Name') })"
              autofocus
              required
            />

            <InputError :message="errors?.name" />
          </div>

          <InputError :message="errors?.captcha_token" />

          <FormButton type="submit" :processing="processing">
            {{ __('Save Changes') }}
          </FormButton>
        </form>
      </div>
      <!-- Form End -->
    </div>
  </AdminDashboardLayout>
</template>
