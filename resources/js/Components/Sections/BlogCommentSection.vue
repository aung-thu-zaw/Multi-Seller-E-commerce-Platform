<script setup>
import BlogCommentCard from "@/Components/Cards/Blogs/BlogCommentCard.vue";
import BlogReplyCard from "@/Components/Cards/Blogs/BlogReplyCard.vue";
import BlogCommentForm from "@/Components/Forms/TextareaForms/BlogCommentForm.vue";
import Pagination from "@/Components/Paginations/Pagination.vue";
import { Link } from "@inertiajs/vue3";

defineProps({
  blogContent: Object,
  blogComments: Object,
});
</script>


<template>
  <section>
    <div class="border border-gray-300 bg-white rounded-sm shadow">
      <div class="border-b p-5">
        <p class="text-md font-semibold text-gray-600 mb-5">
          Total Comments ({{ blogComments.total }})
        </p>

        <!-- Comments -->
        <div v-if="blogComments.data.length" class="space-y-5">
          <div
            v-for="blogComment in blogComments.data"
            :key="blogComment.id"
            class="py-3 rounded-md border border-gray-300"
          >
            <!-- <p
              v-show="blogComment.status === 'pending'"
              class="text-center font-medium text-orange-600 text-xs my-3"
            >
              <i class="fa-solid fa-spinner animate-spin"></i>
              Your comment is awaiting moderation....
            </p> -->

            <!-- Comment Card -->
            <BlogCommentCard :blogComment="blogComment" />

            <!-- Reply Card -->
            <BlogReplyCard />
          </div>

          <!-- Comment Pagination -->
          <div>
            <Pagination :links="blogComments.links" />
          </div>
        </div>

        <div v-else class="py-5">
          <p class="text-center font-bold text-gray-500 text-md">
            <i class="fa-solid fa-comment-slash"></i>
            Comments Not Yet
          </p>
        </div>
      </div>

      <!-- Comment Form -->
      <div
        v-show="
          $page.props.auth?.user &&
          $page.props.auth.user.id !== blogContent?.author_id
        "
      >
        <BlogCommentForm :blog="blogContent" />
      </div>
      <div v-show="!$page.props.auth.user" class="py-5">
        <p class="text-center text-sm font-medium text-gray-600">
          If you want to write comments you need to login first. Here
          <Link href="#" class="font-bold text-orange-600 hover:underline">
            Sign In
          </Link>
          Or
          <Link href="#" class="font-bold text-orange-600 hover:underline">
            Sign Up
          </Link>
        </p>
      </div>
    </div>
  </section>
</template>
