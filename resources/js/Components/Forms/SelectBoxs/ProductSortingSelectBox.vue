<script setup>
</script>

<template>
  <div>
    <label for="sort-by" class="font-bold text-sm text-gray-600"> {{ __('Sort By') }} : </label>
    <select
      id="product-sort-by"
      class="w-[150px] p-3.5 font-medium text-sm text-gray-500 border border-gray-300 rounded-lg bg-gray-50 focus:ring-2 focus:ring-orange-300 focus:border-orange-400"
    >
      <option>
        {{ __('Top Sales') }}
      </option>
      <option>
        {{ __('Newest Arrivals') }}
      </option>
      <option>
        {{ __('Price Low To High') }}
      </option>
      <option>
        {{ __('Price High To Low') }}
      </option>
    </select>
  </div>
</template>
