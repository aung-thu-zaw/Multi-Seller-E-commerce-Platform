<script setup>
defineProps({
  text: {
    type: String,
    default: "",
  },

  name: {
    type: String,
    default: "",
  },

  disabled: {
    type: Boolean,
    default: false,
  },

  modelValue: {
    type: String,
    default: "",
  },

  rounded: {
    type: Boolean,
    default: false,
  },
});

const emit = defineEmits(["update:modelValue"]);

const onFileChange = (event) => {
  const selectedFiles = event.target.files;
  emit("update:modelValue", selectedFiles);
};
</script>

<template>
  <div>
    <input
      :name="name"
      :id="name"
      class="block w-full font-medium text-md text-gray-800 border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-orange-300 focus:border-orange-400 transition-all"
      :class="{
        'rounded-full': rounded,
        'rounded-md': !rounded,
      }"
      aria-describedby="file_input_help"
      type="file"
      multiple
      @change="onFileChange"
      :disabled="disabled"
    />
    <p
      v-show="text"
      class="mt-1 text-xs font-bold text-gray-600"
      :id="name + '-help'"
    >
      {{ text }}
    </p>
  </div>
</template>

