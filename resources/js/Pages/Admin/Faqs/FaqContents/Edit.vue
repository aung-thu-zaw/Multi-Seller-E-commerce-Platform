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

const props = defineProps({ faqContent: Object, faqSubcategories: Object })

const { form, processing, errors, editAction } = useResourceActions({
  faq_subcategory_id: props.faqContent?.faq_subcategory_id,
  question: props.faqContent?.question,
  answer: props.faqContent?.answer
})
</script>

<template>
  <Head :title="__('Edit :label', { label: __('Faq Content') })" />

  <AdminDashboardLayout>
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb to="admin.faq-contents.index" icon="fa-clipboard-question" label="Faq Contents">
          <BreadcrumbItem :label="faqContent.question" />
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
            editAction('Faq Content', 'admin.faq-contents.update', {
              faq_content: faqContent?.slug
            })
          "
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
            <InputLabel :label="__('Faq Subcategory')" required />

            <SelectBox
              name="faq-subcategory"
              :options="faqSubcategories"
              v-model="form.faq_subcategory_id"
              :placeholder="__('Select an option')"
              :selected="form.faq_subcategory_id"
              required
            />

            <InputError :message="errors?.faq_subcategory_id" />
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
