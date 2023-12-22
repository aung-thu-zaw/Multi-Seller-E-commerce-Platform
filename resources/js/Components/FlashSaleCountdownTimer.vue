<script setup>
import { ref, computed, onMounted } from 'vue'

const props = defineProps({ flashSale: Object })

const currentTime = ref(new Date().getTime())
const endDate = ref(new Date(props.flashSale.end_time).getTime())

const timeLeft = computed(() => endDate.value - currentTime.value)

const days = computed(() => {
  const remainingDays = Math.floor(timeLeft.value / (1000 * 60 * 60 * 24))
  return remainingDays >= 0 ? remainingDays : 0
})

const hours = computed(() => {
  const remainingHours = Math.floor((timeLeft.value % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))
  return remainingHours >= 0 ? remainingHours : 0
})

const minutes = computed(() => {
  const remainingMinutes = Math.floor((timeLeft.value % (1000 * 60 * 60)) / (1000 * 60))
  return remainingMinutes >= 0 ? remainingMinutes : 0
})

const seconds = computed(() => {
  const remainingSeconds = Math.floor((timeLeft.value % (1000 * 60)) / 1000)
  return remainingSeconds >= 0 ? remainingSeconds : 0
})

const updateTime = () => {
  setInterval(() => {
    currentTime.value = new Date().getTime()
  }, 1000)
}

onMounted(() => {
  updateTime()
})
</script>

<template>
  <div class="flex items-center space-x-5">
    <div
      class="flex flex-col items-center justify-between font-semibold bg-orange-600 text-white ring-2 ring-orange-200 w-14 h-14 p-3 rounded-sm shadow"
    >
      <span class="text-sm">{{ days }}</span>
      <span class="text-[.7rem]">Days</span>
    </div>
    <div
      class="flex flex-col items-center justify-between font-semibold bg-orange-600 text-white ring-2 ring-orange-200 w-14 h-14 p-3 rounded-sm shadow"
    >
      <span class="text-sm">{{ hours }}</span>
      <span class="text-[.7rem]">Hours</span>
    </div>
    <div
      class="flex flex-col items-center justify-between font-semibold bg-orange-600 text-white ring-2 ring-orange-200 w-14 h-14 p-3 rounded-sm shadow"
    >
      <span class="text-sm">{{ minutes }}</span>
      <span class="text-[.7rem]">Minutes</span>
    </div>
    <div
      class="flex flex-col items-center justify-between font-semibold bg-orange-600 text-white ring-2 ring-orange-200 w-14 h-14 p-3 rounded-sm shadow"
    >
      <span class="text-sm animate-pulse">{{ seconds }}</span>
      <span class="text-[.7rem]">Seconds</span>
    </div>
  </div>
</template>
