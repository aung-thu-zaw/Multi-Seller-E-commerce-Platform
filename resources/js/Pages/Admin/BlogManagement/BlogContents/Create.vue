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
import { Head, usePage } from '@inertiajs/vue3'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
import { ref } from 'vue'

defineProps({ blogCategories: Object })

const editor = ClassicEditor

const tag = ref(null)

const blogContentList = 'admin.blog-contents.index'

const { previewImage, setImagePreview } = useImagePreview()

const handleChangeImage = (file) => {
  setImagePreview(file)
  form.thumbnail = file
}

const createTag = (e) => {
  if (e.key === ',') {
    tag.value = tag.value.split(',').join('').toLowerCase()
    tag.value !== '' ? form.tags.push(tag.value) : null
    tag.value = ''
  }
  form.tags = [...new Set(form.tags)]
}

const removeTag = (removeTag) => {
  form.tags = form.tags.filter((tag) => {
    return tag !== removeTag
  })
}

const { form, processing, errors, createAction } = useResourceActions({
  blog_category_id: null,
  author_id: usePage().props.auth.user?.id,
  title: null,
  content: null,
  status: 'draft',
  thumbnail: null,
  tags: []
})
</script>

<template>
  <AdminDashboardLayout>
    <Head :title="__('Create :label', { label: __('Blog Content') })" />
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb :to="blogContentList" icon="fa-newspaper" label="Blog Contents">
          <BreadcrumbItem label="Create" />
        </Breadcrumb>

        <div class="w-full flex items-center justify-end">
          <GoBackButton />
        </div>
      </div>

      <!-- Form Start -->
      <div class="border p-10 bg-white rounded-md">
        <form
          @submit.prevent="createAction('Blog Content', 'admin.blog-contents.store')"
          class="space-y-4 md:space-y-6"
        >
          <PreviewImage :src="previewImage" />

          <div>
            <InputLabel :label="__('Blog Title')" required />

            <InputField
              type="text"
              name="blog-title"
              v-model="form.title"
              :placeholder="__('Enter :label', { label: __('Blog Title') })"
              autofocus
              required
            />

            <InputError :message="errors?.title" />
          </div>

          <div>
            <InputLabel :label="__('Blog Content')" required />

            <ckeditor
              :editor="editor"
              v-model="form.content"
              :config="{
                placeholder: __('Enter :label', { label: __('Blog Content') })
              }"
            ></ckeditor>

            <InputError :message="errors?.content" />
          </div>

          <div>
            <InputLabel :label="__('Blog Category')" required />

            <SelectBox
              name="blog-category-id"
              :options="blogCategories"
              v-model="form.blog_category_id"
              :placeholder="__('Select an option')"
              required
            />

            <InputError :message="errors?.blog_category_id" />
          </div>

          <div>
            <InputLabel :label="__('Blog Tags')" />

            <InputField
              type="text"
              name="blog-tag"
              v-model="tag"
              :placeholder="
                __('Enter :label', { label: __('Blog Tags') }) + '( Eg. travel, sports, etc... )'
              "
              @keyup="createTag"
            />

            <div class="flex items-center space-x-3">
              <div
                v-for="(tag, index) in form.tags"
                :key="index"
                class="space-x-3 bg-orange-600 inline-block px-2.5 text-xs font-bold py-1.5 rounded-sm text-white my-3"
              >
                <span>{{ tag }}</span>
                <span @click="removeTag(tag)" class="cursor-pointer hover:text-orange-200">
                  <i class="fa-solid fa-circle-xmark"></i>
                </span>
              </div>
            </div>

            <InputError :message="errors?.tags" />
          </div>

          <div>
            <InputLabel :label="__('Blog Thumbnail')" required />

            <FileInput
              name="blog-thumbnail"
              v-model="form.thumbnail"
              text="PNG, JPG or JPEG ( Max File Size : 1.5 MB )"
              @update:modelValue="handleChangeImage"
              required
            />

            <InputError :message="errors?.thumbnail" />
          </div>

          <InputError :message="errors?.captcha_token" />

          <FormButton type="submit" :processing="processing">
            {{ __('Create') }}
          </FormButton>
        </form>
      </div>
      <!-- Form End -->
    </div>
  </AdminDashboardLayout>
</template>
