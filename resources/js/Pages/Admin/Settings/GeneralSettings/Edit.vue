<script setup>
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue'
import Breadcrumb from '@/Components/Breadcrumbs/Breadcrumb.vue'
import BreadcrumbItem from '@/Components/Breadcrumbs/BreadcrumbItem.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import FileInput from '@/Components/Forms/Fields/FileInput.vue'
import TextAreaField from '@/Components/Forms/Fields/TextAreaField.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import PreviewImage from '@/Components/Forms/PreviewImage.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import { useResourceActions } from '@/Composables/useResourceActions'
import { Head } from '@inertiajs/vue3'
import { ref } from 'vue'

const props = defineProps({ generalSetting: Object })

const headerLogoPreview = ref(props.generalSetting?.header_logo)
const setHeaderLogoPreview = (path) => {
  headerLogoPreview.value = URL.createObjectURL(path)
}

const footerLogoPreview = ref(props.generalSetting?.footer_logo)
const setFooterLogoPreview = (path) => {
  footerLogoPreview.value = URL.createObjectURL(path)
}

const faviconPreview = ref(props.generalSetting?.favicon)
const setFaviconPreview = (path) => {
  faviconPreview.value = URL.createObjectURL(path)
}

const { form, processing, errors, editAction } = useResourceActions({
  site_name: props.generalSetting?.site_name,
  tagline: props.generalSetting?.tagline,
  favicon: props.generalSetting?.favicon,
  header_logo: props.generalSetting?.header_logo,
  footer_logo: props.generalSetting?.footer_logo,
  company_phone: props.generalSetting?.company_phone,
  company_email: props.generalSetting?.company_email,
  address: props.generalSetting?.address,
  support_phone: props.generalSetting?.support_phone,
  support_email: props.generalSetting?.support_email,
  copyright: props.generalSetting?.copyright,
  facebook_url: props.generalSetting?.facebook_url,
  twitter_url: props.generalSetting?.twitter_url,
  instagram_url: props.generalSetting?.instagram_url,
  linked_in_url: props.generalSetting?.linked_in_url,
  youtube_url: props.generalSetting?.youtube_url
})
</script>

<template>
  <Head :title="__('General Settings')" />

  <AdminDashboardLayout>
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <!-- Breadcrumb -->
        <Breadcrumb to="admin.general-settings.edit" icon="fa-gear" label="General Settings">
          <BreadcrumbItem label="Edit" />
        </Breadcrumb>
      </div>

      <!-- Form Start -->
      <div class="border p-10 bg-white rounded-md">
        <form
          @submit.prevent="
            editAction('General Setting', 'admin.general-settings.update', {
              general_setting: generalSetting?.id
            })
          "
          class="space-y-4 md:space-y-6"
        >
          <div class="grid grid-cols-3 gap-5">
            <div>
              <PreviewImage :src="headerLogoPreview" />
            </div>
            <div>
              <PreviewImage :src="footerLogoPreview" />
            </div>
            <div>
              <PreviewImage :src="faviconPreview" />
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div>
              <InputLabel :label="__('Site Header Logo')" />

              <FileInput
                name="header-logo"
                text="PNG, JPG or JPEG ( Max File Size : 1.5 MB )"
                v-model="form.header_logo"
                @update:modelValue="setHeaderLogoPreview"
              />

              <InputError :message="errors?.header_logo" />
            </div>

            <div>
              <InputLabel :label="__('Site Footer Logo')" />

              <FileInput
                name="header-logo"
                text="PNG, JPG or JPEG ( Max File Size : 1.5 MB )"
                v-model="form.footer_logo"
                @update:modelValue="setFooterLogoPreview"
              />

              <InputError :message="errors?.footer_logo" />
            </div>

            <div>
              <InputLabel :label="__('Site Favicon')" />

              <FileInput
                name="favicon"
                text="PNG, JPG or JPEG ( Max File Size : 1.5 MB )"
                v-model="form.favicon"
                @update:modelValue="setFaviconPreview"
              />

              <InputError :message="errors?.favicon" />
            </div>
          </div>

          <div>
            <InputLabel :label="__('Site Name')" />

            <InputField
              type="text"
              name="site-name"
              v-model="form.site_name"
              :placeholder="__('Enter :label', { label: __('Site Name') })"
            />

            <InputError :message="errors?.site_name" />
          </div>

          <div>
            <InputLabel :label="__('Tagline Or Slogan')" />

            <TextAreaField
              name="site-tagline"
              v-model="form.tagline"
              :placeholder="__('Enter :label', { label: __('Tagline Or Slogan') })"
            />

            <InputError :message="errors?.tagline" />
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
              <InputLabel :label="__('Company Phone')" />

              <InputField
                type="text"
                name="company-phone"
                v-model="form.company_phone"
                :placeholder="__('Enter :label', { label: __('Company Phone') })"
              />

              <InputError :message="errors?.company_phone" />
            </div>

            <div>
              <InputLabel :label="__('Company Email Address')" />

              <InputField
                type="email"
                name="company-email"
                v-model="form.company_email"
                :placeholder="__('Enter :label', { label: __('Company Email Address') })"
              />

              <InputError :message="errors?.company_email" />
            </div>

            <div>
              <InputLabel :label="__('Support Phone')" />

              <InputField
                type="text"
                name="support-phone"
                v-model="form.support_phone"
                :placeholder="__('Enter :label', { label: __('Support Phone') })"
              />

              <InputError :message="errors?.support_phone" />
            </div>

            <div>
              <InputLabel :label="__('Support Email Address')" />

              <InputField
                type="email"
                name="support-email"
                v-model="form.support_email"
                :placeholder="__('Enter :label', { label: __('Support Email Address') })"
              />

              <InputError :message="errors?.support_email" />
            </div>
          </div>

          <div>
            <InputLabel :label="__('Address')" />

            <InputField
              type="text"
              name="address"
              v-model="form.address"
              :placeholder="__('Enter :label', { label: __('Address') })"
            />

            <InputError :message="errors?.address" />
          </div>

          <div>
            <InputLabel :label="__('Copyright')" />

            <InputField
              type="text"
              name="copyright"
              v-model="form.copyright"
              :placeholder="__('Enter :label', { label: __('Copyright') })"
            />

            <InputError :message="errors?.copyright" />
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
              <InputLabel :label="__('Facebook URL')" />

              <InputField
                type="text"
                name="facebook-url"
                v-model="form.facebook_url"
                :placeholder="__('Enter :label', { label: __('Facebook Link') })"
              />

              <InputError :message="errors?.facebook_url" />
            </div>
            <div>
              <InputLabel :label="__('Instagram URL')" />

              <InputField
                type="text"
                name="instagram-url"
                v-model="form.instagram_url"
                :placeholder="__('Enter :label', { label: __('Instagram Link') })"
              />

              <InputError :message="errors?.instagram_url" />
            </div>

            <div>
              <InputLabel :label="__('Twitter URL')" />

              <InputField
                type="text"
                name="twitter-url"
                v-model="form.twitter_url"
                :placeholder="__('Enter :label', { label: __('Twitter Link') })"
              />

              <InputError :message="errors?.twitter_url" />
            </div>
            <div>
              <InputLabel :label="__('LinkedIn URL')" />

              <InputField
                type="text"
                name="linkedin-url"
                v-model="form.linked_in_url"
                :placeholder="__('Enter :label', { label: __('LinkedIn Link') })"
              />

              <InputError :message="errors?.linked_in_url" />
            </div>
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
