<script setup>
import TextAreaField from "@/Components/Forms/Fields/TextAreaField.vue";
import InputError from "@/Components/Forms/Fields/InputError.vue";
import FormButton from "@/Components/Buttons/FormButton.vue";
import { useForm } from "@inertiajs/vue3";
import { useReCaptcha } from "vue-recaptcha-v3";

const props = defineProps({ blog: Object });

const form = useForm({
  comment: null,
  captcha_token: null,
});

const { executeRecaptcha, recaptchaLoaded } = useReCaptcha();

const submitBlogComment = async () => {
  await recaptchaLoaded();
  form.captcha_token = await executeRecaptcha("create_blog_comment");
  form.post(route("blog.comments.store", { blog_content: props.blog?.slug }), {
    replace: true,
    preserveState: true,
    onSuccess: () => (form.comment = ""),
  });
};
</script>

<template>
  <div class="p-5">
    <form @submit.prevent="submitBlogComment">
      <div class="mb-3">
        <TextAreaField
          name="comment-blog"
          :placeholder="__('Enter comment...')"
          required
          v-model="form.comment"
        />

        <InputError :message="form.errors?.comment" />
      </div>

      <div class="border w-[150px] ml-auto">
        <FormButton type="submit">
          <i class="fa-solid fa-paper-plane"></i>
          {{ __("Submit") }}
        </FormButton>
      </div>
    </form>
  </div>
</template>
