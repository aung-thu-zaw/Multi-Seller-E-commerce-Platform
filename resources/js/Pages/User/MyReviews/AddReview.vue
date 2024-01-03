<script setup>
import UserDashboardLayout from '@/Layouts/UserDashboardLayout.vue'
import { Head, useForm, usePage } from '@inertiajs/vue3'
import TextAreaField from '@/Components/Forms/Fields/TextAreaField.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import InputError from '@/Components/Forms/Fields/InputError.vue'
import FormButton from '@/Components/Buttons/FormButton.vue'
import PreviewImage from '@/Components/Forms/PreviewImage.vue'
import MultipleFileInput from '@/Components/Forms/Fields/MultipleFileInput.vue'
import { computed } from 'vue'
import { useImagePreview } from '@/Composables/useImagePreview'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'
import { useReCaptcha } from 'vue-recaptcha-v3'
import { __ } from '@/Services/translations-inside-setup'

const props = defineProps({ product: Object })

const attributes = computed(() => {
  return JSON.parse(props.product?.order_items[0]?.attributes)
})
const formattedAttributes = computed(() => {
  if (!attributes.value) return ''

  return Object.entries(attributes.value)
    .map(([key, value]) => `${key}: ${value}`)
    .join(' | ')
})

const { previewImages, setMultipleImagePreviews, removePreviewImage } = useImagePreview()

// Remove Image
const removeImage = (index) => {
  // Remove Image For Frontend Preview
  removePreviewImage(index)
  // Remove Image For Backend Request Data
  const optionalImagesArray = Array.from(form.images)

  if (index >= 0 && index < optionalImagesArray.length) {
    optionalImagesArray.splice(index, 1)
    form.images = optionalImagesArray
  }
}

// Delete Image In Backend Database
// const handleDeleteProductImageInBackendDatabase = (image) => {
//   router.delete(
//     route('admin.product.images.destroy', {
//       product_image: image
//     }),
//     {
//       preserveScroll: true,
//       onSuccess: () => {
//         form.images.value = []
//         const successMessage = usePage().props.flash.success
//         if (successMessage) {
//           swal({
//             icon: 'success',
//             title: __(successMessage)
//           })
//         }
//       }
//     }
//   )
// }

const form = useForm({
  images: [],
  comment: null,
  rating: null,
  captcha_token: null
})

const { executeRecaptcha, recaptchaLoaded } = useReCaptcha()

const handleProductReview = async () => {
  await recaptchaLoaded()
  form.captcha_token = await executeRecaptcha('add_product_review')
  form.post(route('user.my-reviews.store', { product: props.product?.slug }), {
    preserveState: true,
    preserveScroll: true,
    onSuccess: () => {
      form.images = []
      const successMessage = usePage().props.flash.success
      if (successMessage) {
        toast.success(__(successMessage), {
          autoClose: 2000
        })
      }
    },
    onFinish: () => (previewImages.value = [])
  })
}
</script>

