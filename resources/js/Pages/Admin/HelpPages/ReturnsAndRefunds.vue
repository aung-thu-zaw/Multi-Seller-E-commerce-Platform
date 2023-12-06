<script setup>
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue'
import Breadcrumb from '@/Components/Breadcrumbs/Breadcrumb.vue'
import BreadcrumbItem from '@/Components/Breadcrumbs/BreadcrumbItem.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import GoBackButton from '@/Components/Buttons/GoBackButton.vue'
import { useResourceActions } from '@/Composables/useResourceActions'
import { Head } from '@inertiajs/vue3'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'

const props = defineProps({ returnsAndRefunds: Object })

const editor = ClassicEditor

const { form, processing, errors, editAction } = useResourceActions({
  content: props.returnsAndRefunds?.content
})
</script>

<template>
  <Head :title="__('Returns & Refunds')" />

  <AdminDashboardLayout>
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <!-- Breadcrumb -->
        <Breadcrumb
          to="admin.returns-and-refunds.edit"
          icon="fa-money-bill-transfer"
          label="Returns & Refunds"
        >
          <BreadcrumbItem label="Edit" />
        </Breadcrumb>

        <!-- Go Back Button -->
        <div class="w-auto flex items-center justify-end">
          <GoBackButton />
        </div>
      </div>

      <!-- Form Start -->
      <div class="border p-10 bg-white rounded-md">
        <form
          @submit.prevent="
            editAction('Help Pages', 'admin.help-pages.update', {
              help_page: returnsAndRefunds?.id
            })
          "
          class="space-y-4 md:space-y-6"
        >
          <div>
            <InputLabel :label="__('Returns & Refunds')" required />

            <ckeditor
              :editor="editor"
              v-model="form.content"
              :config="{
                placeholder: __('Enter :label', { label: __('Returns & Refunds') })
              }"
            ></ckeditor>

            <InputError :message="errors?.content" />
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
