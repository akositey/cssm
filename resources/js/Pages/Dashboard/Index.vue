<template>
  <app-layout>
    <template #header>
      Dashboard
    </template>

    <div class="flex justify-between">
      <form @submit.prevent="filter">
        <div class="grid grid-cols-5">
          <date-input
            type="month"
            format="YYYY-MM"
            v-model="filterForm.month"
            class="pr-6 "
            label="Month"
          />
          <div class="flex items-end">
            <button
              type="submit"
              class="btn-indigo"
            >
              Filter
            </button>
            <button
              class="p-3 text-sm text-gray-500 hover:text-gray-700 focus:text-indigo-500"
              type="button"
              @click="reset"
            >
              Reset
            </button>
          </div>
        </div>
      </form>
    </div>
    <div class="flex justify-between my-4">
      <div class="w-1/2 md:w-1/3">
        <div class="">
          <div class="my-2 font-bold leading-6">
            Most Feedback
          </div>
          <div class="overflow-y-auto h-96">
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
              class="flex bg-white border-t border-l"
              v-for="(row,i) in mostFeedback"
              :key="i"
              @click="getOfficeStats"
            >
              <div class="w-1/12 px-2 py-1 border-b border-r">
                {{ +i+1 }}
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
        <div>
          <line-chart
            v-if="chartLoaded"
            :chartdata="chartData"
            :options="chartOptions"
          />
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "~/Layouts/AppLayout";
import DateInput from "~/Shared/DateInput";
import mapValues from "lodash/mapValues";
import LineChart from "./LineChart";

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
    filters: { type: [Object, Array], default: () => {} },
    chartData: {
      type: Object,
      default: null,
    },
    chartOptions: {
      type: Object,
      default: null,
    },
  },
  data() {
    return {
      filterForm: {
        month: this.filters.month,
        office: this.filters.office,
      },
      selectedOffice: {},
      chartLoaded: false,
    };
  },
  watch: {
    chartData() {
      this.$data._chart.update();
    },
  },
  methods: {
    filter() {
      this.$inertia.replace(this.route("dashboard"), {
        data: this.filterForm,
      });
    },
    reset() {
      this.filterForm = mapValues(this.filterForm, () => null);
      this.submit();
    },
    getOfficeStats() {
      // this.$inertia.post(this.route("dashboard.office"), this.filterForm);
    },
  },
};
</script>
