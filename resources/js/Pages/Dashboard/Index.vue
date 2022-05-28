<template>
  <AppLayout>
    <template #header>
      <div>Dashboard</div>
    </template>

    <!-- Date filter form  -->
    <div class="flex justify-between">
      <form @submit.prevent="filter">
        <div class="grid grid-cols-5">
          <DateInput
            v-model="filterForm.month"
            type="month"
            format="YYYY-MM"
            class="pr-6"
            label="Month"
          />
          <div class="flex items-end">
            <button
              type="submit"
              class="btn-indigo"
            >
              Filter
            </button>
          </div>
        </div>
      </form>
    </div>

    <div class="flex justify-between my-4">
      <div class="grid w-full grid-cols-3">
        <div class="col-span-1">
          <div class="my-2 font-bold leading-6">
            Most Feedback
          </div>
          <div
            class="overflow-y-auto"
            style="height: calc(100vh - 300px)"
          >
            <div class="flex bg-white border-t border-b border-l">
              <div class="w-1/12 px-2 py-1 border-b border-r">
                #
              </div>
              <div class="w-9/12 px-2 py-1 border-b border-r">
                Office
              </div>
              <div class="w-2/12 px-2 py-1 border-b border-r">
                Count
              </div>
            </div>
            <div
              v-for="(row, i) in mostFeedback"
              :key="i"
              class="flex bg-white border-t border-l cursor-pointer"
              :class="{
                'text-white bg-indigo-600': chartForm.office === row.id,
              }"
              @click="selectOffice(row.id)"
            >
              <div class="w-1/12 px-2 py-1 border-b border-r">
                {{ +i + 1 }}
              </div>
              <div class="w-9/12 px-2 py-1 border-b border-r">
                {{ row.abbr }}
              </div>
              <div class="w-2/12 px-2 py-1 text-right border-b border-r">
                {{ row.feedbackCount }}
              </div>
            </div>
          </div>
        </div>
        <div class="col-span-2">
          <LineChart
            v-if="chartLoaded"
            :chartData="chartData"
          />
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import DateInput from '@/Shared/DateInput'
import LineChart from '@/Shared/Charts/LineChart'
import axios from 'axios'

export default {
  components: {
    AppLayout,
    DateInput,
    LineChart,
  },
  props: {
    mostFeedback: {
      type: Array,
      default: () => {},
    },
    filters: {
      type: [Object, Array],
      default: () => {},
    },
  },
  // setup(props){
  //   const filterForm = useForm({
  //     month: props.filters.month,
  //   })
  //
  //   return {filterForm}
  // },
  data() {
    return {
      filterForm: {
        month: this.filters.month,
      },
      chartForm: {
        month: null,
        office: null,
      },
      chartLoaded: false,
      chartData: null,
    }
  },
  watch:{
    filterForm(){
      console.log(this.filterForm)
    },
    filters(){
      console.log(this.filters)
    },
  },
  methods: {
    filter() {
      console.log(this.filterForm)

      this.$inertia.get(this.route('dashboard'), this.filterForm, {replace: true})
    },
    selectOffice(id) {
      this.chartForm.month = this.filterForm.month
      this.chartForm.office = id

      // this.$inertia.post(this.route('dashboard'), this.chartForm, {
      //   onSuccess: (page) => {
      //
      //   },
      // })

      axios
        .post(this.route('dashboard.office'), this.chartForm, {
          headers: {
            'X-CSRF-TOKEN': document.head.querySelector(
              'meta[name="csrf-token"]',
            ).content,
            'X-Requested-With': 'XMLHttpRequest',
          },
        })
        .then((response) => {
          this.sending = false
          this.chartLoaded = true

          this.chartData = response.data
        })
        .catch((e) => {
          this.sending = false
          console.log('error', e)
          console.log('error.response', e.response)
        })
    },
  },
}
</script>
