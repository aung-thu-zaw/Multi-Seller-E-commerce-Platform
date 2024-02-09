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
  var config = {
    type: 'line',
    data: {
      labels: formattedMonths.value,
      datasets: [
        {
          label: new Date().getFullYear(),
          backgroundColor: '#4c51bf',
          borderColor: '#4c51bf',
          data: props.thisYearMonthlySaleData,
          fill: false
        },
        {
          label: new Date().getFullYear() - 1,
          fill: false,
          backgroundColor: '#fff',
          borderColor: '#fff',
          data: props.lastYearMonthlySaleData
        }
      ]
    },
    options: {
      maintainAspectRatio: false,
      responsive: true,
      title: {
        display: false,
        text: 'Sales Charts',
        fontColor: 'white'
      },
      legend: {
        labels: {
          fontColor: 'white'
        },
        align: 'end',
        position: 'bottom'
      },
      tooltips: {
        mode: 'index',
        intersect: false
      },
      hover: {
        mode: 'nearest',
        intersect: true
      },
      scales: {
        xAxes: [
          {
            ticks: {
              fontColor: 'rgba(255,255,255,.7)'
            },
            display: true,
            scaleLabel: {
              display: true,
              labelString: 'Month',
              fontColor: 'white'
            },
            gridLines: {
              display: true,
              borderDash: [2],
              borderDashOffset: [2],
              color: 'rgba(255, 255, 255, 0.15)',
              zeroLineColor: 'rgba(33, 37, 41, 0)',
              zeroLineBorderDash: [2],
              zeroLineBorderDashOffset: [2]
            }
          }
        ],
        yAxes: [
          {
            ticks: {
              fontColor: 'rgba(255,255,255,.7)'
            },
            display: true,
            scaleLabel: {
              display: true,
              labelString: 'Value',
              fontColor: 'white'
            },
            gridLines: {
              borderDash: [3],
              borderDashOffset: [3],
              drawBorder: true,
              color: 'rgba(255, 255, 255, 0.15)',
              zeroLineColor: 'rgba(33, 37, 41, 0)',
              zeroLineBorderDash: [2],
              zeroLineBorderDashOffset: [2]
            }
          }
        ]
      }
    }
  }
  var ctx = document.getElementById('line-chart').getContext('2d')
  window.myLine = new Chart(ctx, config)
})
</script>

<template>
  <div
    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-blueGray-700"
  >
    <div class="rounded-t mb-0 px-4 py-3 bg-transparent">
      <div class="flex flex-wrap items-center">
        <div class="relative w-full max-w-full flex-grow flex-1">
          <h6 class="uppercase text-blueGray-100 mb-1 text-xs font-semibold">
            {{ __('Overview') }}
          </h6>
          <h2 class="text-white text-xl font-semibold">
            {{ __('Total Sales Value') }}
          </h2>
        </div>
      </div>
    </div>
    <div class="p-4 flex-auto">
      <!-- Chart -->
      <div class="relative h-350-px">
        <canvas id="line-chart"></canvas>
      </div>
    </div>
  </div>
</template>
