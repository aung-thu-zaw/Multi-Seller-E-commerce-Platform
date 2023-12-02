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

const props = defineProps({ blogCategory: Object })

const { previewImage, setImagePreview } = useImagePreview(props.blogCategory?.image)

const { form, processing, errors, editAction } = useResourceActions({
  name: props.blogCategory?.name,
  status: props.blogCategory?.status,
  image: props.blogCategory?.image
})
</script>

<template>
  <Head :title="__('Edit :label', { label: __('Blog Category') })" />

  <AdminDashboardLayout>
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <!-- Breadcrumb -->
        <Breadcrumb to="admin.blog-categories.index" icon="fa-list" label="Blog Categories">
          <BreadcrumbItem :label="blogCategory?.name" />
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
            editAction('Blog Category', 'admin.blog-categories.update', {
              blog_category: blogCategory?.slug
            })
          "
          class="space-y-4 md:space-y-6"
        >
          <!-- Preview Blog Category Image -->
          <PreviewImage :src="previewImage" />

          <!-- Blog Category Name Input -->
          <div>
            <InputLabel :label="__('Blog Category Name')" required />

            <InputField
              type="text"
              name="blog-category-name"
              v-model="form.name"
              :placeholder="__('Enter :label', { label: __('Blog Category Name') })"
              autofocus
              required
            />

            <InputError :message="errors?.name" />
          </div>

          <!-- Blog Category Status Select Box -->
          <div>
            <InputLabel :label="__('Status')" required />

            <SelectBox
              name="blog-category-status"
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
              :selected="blogCategory.status"
              required
            />

            <InputError :message="errors?.status" />
          </div>

          <!-- Blog Category Image Field -->
          <div>
            <InputLabel :label="__('Category Image')" />

            <FileInput
              name="blog-category-image"
              text="PNG, JPG or JPEG ( Max File Size : 1.5 MB )"
              @update:modelValue="setImagePreview"
              v-model="form.image"
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
