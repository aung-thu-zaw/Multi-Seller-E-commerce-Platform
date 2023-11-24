import { ref } from 'vue'
import image from '@/assets/images/no-image.jpeg'

export function useImagePreview(existingImage = image) {
  const previewImage = ref(existingImage)
  const previewImages = ref([])

  const setImagePreview = (file) => {
    previewImage.value = URL.createObjectURL(file)
  }

  const setMultipleImagePreviews = (files) => {
    previewImages.value = Array.from(files).map((file) => URL.createObjectURL(file))
  }

  const removePreviewImage = (index) => {
    previewImages.value.splice(index, 1)
  }

  return {
    previewImage,
    previewImages,
    setImagePreview,
    setMultipleImagePreviews,
    removePreviewImage
  }
}
