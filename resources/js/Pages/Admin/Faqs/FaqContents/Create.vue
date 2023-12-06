<script setup>
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue'
import Breadcrumb from '@/Components/Breadcrumbs/Breadcrumb.vue'
import BreadcrumbItem from '@/Components/Breadcrumbs/BreadcrumbItem.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import TextAreaField from '@/Components/Forms/Fields/TextAreaField.vue'
import SelectBox from '@/Components/Forms/Fields/SelectBox.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import GoBackButton from '@/Components/Buttons/GoBackButton.vue'
import { useResourceActions } from '@/Composables/useResourceActions'
import { Head } from '@inertiajs/vue3'

defineProps({ faqSubcategories: Object })

const { form, processing, errors, createAction } = useResourceActions({
  faq_subcategory_id: null,
  question: null,
  answer: null
})
</script>

<template>
  <Head :title="__('Create :label', { label: __('Faq Content') })" />

  <AdminDashboardLayout>
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb to="admin.faq-contents.index" icon="fa-clipboard-question" label="Faq Contents">
          <BreadcrumbItem label="Create" />
        </Breadcrumb>

        <div class="w-auto flex items-center justify-end">
          <GoBackButton />
        </div>
      </div>

      <!-- Form Start -->
      <div class="border p-10 bg-white rounded-md">
        <form
          @submit.prevent="createAction('Faq Content', 'admin.faq-contents.store')"
          class="space-y-4 md:space-y-6"
        >
          <div>
            <InputLabel :label="__('Question')" required />

            <InputField
              type="text"
              name="faq-question"
              v-model="form.question"
              :placeholder="__('Enter :label', { label: __('Question') })"
              autofocus
              required
            />

            <InputError :message="errors?.question" />
          </div>

          <div>
            <InputLabel :label="__('Answer')" required />

            <TextAreaField
              name="faq-answer"
              v-model="form.answer"
              :placeholder="__('Enter :label', { label: __('Answer') })"
              required
            />

            <InputError :message="errors?.answer" />
          </div>

          <div>
            <InputLabel :label="__('Faq Subcategory')" />

            <SelectBox
              name="faq-subcategory"
              :options="faqSubcategories"
              v-model="form.faq_subcategory_id"
              :placeholder="__('Select an option')"
            />

            <InputError :message="errors?.faq_subcategory_id" />
          </div>

          <InputError :message="errors?.captcha_token" />

          <FormButton :processing="processing">
            {{ __('Create') }}
          </FormButton>
        </form>
      </div>
      <!-- Form End -->
    </div>
  </AdminDashboardLayout>
</template>
