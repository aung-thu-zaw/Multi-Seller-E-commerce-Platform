<script setup>
import AdminDashboardLayout from "@/Layouts/AdminDashboardLayout.vue";
import Breadcrumb from "@/Components/Breadcrumbs/Breadcrumb.vue";
import BreadcrumbItem from "@/Components/Breadcrumbs/BreadcrumbItem.vue";
import PreviewImage from "@/Components/Forms/PreviewImage.vue";
import InputLabel from "@/Components/Forms/Fields/InputLabel.vue";
import InputError from "@/Components/Forms/Fields/InputError.vue";
import InputField from "@/Components/Forms/Fields/InputField.vue";
import SelectBox from "@/Components/Forms/Fields/SelectBox.vue";
import FileInput from "@/Components/Forms/Fields/FileInput.vue";
import FormButton from "@/Components/Buttons/FormButton.vue";
import GoBackButton from "@/Components/Buttons/GoBackButton.vue";
import { useImagePreview } from "@/Composables/useImagePreview";
import { useResourceActions } from "@/Composables/useResourceActions";
import { Head, usePage } from "@inertiajs/vue3";
import { useQueryStringParams } from "@/Composables/useQueryStringParams";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

const props = defineProps({ blogCategories: Object, blogContent: Object });

const editor = ClassicEditor;

const blogContentList = "admin.blog-contents.index";

const { queryStringParams } = useQueryStringParams();

const { previewImage, setImagePreview } = useImagePreview(
  props.blogContent?.thumbnail
);

const handleChangeImage = (file) => {
  setImagePreview(file);
  form.thumbnail = file;
};

const { form, processing, errors, editAction } = useResourceActions({
  blog_category_id: props.blogContent?.blog_category_id,
  author_id: usePage().props.auth.user?.id,
  title: props.blogContent?.title,
  content: props.blogContent?.content,
  status: props.blogContent?.status,
  thumbnail: props.blogContent?.thumbnail,
});
</script>

<template>
  <AdminDashboardLayout>
    <Head :title="__('Edit :label', { label: __('Blog Content') })" />
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb
          :to="blogContentList"
          icon="fa-newspaper"
          label="Blog Contents"
        >
          <BreadcrumbItem :label="blogContent?.title" />
          <BreadcrumbItem label="Edit" />
        </Breadcrumb>

        <div class="w-full flex items-center justify-end">
          <GoBackButton />
        </div>
      </div>

      <!-- Form Start -->
      <div class="border p-10 bg-white rounded-md">
        <form
          @submit.prevent="
            editAction(
              'Blog Content',
              'admin.blog-contents.update',
              blogContent?.slug
            )
          "
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
                placeholder: __('Enter :label', { label: __('Blog Content') }),
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
              :selected="form.blog_category_id"
              required
            />

            <InputError :message="errors?.blog_category_id" />
          </div>

          <div>
            <InputLabel :label="__('Blog Thumbnail')" />

            <FileInput
              name="blog-thumbnail"
              v-model="form.thumbnail"
              text="PNG, JPG or JPEG ( Max File Size : 1.5 MB )"
              @update:modelValue="handleChangeImage"
            />

            <InputError :message="errors?.thumbnail" />
          </div>

          <InputError :message="errors?.captcha_token" />

          <FormButton type="submit" :processing="processing">
            {{ __("Save Changes") }}
          </FormButton>
        </form>
      </div>
      <!-- Form End -->
    </div>
  </AdminDashboardLayout>
</template>