<template>
  <Head :title="__('Add Review')" />
  <UserDashboardLayout>
    <h1 class="font-bold text-md text-gray-700 mb-5 pb-5 border-b">
      <i class="fa-solid fa-star"></i>
      {{ __('My Reviews') }}
    </h1>

    <div class="border border-gray-300 bg-white rounded-md p-5 space-y-5">
      <div
        class="w-full flex items-start bg-gray-100 px-5 py-2.5 rounded-md border border-gray-200"
      >
        <div class="min-w-[100px] overflow-hidden">
          <img
            :src="product?.image"
            alt="product-image"
            class="w-20 h-20 object-cover rounded-md"
          />
        </div>
        <div class="space-y-1">
          <h3 class="font-semibold text-sm text-gray-700 line-clamp-2">
            {{ product?.name }}
          </h3>

          <div class="space-x-1 flex items-center text-xs font-medium mb-5">
            {{ formattedAttributes }}
          </div>
        </div>
      </div>

      <div class="">
        <form @submit.prevent="handleProductReview" class="space-y-5">
          <div
            class="flex flex-col items-center space-y-3 border px-10 py-3 rounded-md bg-gray-100"
          >
            <h3 class="font-bold text-md text-gray-600">Select Product Ratings</h3>

            <div>
              <div class="flex flex-row-reverse justify-end items-center">
                <input
                  id="hs-ratings-readonly-1"
                  type="radio"
                  class="peer -ms-5 w-5 h-5 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0"
                  name="hs-ratings-readonly"
                  value="5"
                  v-model="form.rating"
                />
                <label
                  for="hs-ratings-readonly-1"
                  class="peer-checked:text-yellow-400 text-gray-300 pointer-events-none"
                >
                  <svg
                    class="flex-shrink-0 w-5 h-5"
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    fill="currentColor"
                    viewBox="0 0 16 16"
                  >
                    <path
                      d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
                    />
                  </svg>
                </label>
                <input
                  id="hs-ratings-readonly-2"
                  type="radio"
                  class="peer -ms-5 w-5 h-5 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0"
                  name="hs-ratings-readonly"
                  value="4"
                  v-model="form.rating"
                />
                <label
                  for="hs-ratings-readonly-2"
                  class="peer-checked:text-yellow-400 text-gray-300 pointer-events-none"
                >
                  <svg
                    class="flex-shrink-0 w-5 h-5"
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    fill="currentColor"
                    viewBox="0 0 16 16"
                  >
                    <path
                      d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
                    />
                  </svg>
                </label>
                <input
                  id="hs-ratings-readonly-3"
                  type="radio"
                  class="peer -ms-5 w-5 h-5 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0"
                  name="hs-ratings-readonly"
                  value="3"
                  v-model="form.rating"
                />
                <label
                  for="hs-ratings-readonly-3"
                  class="peer-checked:text-yellow-400 text-gray-300 pointer-events-none"
                >
                  <svg
                    class="flex-shrink-0 w-5 h-5"
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    fill="currentColor"
                    viewBox="0 0 16 16"
                  >
                    <path
                      d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
                    />
                  </svg>
                </label>
                <input
                  id="hs-ratings-readonly-4"
                  type="radio"
                  class="peer -ms-5 w-5 h-5 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0"
                  name="hs-ratings-readonly"
                  value="2"
                  v-model="form.rating"
                />
                <label
                  for="hs-ratings-readonly-4"
                  class="peer-checked:text-yellow-400 text-gray-300 pointer-events-none"
                >
                  <svg
                    class="flex-shrink-0 w-5 h-5"
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    fill="currentColor"
                    viewBox="0 0 16 16"
                  >
                    <path
                      d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
                    />
                  </svg>
                </label>
                <input
                  id="hs-ratings-readonly-5"
                  type="radio"
                  class="peer -ms-5 w-5 h-5 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0"
                  name="hs-ratings-readonly"
                  value="1"
                  v-model="form.rating"
                />
                <label
                  for="hs-ratings-readonly-5"
                  class="peer-checked:text-yellow-400 text-gray-300 pointer-events-none"
                >
                  <svg
                    class="flex-shrink-0 w-5 h-5"
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    fill="currentColor"
                    viewBox="0 0 16 16"
                  >
                    <path
                      d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
                    />
                  </svg>
                </label>
              </div>
            </div>
          </div>

          <PreviewImage v-show="!previewImages.length" />

          <div
            v-for="(previewImage, index) in previewImages"
            :key="index"
            class="relative inline-block mx-2"
          >
            <img
              :src="previewImage"
              :alt="'optional-images' + index"
              class="w-28 h-28 object-cover rounded-md ring-2 ring-gray-200"
            />
            <span
              @click="removeImage(index)"
              class="absolute top-2 right-2 bg-black bg-opacity-40 text-white text-xs p-2 rounded-md hover:bg-opacity-60 cursor-pointer"
            >
              <i class="fa-solid fa-trash-can"></i>
            </span>
          </div>

          <div>
            <TextAreaField
              v-model="form.comment"
              :placeholder="__('Write review for product')"
              required
            />

            <InputError :message="form.errors?.comment" />
          </div>

          <div>
            <div>
              <InputLabel :label="__('Add Image') + ' ( Supported Multiple Image )'" />

              <MultipleFileInput
                name="images"
                text="PNG, JPG or JPEG ( Max File Size : 1.5 MB )"
                v-model="form.images"
                @update:modelValue="setMultipleImagePreviews"
              />

              <InputError :message="form.errors?.images" />
            </div>
          </div>

          <div class="border w-[150px] ml-auto">
            <FormButton>
              <i class="fa-solid fa-paper-plane"></i>
              {{ __('Submit') }}
            </FormButton>
          </div>
        </form>
      </div>
    </div>
  </UserDashboardLayout>
</template>
