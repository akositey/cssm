<script>
import {Line} from 'vue-chartjs'
import {CategoryScale, Chart as ChartJS, Legend, LinearScale, LineElement, PointElement, Title, Tooltip} from 'chart.js'
import {defineComponent, h} from 'vue'

ChartJS.register(Title,
  Tooltip,
  Legend,
  LineElement,
  LinearScale,
  PointElement,
  CategoryScale)


export default defineComponent({
  name: 'LineChart',
  components: {
    Line,
  },
  props: {
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
    chartId: {
      type: String,
      default: 'line-chart',
    },
    width: {
      type: Number,
      default: 400,
    },
    height: {
      type: Number,
      default: 400,
    },
    cssClasses: {
      default: '',
      type: String,
    },
    styles: {
      type: Object,
      default: () => {
      },
    },
    plugins: {
      type: Array,
      default: () => [],
    },
  },

  setup(props){
    return () =>
      h(Line, {...props})
  },



})

// const chartGradients = ref([])
// const borderColors = ref([])
// const chartDataFull = ref({
//   labels: [],
//   datasets: [],
//   backgroundColor: null,
//   borderColor: null,
//   pointBackgroundColor: null,
// })

// watch(()=>props.chartData, () => {
//   console.log('watching ...')
//   if(!props.chartData){
//     console.log('props.chartData is', props.chartData)
//
//     return
//   }

// console.log(this.$refs)
// chartDataFull.value = addGradient(props.chartData)
//   chartDataFull.value = props.chartData
// })

// const chartDataFull = computed(()=>{
//   let addGradient1 = addGradient(props.chartData)
//   console.log(addGradient1)
//   return addGradient1
// })

// function getGradientBackGroundForColorIndex(colorIndex){
//   const colorStops = Object.values(CHART_COLORS)[colorIndex]
//   let chartGradient = this.$refs.lineChart.value.canvasRef.getContext('2d')
//     .createLinearGradient(0, 0, 0, 450)
//
//   for (let i = 0; i < colorStops.length; i++) {
//     chartGradient.addColorStop(i / colorStops.length, colorStops[i])
//   }
//   console.log('chartGradient', chartGradient)
//
//   return chartGradient
// }
//
// function addGradient(chartData) {
//   console.log('addGradient...')
//
//   chartData.datasets = chartData.datasets.map((set, i) => {
//     return {
//       ...set,
//       backgroundColor: getGradientBackGroundForColorIndex(i),
//       borderColor: Object.keys(CHART_COLORS)[i],
//       pointBackgroundColor: 'white',
//     }
//   })
//
//   console.log('chartData', chartData.datasets)
//
//
//   return chartData
// }
//
// function setChartGradients() {
//   console.log('setChartGradients')
//
//   Object.values(CHART_COLORS).map((colorStops) => {
//     let chartGradient = this.$refs.lineCanvas.value.getContext('2d')
//       .createLinearGradient(0, 0, 0, 450)
//
//     for (let i = 0; i < colorStops.length; i++) {
//       chartGradient.addColorStop(i / colorStops.length, colorStops[i])
//     }
//     console.log('chartGradient', chartGradient)
//
//     chartGradients.value.push(chartGradient)
//   })
// }
//
// function setBorderColors() {
//   borderColors.value = Object.keys(CHART_COLORS)
// }


</script>

<!--<template>-->
<!--  <Line-->
<!--    ref="lineChart"-->
<!--    :chartData="props.chartData"-->
<!--  />-->
<!--</template>-->
