<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import BlogSearchBox from "@/Components/Forms/SearchBoxs/BlogSearchBox.vue";
import BlogSortingSelectBox from "@/Components/Forms/SelectBoxs/BlogSortingSelectBox.vue";
import BlogGridCard from "@/Components/Cards/Blogs/BlogGridCard.vue";
import BlogListCard from "@/Components/Cards/Blogs/BlogListCard.vue";
import BlogCategoryCard from "@/Components/Cards/Blogs/BlogCategoryCard.vue";
import Pagination from "@/Components/Paginations/Pagination.vue";
import { Head, Link, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

defineProps({ blogCategories: Object, blogContents: Object });

const params = computed(() => {
  return {
    search_blog: usePage().props.ziggy.query?.search_blog,
    sort: usePage().props.ziggy.query?.sort,
    direction: usePage().props.ziggy.query?.direction,
    page: usePage().props.ziggy.query?.page,
    blog_category: usePage().props.ziggy.query?.blog_category,
    view: usePage().props.ziggy.query?.view,
  };
});
</script>

<template>
  <Head title="Our Blogs" />

  <AppLayout>
    <section id="blog-content" class="py-5">
      <div class="w-[1280px] mx-auto flex items-start">
        <div class="min-w-[300px] py-5 space-y-2">
          <!-- Blog Category -->
          <BlogCategoryCard
            v-for="blogCategory in blogCategories"
            :key="blogCategory.id"
            :category="blogCategory"
          />
        </div>

        <div class="w-full py-5 pl-5">
          <div
            class="py-2 mb-3 flex items-center justify-between border-t border-b"
          >
            <BlogSearchBox />

            <div class="flex items-center space-x-5">
              <BlogSortingSelectBox />

              <div class="">
                <label for="view" class="font-bold text-sm text-gray-600">
                  View :
                </label>

                <Link
                  as="button"
                  :href="route('blogs.index')"
                  :data="{
                    search_blog: params.search_blog,
                    blog_category: params.blog_category,
                    sort: params.sort,
                    direction: params.direction,
                    page: params.page,
                    view: 'grid',
                  }"
                  class="px-2 py-1 rounded-md cursor-pointer bg-gray-200 text-gray-600 hover:bg-gray-300 transition-none mr-2"
                  :class="{
                    'bg-orange-500 text-white hover:bg-orange-600':
                      params.view === 'grid' || !params.view,
                  }"
                >
                  <i class="fa-solid fa-grip"></i>
                </Link>

                <Link
                  as="button"
                  :href="route('blogs.index')"
                  :data="{
                    search_blog: params.search_blog,
                    blog_category: params.blog_category,
                    sort: params.sort,
                    direction: params.direction,
                    page: params.page,
                    view: 'list',
                  }"
                  class="px-2 py-1 rounded-md cursor-pointer bg-gray-200 text-gray-600 hover:bg-gray-300 transition-none"
                  :class="{
                    'bg-orange-500 text-white hover:bg-orange-600':
                      params.view === 'list',
                  }"
                >
                  <i class="fa-solid fa-list"></i>
                </Link>
              </div>
            </div>
          </div>

          <!-- Filtered By -->
          <div
            v-if="params.blog_category || params.search_blog"
            class="my-5 px-2 flex items-center"
          >
            <div v-show="params.blog_category" class="flex items-center">
              <p class="font-bold text-blueGray-700 text-sm mr-1">
                {{ __("Filtered By") }} :
              </p>

              <div class="flex items-center space-x-3">
                <div
                  class="inline-flex flex-nowrap items-center bg-white border border-gray-200 rounded-full px-2 py-1.5"
                >
                  <div
                    class="whitespace-nowrap text-xs font-bold text-gray-700 capitalize"
                  >
                    Category : {{ params.blog_category }}
                  </div>
                  <Link
                    as="button"
                    :href="route('blogs.index')"
                    :data="{
                      search_blog: params.search_blog,
                      sort: params.sort,
                      direction: params.direction,
                      page: params.page,
                      view: params.view,
                    }"
                    class="ms-2.5 inline-flex justify-center items-center h-2 w-2 rounded-full text-gray-600 text-xs hover:text-red-600 transition-all cursor-pointer"
                  >
                    <i class="fa-solid fa-circle-xmark"></i>
                  </Link>
                </div>
              </div>
            </div>

            <p
              v-show="params.search_blog"
              class="text-sm font-medium text-gray-700 ml-auto"
            >
              {{ blogContents.total }} post(s) found for result
              <span class="text-orange-500 font-semibold">
                "{{ params.search_blog }}"
              </span>
            </p>
          </div>

          <div v-if="blogContents.data.length">
            <!-- Blog Grid Card -->
            <div
              v-show="params.view === 'grid' || !params.view"
              class="grid grid-cols-3 gap-5 w-full"
            >
              <BlogGridCard
                v-for="blogContent in blogContents.data"
                :key="blogContent.id"
                :blog="blogContent"
              />
            </div>

            <!-- Blog List Card -->
            <div
              v-show="params.view === 'list'"
              class="grid grid-cols-1 gap-5 w-full"
            >
              <BlogListCard
                v-for="blogContent in blogContents.data"
                :key="blogContent.id"
                :blog="blogContent"
              />
            </div>

            <!-- Pagination -->
            <div class="my-5 py-5">
              <Pagination :links="blogContents.links" />
            </div>
          </div>
          <div v-else class="py-20">
            <p class="text-center font-bold text-md text-red-600">
              <i class="fa-solid fa-file-circle-xmark"></i>
              We're sorry we can't find any matches for your filter term.
            </p>
          </div>
        </div>
      </div>
    </section>
  </AppLayout>
</template>
