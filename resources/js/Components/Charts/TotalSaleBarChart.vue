<script setup>
import Chart from 'chart.js'
import { computed, onMounted } from 'vue'

const props = defineProps({
  thisYearMonthlySaleLabels: Object,
  thisYearMonthlySaleData: Object,
  lastYearMonthlySaleLabels: Object,
  lastYearMonthlySaleData: Object
})

const monthNames = [
  'January',
  'February',
  'March',
  'April',
  'May',
  'June',
  'July',
  'August',
  'September',
  'October',
  'November',
  'December'
]

const formattedMonths = computed(() => {
  return props.thisYearMonthlySaleLabels.map((month) => monthNames[month - 1])
})

onMounted(() => {
  let config = {
    type: 'bar',
    data: {
      labels: formattedMonths.value,
      datasets: [
        {
          label: new Date().getFullYear(),
          backgroundColor: '#d74c1d',
          borderColor: '#d74c1d',
          data: props.thisYearMonthlySaleData,
          fill: false,
          barThickness: 16
        },
        {
          label: new Date().getFullYear() - 1,
          fill: false,
          backgroundColor: '#006b9c',
          borderColor: '#006b9c',
          data: props.lastYearMonthlySaleData,
          barThickness: 16
        }
      ]
    },
    options: {
      maintainAspectRatio: false,
      responsive: true,
      title: {
        display: false,
        text: 'Orders Chart'
      },
      tooltips: {
        mode: 'index',
        intersect: false
      },
      hover: {
        mode: 'nearest',
        intersect: true
      },
      legend: {
        labels: {
          fontColor: 'rgba(0,0,0,.4)'
        },
        align: 'end',
        position: 'bottom'
      },
      scales: {
        xAxes: [
          {
            display: true,
            scaleLabel: {
              display: true,
              labelString: 'Month'
            },
            gridLines: {
              borderDash: [2],
              borderDashOffset: [2],
              color: 'rgba(33, 37, 41, 0.3)',
              zeroLineColor: 'rgba(33, 37, 41, 0.3)',
              zeroLineBorderDash: [2],
              zeroLineBorderDashOffset: [2]
            }
          }
        ],
        yAxes: [
          {
            display: true,
            scaleLabel: {
              display: true,
              labelString: 'Value'
            },
            gridLines: {
              borderDash: [2],
              drawBorder: false,
              borderDashOffset: [2],
              color: 'rgba(33, 37, 41, 0.2)',
              zeroLineColor: 'rgba(33, 37, 41, 0.15)',
              zeroLineBorderDash: [2],
              zeroLineBorderDashOffset: [2]
            }
          }
        ]
      }
    }
  }
  let ctx = document.getElementById('sale-bar-chart').getContext('2d')
  window.myBar = new Chart(ctx, config)
})
</script>

<template>
  <div
    class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded border"
  >
    <div class="rounded-t mb-0 px-4 py-3 bg-transparent">
      <div class="flex flex-wrap items-center">
        <div class="relative w-full max-w-full flex-grow flex-1">
          <h6 class="uppercase text-blueGray-400 mb-1 text-xs font-semibold">
            {{ __('PERFORMANCE') }}
          </h6>
          <h2 class="text-blueGray-700 text-xl font-semibold">
            {{ __('Total Sales Value') }}
          </h2>
        </div>
      </div>
    </div>
    <div class="p-4 flex-auto">
      <div class="relative h-350-px">
        <canvas id="sale-bar-chart"></canvas>
      </div>
    </div>
  </div>
</template>
