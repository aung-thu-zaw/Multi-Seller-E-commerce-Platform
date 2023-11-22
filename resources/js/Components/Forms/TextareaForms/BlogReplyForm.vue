<script setup>
import TextAreaField from "@/Components/Forms/Fields/TextAreaField.vue";
import FormButton from "@/Components/Buttons/FormButton.vue";
</script>


<template>
  <div class="pl-12 mt-5">
    <form action="#">
      <div class="mb-3">
        <TextAreaField
          name="reply-blog"
          :placeholder="__('Enter reply message ...')"
          required
        />
      </div>

      <div class="border w-[100px] ml-auto">
        <FormButton type="submit" :processing="processing">
          {{ __("Submit") }}
        </FormButton>
      </div>
    </form>
  </div>
</template>
