<script setup>
import LineBase from '@/Shared/Charts/LineBase'
import {computed, ref} from 'vue'
import {CHART_COLORS} from '@/Shared/colors'

const props = defineProps({
  chartData: {
    type: Object,
    required: true,
  },
  chartOptions: {
    type: Object,
    default: () => {
      return {
        responsive: true,
        maintainAspectRatio: false,
      }
    },
  },
})


const lineChartBase = ref(null)

const chartDataWithColors = computed(() => {
  let oldSets = props.chartData.datasets
  const datasetLength = oldSets.length
  let newSets = []
  for (let i = 0; i < datasetLength; i++) {
    newSets.push({
      ...oldSets[i],
      backgroundColor: Object.values(CHART_COLORS)[i][0], //TODO: apply dynamic gradient background
      borderColor: Object.keys(CHART_COLORS)[i],
      pointBackgroundColor: 'white',
    })
  }
  console.log('chartDataWithColors', newSets)
  return {
    labels: props.chartData.labels,
    datasets: newSets,
  }
})

</script>
<template>
  <LineBase
    v-if="chartDataWithColors"
    ref="lineChartBase"
    :chartData="chartDataWithColors"
    :chartOptions="chartOptions"
  />
</template>
