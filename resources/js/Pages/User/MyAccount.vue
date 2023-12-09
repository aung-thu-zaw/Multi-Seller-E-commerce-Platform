<script setup>
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import InputField from '@/Components/Forms/Fields/InputField.vue'
import SelectBox from '@/Components/Forms/Fields/SelectBox.vue'
import FileInput from '@/Components/Forms/Fields/FileInput.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import UserDashboardLayout from '@/Layouts/UserDashboardLayout.vue'
import Datepicker from 'vue3-datepicker'
import { useImagePreview } from '@/Composables/useImagePreview'
import { useResourceActions } from '@/Composables/useResourceActions'
import { usePage, Head, Link } from '@inertiajs/vue3'
import { computed, ref, watch } from 'vue'
import { useFormatFunctions } from '@/Composables/useFormatFunctions'

defineProps({ mustVerifyEmail: Boolean, status: String })

const user = computed(() => usePage().props.auth?.user)

const { previewImage, setImagePreview } = useImagePreview(user.value?.avatar)

const { formatDate } = useFormatFunctions()

const birthDate = ref(user?.value.birthday ? new Date(user?.value.birthday) : null)

const { form, processing, errors, editAction } = useResourceActions({
  name: user.value?.name,
  email: user.value?.email,
  phone: user.value?.phone,
  gender: user.value?.gender,
  birthday: user.value?.birthday,
  avatar: user.value?.avatar
})

watch(birthDate, (newBirthDate) => {
  form.birthday = newBirthDate ? formatDate(newBirthDate) : null
})
</script>

<template>
  <Head :title="__('My Account')" />

  <UserDashboardLayout>
    <div class="p-10 border border-gray-200 bg-white rounded-md">
      <div class="flex flex-col items-center overflow-hidden py-5 space-y-3">
        <img
          :src="previewImage"
          alt="avatar"
          class="rounded-full border border-orange-500 ring-2 ring-orange-200 w-32 h-32 object-cover"
        />

        <div class="text-center">
          <h1 class="font-bold text-xl gray-800">{{ user.name }}</h1>
        </div>
      </div>

      <div>
        <div v-show="mustVerifyEmail && user.email_verified_at === null" class="text-center">
          <p class="text-sm mt-2 text-main-orange">
            Your email address is unverified.
            <Link
              :href="route('verification.send')"
              method="post"
              as="button"
              class="underline text-sm font-semibold text-orange-600 hover:text-orange-500"
            >
              Click here to re-send the verification email.
            </Link>
          </p>

          <div
            v-show="status === 'verification-link-sent'"
            class="mt-2 font-medium text-sm text-green-600"
          >
            A new verification link has been sent to your email address.
          </div>
        </div>

        <form
          @submit.prevent="
            editAction('My Account', 'user.my-account.update', { user: user?.id }, 'patch', 'toast')
          "
          class="space-y-4 md:space-y-6"
        >
          <div>
            <InputLabel :label="__('Name')" required />

            <InputField
              type="text"
              name="user-name"
              icon="fa-user"
              v-model="form.name"
              :placeholder="__('Enter :label', { label: __('Your Full Name') })"
            />

            <InputError :message="errors?.name" />
          </div>

          <div class="grid gird-cols-1 md:grid-cols-2 gap-5">
            <div>
              <InputLabel :label="__('Email Address')" required />

              <InputField
                type="email"
                name="user-email"
                icon="fa-envelope"
                v-model="form.email"
                :placeholder="__('Enter :label', { label: __('Email Address') })"
              />

              <InputError :message="errors?.email" />
            </div>

            <div>
              <InputLabel :label="__('Phone Number')" />

              <InputField
                type="text"
                name="user-phone"
                icon="fa-phone"
                v-model="form.phone"
                :placeholder="__('Enter :label', { label: __('Phone Number') })"
              />

              <InputError :message="errors?.phone" />
            </div>

            <div>
              <InputLabel :label="__('Gender')" />

              <SelectBox
                name="gender"
                icon="fa-venus-mars"
                :options="[
                  {
                    label: 'Male',
                    value: 'male'
                  },
                  {
                    label: 'Female',
                    value: 'female'
                  }
                ]"
                v-model="form.gender"
                :placeholder="__('Select an option')"
                :selected="form.gender"
              />

              <InputError :message="errors?.gender" />
            </div>

            <div>
              <InputLabel :label="__('Birthday')" />

              <div class="relative">
                <div
                  class="absolute z-50 inset-y-0 left-0 flex items-center pl-5 pointer-events-none text-slate-500"
                >
                  <i class="fa-solid fa-calendar"></i>
                </div>

                <Datepicker
                  id="birthday"
                  class="block w-full p-4 pl-12 font-semibold text-sm text-gray-800 border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-orange-300 focus:border-orange-400 transition-all rounded-md"
                  :placeholder="__('Select Date')"
                  v-model="birthDate"
                />
              </div>

              <InputError :message="errors?.birthday" />
            </div>
          </div>

          <div>
            <InputLabel :label="__('Avatar')" />

            <FileInput
              name="avatar"
              text="PNG, JPG or JPEG ( Max File Size : 1.5 MB )"
              v-model="form.avatar"
              @update:modelValue="setImagePreview"
            />

            <InputError :message="errors?.avatar" />
          </div>

          <InputError :message="errors?.captcha_token" />

          <FormButton :processing="processing">
            {{ __('Save Changes') }}
          </FormButton>
        </form>
      </div>
    </div>
  </UserDashboardLayout>
</template>
