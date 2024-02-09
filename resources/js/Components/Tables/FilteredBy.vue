<script setup>
import TableFilteredBadge from '@/Components/Badges/TableFilteredBadge.vue'
import { useQueryStringParams } from '@/Composables/useQueryStringParams'

defineProps({ to: String })

const { dashboardQueryStringParams } = useQueryStringParams()
</script>

<template>
  <div
    v-show="
      dashboardQueryStringParams?.created_from ||
      dashboardQueryStringParams?.created_until ||
      dashboardQueryStringParams?.deleted_from ||
      dashboardQueryStringParams?.deleted_until ||
      dashboardQueryStringParams?.filter_by_status
    "
    class="mb-5 px-2 flex items-center"
  >
    <p class="font-bold text-blueGray-700 text-sm mr-1">{{ __('Filtered By') }} :</p>

    <div class="flex items-center space-x-3">
      <TableFilteredBadge
        v-show="dashboardQueryStringParams?.created_from"
        :to="to"
        filterKey="created_from"
        label="Created From"
      />
      <TableFilteredBadge
        v-show="dashboardQueryStringParams?.created_until"
        :to="to"
        filterKey="created_until"
        label="Created Until"
      />
      <TableFilteredBadge
        v-show="dashboardQueryStringParams?.deleted_from"
        :to="to"
        filterKey="deleted_from"
        label="Deleted From"
      />
      <TableFilteredBadge
        v-show="dashboardQueryStringParams?.deleted_until"
        :to="to"
        filterKey="deleted_until"
        label="Deleted Until"
      />
      <TableFilteredBadge
        v-show="dashboardQueryStringParams?.filter_by_status"
        :to="to"
        filterKey="filter_by_status"
        label="Status"
      />
    </div>
  </div>
</template>
