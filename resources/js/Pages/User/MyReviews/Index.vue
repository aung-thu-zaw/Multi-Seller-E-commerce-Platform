<script setup>
import UserDashboardLayout from '@/Layouts/UserDashboardLayout.vue'
import NeedToReviewCardByStore from '@/Components/Cards/Reviews/NeedToReviewCardByStore.vue'
import { Head, Link } from '@inertiajs/vue3'
import Pagination from '@/Components/Paginations/Pagination.vue'

defineProps({ productsToReview: Object })
</script>

<template>
  <Head :title="__('My Reviews')" />
  <UserDashboardLayout>
    <h1 class="font-bold text-md text-gray-700 mb-5 pb-5 border-b">
      <i class="fa-solid fa-star"></i>
      {{ __('My Reviews') }}
    </h1>

    <div class="border border-gray-300 bg-white rounded-md px-5">
      <nav class="flex items-center space-x-5 w-full">
        <Link
          as="button"
          :href="route('user.my-reviews.index')"
          :data="{ tab: 'to-review' }"
          class="py-4 px-1 inline-flex items-center gap-x-1.5 text-sm font-semibold whitespace-nowrap text-gray-600 hover:text-orange-600"
          :class="{
            'border-b-2 font-semibold border-orange-600 text-orange-600':
              $page.props.ziggy.query?.tab === 'to-review' || !$page.props.ziggy.query?.tab
          }"
        >
          To Review
          <div
            v-show="productsToReview.data.length"
            class="bg-orange-200 rounded-full w-5 h-5 flex items-center justify-center"
          >
            <span class="text-xs text-orange-600">{{ productsToReview.total }}</span>
          </div>
        </Link>

        <Link
          as="button"
          :href="route('user.my-reviews.index')"
          :data="{ tab: 'history-reviewed' }"
          class="py-4 px-1 inline-flex items-center gap-x-1.5 text-sm font-semibold whitespace-nowrap text-gray-600 hover:text-orange-600"
          :class="{
            'border-b-2 font-semibold border-orange-600 text-orange-600':
              $page.props.ziggy.query?.tab === 'history-reviewed'
          }"
        >
          History Reviewed
        </Link>
      </nav>
    </div>

    <div class="mt-3">
      <div v-show="$page.props.ziggy.query?.tab === 'to-review'">
        <div
          v-if="productsToReview.data.length"
          class="border border-gray-200 bg-white rounded-md space-y-5"
        >
          <NeedToReviewCardByStore :productsToReview="productsToReview" />

          <div>
            <Pagination :links="productsToReview.links" />
          </div>
        </div>
        <div v-else class="py-20 bg-white border border-gray-300 rounded-md">
          <h2 class="font-semibold text-md text-center text-gray-600">
            <i class="fas fa-star"></i>
            There are no reviews yet.
          </h2>
        </div>
      </div>
    </div>
  </UserDashboardLayout>
</template>
