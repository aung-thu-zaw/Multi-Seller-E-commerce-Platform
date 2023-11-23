<script setup>
import TextAreaField from "@/Components/Forms/Fields/TextAreaField.vue";
import FormButton from "@/Components/Buttons/FormButton.vue";
import { useForm } from "@inertiajs/vue3";
import { useReCaptcha } from "vue-recaptcha-v3";

const props = defineProps({ blogContent: Object, blogComment: Object });

const emit = defineEmits("updateReplyBox");

const form = useForm({
  reply: null,
  captcha_token: null,
});

const { executeRecaptcha, recaptchaLoaded } = useReCaptcha();

const submitBlogCommentReply = async () => {
  await recaptchaLoaded();
  form.captcha_token = await executeRecaptcha("create_blog_comment_reply");
  form.post(
    route("comment.replies.store", {
      blog_content: props.blogContent?.slug,
      blog_comment: props.blogComment?.id,
    }),
    {
      replace: true,
      preserveState: true,
      preserveScroll: true,
      onSuccess: () => (form.reply = ""),
      onFinish: () => emit("updateReplyBox", false),
    }
  );
};
</script>


<template>
  <div class="pl-12 mt-5">
    <form @submit.prevent="submitBlogCommentReply">
      <div class="mb-3">
        <TextAreaField
          name="reply-blog"
          :placeholder="__('Enter reply message ...')"
          required
          v-model="form.reply"
        />

        <InputError :message="errors?.reply" />
      </div>

      <div class="border w-[100px] ml-auto">
        <FormButton type="submit">
          {{ __("Submit") }}
        </FormButton>
      </div>
    </form>
  </div>
</template>



comment.replies.store
//
