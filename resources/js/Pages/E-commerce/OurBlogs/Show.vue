<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import BlogCategoryCard from '@/Components/Cards/Blogs/BlogCategoryCard.vue'
import RelatedBlogCard from '@/Components/Cards/Blogs/RelatedBlogCard.vue'
import BlogCommentSection from '@/Components/Sections/BlogCommentSection.vue'
import { Head, Link } from '@inertiajs/vue3'

defineProps({
  share: Object,
  blogCategories: Object,
  blogContent: Object,
  relatedBlogContents: Object,
  blogComments: Object
})
</script>

<template>
  <Head :title="blogContent?.title" />

  <AppLayout>
    <section id="blog-content" class="py-5">
      <div class="w-[1280px] mx-auto flex items-start">
        <div class="min-w-[300px] w-[300px] max-w-[300px]">
          <div class="py-5 space-y-2 mb-5">
            <!-- Blog Category -->
            <BlogCategoryCard
              v-for="blogCategory in blogCategories"
              :key="blogCategory.id"
              :category="blogCategory"
            />
          </div>

          <div class="border border-b-0 border-gray-300 rounded-sm">
            <h1 class="text-lg font-bold text-gray-700 text-center py-3 border-b border-gray-300">
              Related Blogs
            </h1>

            <!-- Card -->
            <RelatedBlogCard
              v-for="relatedBlogContent in relatedBlogContents"
              :key="relatedBlogContent.id"
              :blog="relatedBlogContent"
            />
          </div>
        </div>

        <div class="w-full py-5 pl-5">
          <div class="border border-gray-300 shadow-lg rounded-md p-2">
            <img :src="blogContent.thumbnail" class="w-full max-h-[600px] object-cover" />
          </div>

          <h1 class="font-bold text-xl text-gray-700 mt-8 mb-2">
            {{ blogContent.title }}
          </h1>

          <div class="flex items-center justify-between mb-3">
            <div class="flex items-center space-x-4">
              <span class="text-xs font-bold bg-orange-500 text-white py-1 px-3 rounded-sm shadow">
                {{ blogContent.blog_category?.name }}
              </span>

              <span class="font-bold text-slate-600 text-sm">
                <i class="fa-solid fa-user"></i>
                {{ blogContent.author?.name }}
              </span>

              <span class="font-bold text-slate-600 text-sm">
                <i class="fa-solid fa-clock"></i>
                {{ blogContent.published_at }}
              </span>
            </div>

            <!-- Share Blog Social Icons Start -->
            <div class="flex items-center">
              <span class="font-bold text-slate-600 mr-3">
                <i class="fa-solid fa-share-nodes"></i> Share :
              </span>

              <a :href="share?.facebook" target="_blank">
                <i class="fa-brands fa-facebook mr-3 text-lg text-blue-600"></i>
              </a>
              <a :href="share?.twitter" target="_blank">
                <i class="fa-brands fa-twitter mr-3 text-lg text-sky-600"></i>
              </a>
              <a :href="share?.linkedin" target="_blank">
                <i class="fa-brands fa-linkedin mr-3 text-lg text-blue-800"></i>
              </a>
              <a :href="share?.reddit" target="_blank">
                <i class="fa-brands fa-reddit mr-3 text-lg text-orange-500"></i>
              </a>
              <a :href="share?.telegram" target="_blank">
                <i class="fa-brands fa-telegram mr-3 text-lg text-blue-500"></i>
              </a>
              <a :href="share?.whatsapp" target="_blank">
                <i class="fa-brands fa-whatsapp mr-3 text-lg text-emerald-600"></i>
              </a>
            </div>
            <!-- Share Blog Social Icons End -->
          </div>

          <hr class="my-3" />

          <!-- Blog Description -->
          <p v-html="blogContent.content" class="text-sm font-medium text-slate-600 mb-5"></p>

          <!-- Blog Tags Start -->
          <div v-show="blogContent?.blog_tags.length" class="flex items-center mb-5">
            <span class="font-bold text-gray-600 mr-3">{{ __('Blog Tags') }} :</span>
            <div class="flex items-center space-x-2">
              <Link
                v-for="tag in blogContent.blog_tags"
                :key="tag.id"
                :href="route('blogs.index')"
                :data="{
                  blog_category: $page.props.ziggy.query?.blog_category,
                  sort: $page.props.ziggy.query.sort ?? 'id',
                  direction: $page.props.ziggy.query.direction ?? 'desc',
                  view: $page.props.ziggy.query.view ?? 'grid',
                  tag: tag.name
                }"
                class="px-3 py-1 bg-orange-600 rounded-full text-white text-xs capitalize font-bold hover:bg-orange-700 transition-all"
              >
                {{ tag.name }}
              </Link>
            </div>
          </div>
          <!-- Blog Tags End -->

          <!-- Blog Comments Section -->
          <BlogCommentSection :blogContent="blogContent" :blogComments="blogComments" />
        </div>
      </div>
    </section>
  </AppLayout>
</template>
