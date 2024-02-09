<script setup>
const props = defineProps({ orderItems: Object })

const steps = [
  { icon: 'fas fa-spinner animate-spin', label: 'Pending' },
  { icon: 'fas fa-rotate animate-spin', label: 'Processing' },
  { icon: 'fa-solid fa-people-carry-box animate-pulse', label: 'Ready To Ship' },
  { icon: 'fa-solid fa-truck-fast animate-pulse', label: 'Shipped' },
  { icon: 'fa-solid fa-truck-ramp-box animate-pulse', label: 'Delivered' }
]

const getStatusColor = (step) => {
  const currentStatusIndex = steps.findIndex(
    (s) => s.label.toLowerCase() === props.orderItems[0].status
  )
  const stepIndex = steps.findIndex((s) => s.label.toLowerCase() === step.label.toLowerCase())

  return {
    'bg-orange-500 text-white border-orange-600': stepIndex <= currentStatusIndex,
    'bg-white text-gray-800 border-gray-300': stepIndex > currentStatusIndex
  }
}
</script>

<template>
  <!-- Stepper -->
  <ul
    class="relative flex flex-row gap-x-2 p-5 max-w-3xl mx-auto border bg-gray-100 rounded-md items-center justify-center"
  >
    <!-- Loop through steps -->
    <li
      v-for="(step, index) in steps"
      :key="index"
      class="shrink basis-0 group"
      :class="{ 'flex-1': index !== steps.length - 1 }"
    >
      <div
        class="min-w-[28px] min-h-[28px] flex flex-col items-center md:w-full md:inline-flex md:flex-wrap md:flex-row text-xs align-middle"
      >
        <span
          class="w-7 h-7 flex justify-center items-center flex-shrink-0 border font-medium rounded-full"
          :class="{
            ...getStatusColor(step)
          }"
        >
          <i :class="step.icon"></i>
        </span>
        <div
          class="mt-2 w-px h-full md:mt-0 md:ms-2 md:w-full md:h-px md:flex-1 bg-gray-300 group-last:hidden"
        ></div>
      </div>
      <div class="grow md:grow-0 mt-2">
        <span class="block text-xs font-semibold text-gray-800">{{ step.label }}</span>
      </div>
    </li>
    <!-- End Loop through steps -->
  </ul>
  <!-- End Stepper -->
</template>
