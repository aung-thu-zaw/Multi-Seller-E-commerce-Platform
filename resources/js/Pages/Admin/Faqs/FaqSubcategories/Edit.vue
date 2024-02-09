<script setup>
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue'
import Breadcrumb from '@/Components/Breadcrumbs/Breadcrumb.vue'
import BreadcrumbItem from '@/Components/Breadcrumbs/BreadcrumbItem.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import SelectBox from '@/Components/Forms/Fields/SelectBox.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import GoBackButton from '@/Components/Buttons/GoBackButton.vue'
import { useResourceActions } from '@/Composables/useResourceActions'
import { Head } from '@inertiajs/vue3'

const props = defineProps({ faqCategories: Object, faqSubcategory: Object })

const { form, processing, errors, editAction } = useResourceActions({
  faq_category_id: props.faqSubcategory?.faq_category_id,
  name: props.faqSubcategory?.name,
  icon: props.faqSubcategory?.icon
})
</script>

<template>
  <Head :title="__('Edit :label', { label: __('Faq Subcategory') })" />

  <AdminDashboardLayout>
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb to="admin.faq-subcategories.index" icon="fa-list-ol" label="Faq Subcategories">
          <BreadcrumbItem :label="faqSubcategory.name" />
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
            editAction('Faq Subcategory', 'admin.faq-subcategories.update', {
              faq_subcategory: faqSubcategory?.slug
            })
          "
          class="space-y-4 md:space-y-6"
        >
          <div>
            <InputLabel :label="__('Font Awesome Icon')" />

            <InputField
              type="text"
              name="faq-subcategory-icon"
              v-model="form.icon"
              :placeholder="__('Enter :label', { label: __('Icon name' + '( Eg. fa-user )') })"
            />

            <InputError :message="errors?.icon" />
          </div>

          <div>
            <InputLabel :label="__('Subcategory Name')" required />

            <InputField
              type="text"
              name="faq-subcategory-name"
              v-model="form.name"
              :placeholder="__('Enter :label', { label: __('Subcategory Name') })"
              autofocus
              required
            />

            <InputError :message="errors?.name" />
          </div>

          <div>
            <InputLabel :label="__('Faq Category')" required />

            <SelectBox
              name="faq-category"
              :options="faqCategories"
              v-model="form.faq_category_id"
              :placeholder="__('Select an option')"
              :selected="form.faq_category_id"
              required
            />

            <InputError :message="errors?.faq_category_id" />
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
