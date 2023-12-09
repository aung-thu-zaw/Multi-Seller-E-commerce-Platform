<script setup>
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue'
import Breadcrumb from '@/Components/Breadcrumbs/Breadcrumb.vue'
import BreadcrumbItem from '@/Components/Breadcrumbs/BreadcrumbItem.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import GoBackButton from '@/Components/Buttons/GoBackButton.vue'
import { useResourceActions } from '@/Composables/useResourceActions'
import { Head } from '@inertiajs/vue3'

const props = defineProps({ automatedFilterWord: Object })

const { form, processing, errors, editAction } = useResourceActions({
  word: props.automatedFilterWord?.word
})
</script>

<template>
  <Head :title="__('Edit :label', { label: __('Automated Filter Word') })" />

  <AdminDashboardLayout>
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb
          to="admin.automated-filter-words.index"
          icon="fa-filter"
          label="Automated Filter Words"
        >
          <BreadcrumbItem :label="automatedFilterWord.word" />
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
            editAction('Automated Filter Word', 'admin.automated-filter-words.update', {
              automated_filter_word: automatedFilterWord?.slug
            })
          "
          class="space-y-4 md:space-y-6"
        >
          <div>
            <InputLabel :label="__('Filter Words')" required />

            <InputField
              type="text"
              name="filter-word"
              v-model="form.word"
              :placeholder="
                __('Enter :label', {
                  label: __('Filter Words') + '( Eg.Bad words, Offensive words, etc... )'
                })
              "
              autofocus
              required
            />

            <InputError :message="errors?.word" />
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
