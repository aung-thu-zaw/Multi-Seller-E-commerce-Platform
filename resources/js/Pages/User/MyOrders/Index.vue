<script setup>
import UserDashboardLayout from '@/Layouts/UserDashboardLayout.vue'
import OrderCard from './Partials/OrderCard.vue'
import { Head, Link } from '@inertiajs/vue3'
import Pagination from '@/Components/Paginations/Pagination.vue'

defineProps({ orders: Object })
</script>

<template>
  <Head :title="__('My Orders')" />
  <UserDashboardLayout>
    <h1 class="font-bold text-md text-gray-700 mb-5 pb-5 border-b">
      <i class="fa-solid fa-boxes-packing"></i>
      {{ __('My Orders') }}
    </h1>

    <div class="border border-gray-300 bg-white rounded-md px-5">
      <nav class="flex items-center space-x-5 w-full">
        <Link
          as="button"
          :href="route('user.my-orders.index')"
          :data="{ tab: 'all' }"
          class="py-4 px-1 inline-flex items-center gap-x-1.5 text-sm font-semibold whitespace-nowrap text-gray-600 hover:text-orange-600"
          :class="{
            'border-b-2 font-semibold border-orange-600 text-orange-600':
              $page.props.ziggy.query?.tab === 'all' || !$page.props.ziggy.query?.tab
          }"
        >
          All
          <div
            v-show="orders.data.length"
            class="bg-orange-200 rounded-full w-5 h-5 flex items-center justify-center"
          >
            <span class="text-xs text-orange-600">{{ orders.data.length }}</span>
          </div>
        </Link>
        <Link
          as="button"
          :href="route('user.my-orders.index')"
          :data="{ tab: 'to-pay' }"
          class="py-4 px-1 inline-flex items-center gap-x-1.5 text-sm font-semibold whitespace-nowrap text-gray-600 hover:text-orange-600"
          :class="{
            'border-b-2 font-semibold border-orange-600 text-orange-600':
              $page.props.ziggy.query?.tab === 'to-pay'
          }"
        >
          To Pay
        </Link>
        <Link
          as="button"
          :href="route('user.my-orders.index')"
          :data="{ tab: 'to-ship' }"
          class="py-4 px-1 inline-flex items-center gap-x-1.5 text-sm font-semibold whitespace-nowrap text-gray-600 hover:text-orange-600"
          :class="{
            'border-b-2 font-semibold border-orange-600 text-orange-600':
              $page.props.ziggy.query?.tab === 'to-ship'
          }"
        >
          To Ship
        </Link>
        <Link
          as="button"
          :href="route('user.my-orders.index')"
          :data="{ tab: 'to-receive' }"
          class="py-4 px-1 inline-flex items-center gap-x-1.5 text-sm font-semibold whitespace-nowrap text-gray-600 hover:text-orange-600"
          :class="{
            'border-b-2 font-semibold border-orange-600 text-orange-600':
              $page.props.ziggy.query?.tab === 'to-receive'
          }"
        >
          To Receive
        </Link>
      </nav>
    </div>

    <div class="mt-3">
      <div v-show="$page.props.ziggy.query?.tab === 'all' || !$page.props.ziggy.query?.tab">
        <div v-if="orders.data.length" class="space-y-5">
          <OrderCard v-for="order in orders.data" :key="order.id" :order="order" />

          <div>
            <Pagination :links="orders.links" />
          </div>
        </div>
        <div v-else class="py-20 bg-white border border-gray-300 rounded-md">
          <h2 class="font-semibold text-md text-center text-gray-600">
            <i class="fas fa-boxes-packing"></i>
            There are no orders yet.
          </h2>
        </div>
      </div>

      <div v-show="$page.props.ziggy.query?.tab === 'to-pay'">
        <div v-if="orders.data.length" class="space-y-5">
          <OrderCard v-for="order in orders.data" :key="order.id" :order="order" />

          <div>
            <Pagination :links="orders.links" />
          </div>
        </div>
        <div v-else class="py-20 bg-white border border-gray-300 rounded-md">
          <h2 class="font-semibold text-md text-center text-gray-600">
            <i class="fas fa-boxes-packing"></i>
            There are no orders yet.
          </h2>
        </div>
      </div>

      <div v-show="$page.props.ziggy.query?.tab === 'to-ship'">
        <div v-if="orders.data.length" class="space-y-5">
          <OrderCard v-for="order in orders.data" :key="order.id" :order="order" />

          <div>
            <Pagination :links="orders.links" />
          </div>
        </div>
        <div v-else class="py-20 bg-white border border-gray-300 rounded-md">
          <h2 class="font-semibold text-md text-center text-gray-600">
            <i class="fas fa-boxes-packing"></i>
            There are no orders yet.
          </h2>
        </div>
      </div>

      <div v-show="$page.props.ziggy.query?.tab === 'to-receive'">
        <div v-if="orders.data.length" class="space-y-5">
          <OrderCard v-for="order in orders.data" :key="order.id" :order="order" />

          <div>
            <Pagination :links="orders.links" />
          </div>
        </div>
        <div v-else class="py-20 bg-white border border-gray-300 rounded-md">
          <h2 class="font-semibold text-md text-center text-gray-600">
            <i class="fas fa-boxes-packing"></i>
            There are no orders yet.
          </h2>
        </div>
      </div>
    </div>
  </UserDashboardLayout>
</template>
