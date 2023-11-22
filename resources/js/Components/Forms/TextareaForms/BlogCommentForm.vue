<script setup>
import TextAreaField from "@/Components/Forms/Fields/TextAreaField.vue";
import FormButton from "@/Components/Buttons/FormButton.vue";
</script>

<template>
  <div class="p-5">
    <form action="#">
      <div class="mb-3">
        <TextAreaField
          name="comment-blog"
          :placeholder="__('Enter comment...')"
          required
        />
      </div>

      <div class="border w-[150px] ml-auto">
        <FormButton type="submit" :processing="processing">
          <i class="fa-solid fa-paper-plane"></i>
          {{ __("Submit") }}
        </FormButton>
      </div>
    </form>
  </div>
</template>
