<script setup>
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue'
import Breadcrumb from '@/Components/Breadcrumbs/Breadcrumb.vue'
import BreadcrumbItem from '@/Components/Breadcrumbs/BreadcrumbItem.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import Checkbox from '@/Components/Forms/Fields/Checkbox.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import GoBackButton from '@/Components/Buttons/GoBackButton.vue'
import { useResourceActions } from '@/Composables/useResourceActions'
import { Head } from '@inertiajs/vue3'
import { computed, ref } from 'vue'

const props = defineProps({ role: Object, permissions: Object, permissionGroups: Object })

const roleName = ref(props.role?.name)

const formattedPermissions = computed(() =>
  props.role.permissions.map((permission) => permission.id)
)

const allPermissionsSelected = computed(() => {
  return form.permission_id.length === props.permissions.length
})

// Handle Select All Button
const selectAllPermissions = () => {
  if (allPermissionsSelected.value) {
    form.permission_id = []
  } else {
    form.permission_id = props.permissions.map((permission) => permission.id)
  }
}

const { form, processing, errors, editAction } = useResourceActions({
  role_id: props.role?.id,
  permission_id: [...formattedPermissions.value]
})
</script>

<template>
  <Head :title="__('Change Permissions')" />

  <AdminDashboardLayout>
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb
          to="admin.assign-role-permissions.index"
          icon="fa-user-shield"
          label="Assign Role Permissions"
        >
          <BreadcrumbItem :label="role?.name" />
          <BreadcrumbItem label="Change Permissions" />
        </Breadcrumb>

        <div class="w-auto flex items-center justify-end">
          <GoBackButton />
        </div>
      </div>

      <!-- Form Start -->
      <div class="border p-10 bg-white rounded-md">
        <form
          @submit.prevent="
            editAction('Assign Role Permissions', 'admin.assign-role-permissions.update', {
              role: role?.id
            })
          "
          class="space-y-4 md:space-y-6"
        >
          <div>
            <InputLabel :label="__('Role')" required />

            <InputField
              type="text"
              name="role-name"
              v-model="roleName"
              :placeholder="__('Enter :label', { label: __('Role Name') })"
              disabled
            />
          </div>

          <!-- Permissions Checkbox -->
          <div class="mb-6">
            <div class="flex items-start w-full space-x-5 my-5 text-md">
              <div class="w-1/3">
                <h3 class="font-bold text-md text-orange-500">Groups</h3>
              </div>
              <div class="w-full flex items-center justify-between">
                <h3 class="font-bold text-md text-orange-500">
                  <i class="fa-solid fa-key"></i>
                  Permissions
                </h3>

                <button
                  type="button"
                  @click="selectAllPermissions"
                  class="px-3 py-2 text-xs font-semibold rounded-full text-white transition-all"
                  :class="{
                    'bg-red-600 hover:bg-red-500': allPermissionsSelected,
                    'bg-orange-600 hover:bg-orange-500': !allPermissionsSelected
                  }"
                >
                  <span v-if="!allPermissionsSelected">
                    {{ __('Select All') }}
                  </span>
                  <span v-else>{{ __('Deselect All') }}</span>
                </button>
              </div>
            </div>

            <hr class="my-5" />

            <div
              v-for="permissionGroup in permissionGroups"
              :key="permissionGroup.id"
              class="flex items-start space-x-5 mb-10"
            >
              <div class="w-1/3">
                <div class="flex items-center">
                  <h3 class="ml-2 text-md font-bold text-gray-600 capitalize">
                    {{ permissionGroup.group }}
                  </h3>
                </div>
              </div>

              <div class="w-full space-y-1">
                <div
                  v-for="permission in permissions"
                  :key="permission.id"
                  v-show="permission.group === permissionGroup.group"
                  class="flex items-center"
                >
                  <Checkbox :value="permission.id" v-model:checked="form.permission_id" />

                  <span class="ml-2 text-sm font-bold text-gray-700">
                    {{ permission.name }}
                  </span>
                </div>
              </div>
            </div>

            <InputError class="mt-2" :message="errors?.permission_id" />
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
