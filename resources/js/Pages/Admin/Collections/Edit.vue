<script setup>
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue'
import Breadcrumb from '@/Components/Breadcrumbs/Breadcrumb.vue'
import BreadcrumbItem from '@/Components/Breadcrumbs/BreadcrumbItem.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import SelectBox from '@/Components/Forms/Fields/SelectBox.vue'
import TextAreaField from '@/Components/Forms/Fields/TextAreaField.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import GoBackButton from '@/Components/Buttons/GoBackButton.vue'
import { useResourceActions } from '@/Composables/useResourceActions'
import { Head } from '@inertiajs/vue3'

const props = defineProps({ collection: Object })

const { form, processing, errors, editAction } = useResourceActions({
  name: props.collection?.name,
  description: props.collection?.description,
  status: props.collection?.status
})
</script>

<template>
  <Head :title="__('Edit :label', { label: __('Collection') })" />

  <AdminDashboardLayout>
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb to="admin.collections.index" icon="fa-box" label="Collections">
          <BreadcrumbItem :label="collection?.name" />
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
            editAction('Collection', 'admin.collections.update', { collection: collection?.slug })
          "
          class="space-y-4 md:space-y-6"
        >
          <div>
            <InputLabel :label="__('Collection Name')" required />

            <InputField
              type="text"
              name="collection-name"
              v-model="form.name"
              :placeholder="__('Enter :label', { label: __('Collection Name') })"
              autofocus
              required
            />

            <InputError :message="errors?.name" />
          </div>

          <div>
            <InputLabel :label="__('Description')" required />

            <TextAreaField
              name="collection-description"
              v-model="form.description"
              :placeholder="__('Enter :label', { label: __('Collection Description') })"
              required
            />

            <InputError :message="errors?.description" />
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
              :placeholder="__('Select an option')"
              required
              :selected="form.status"
            />

            <InputError :message="errors?.status" />
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
