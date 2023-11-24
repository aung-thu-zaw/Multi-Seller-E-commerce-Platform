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
import { useQueryStringParams } from '@/Composables/useQueryStringParams'

const props = defineProps({
  category: Object,
  categories: Object
})

const categoryList = 'admin.categories.index'

const { queryStringParams } = useQueryStringParams()

const { previewImage, setImagePreview } = useImagePreview(props.category?.image)

const handleChangeImage = (file) => {
  setImagePreview(file)
  form.image = file
}

const { form, processing, errors, editAction } = useResourceActions({
  parent_id: props.category?.parent_id,
  name: props.category?.name,
  status: props.category?.status,
  image: props.category?.image
})
</script>

<template>
  <AdminDashboardLayout>
    <Head :title="__('Edit :label', { label: __('Category') })" />
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb :to="categoryList" icon="fa-list" label="Categories">
          <BreadcrumbItem :label="category.name" />
          <BreadcrumbItem label="Edit" />
        </Breadcrumb>

        <div class="w-full flex items-center justify-end">
          <GoBackButton />
        </div>
      </div>

      <!-- Form Start -->
      <div class="border p-10 bg-white rounded-md">
        <form
          @submit.prevent="editAction('Category', 'admin.categories.update', category?.slug)"
          class="space-y-4 md:space-y-6"
        >
          <PreviewImage :src="previewImage" />

          <div>
            <InputLabel :label="__('Category Name')" required />

            <InputField
              type="text"
              name="category-name"
              v-model="form.name"
              :placeholder="__('Enter Category Name')"
              autofocus
              required
            />

            <InputError :message="errors?.name" />
          </div>

          <div>
            <InputLabel :label="__('Parent Category')" />

            <SelectBox
              name="parent-category"
              :options="categories"
              v-model="form.parent_id"
              :placeholder="__('Select Option')"
              :selected="category.parent_id"
            />

            <InputError :message="errors?.parent_id" />
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
              :placeholder="__('Select Option')"
              :selected="category.status"
              required
            />

            <InputError :message="errors?.status" />
          </div>

          <div>
            <InputLabel :label="__('Category Image')" />

            <FileInput
              name="category-image"
              v-model="form.image"
              text="PNG, JPG or JPEG ( Max File Size : 1.5 MB )"
              @update:modelValue="handleChangeImage"
            />

            <InputError :message="errors?.image" />
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
