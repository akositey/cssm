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
              class="flex bg-white border-t border-l cursor-pointer"
              :class="{'text-white bg-indigo-600':chartForm.office===row.id}"
              v-for="(row,i) in mostFeedback"
              :key="i"
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
          <line-chart
            v-show="chartLoaded"
            :chartData="chartData"
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
import LineChart from "./LineChart";
import axios from "axios";
import {CHART_COLORS} from "../../Shared/colors";

export default {
  components: {
    AppLayout,
    DateInput,
    LineChart,
  },
  props: {
    mostFeedback: {
      type: Array,
      default: () => {
      },
    },
    filters: {
      type: [Object, Array], default: () => {
      }
    },
    // chartData: {
    //   type: Object,
    //   default: null,
    // },
  },
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
      chartOptions: null,
      chartGradients: [],
    };
  },
  watch: {},
  mounted() {
    // this.$nextTick(function () {
    // });
  },
  computed: {
    borderColors(){
      return Object.keys(CHART_COLORS);
    },
  },
  methods: {
    filter() {
      this.$inertia.replace(this.route("dashboard"), {
        data: this.filterForm,
      });
    },
    selectOffice(id) {
      this.chartForm.month = this.filterForm.month;
      this.chartForm.office = id;

      axios
        .post(this.route("dashboard.office"), this.chartForm, {
          headers: {
            "X-CSRF-TOKEN": document.head.querySelector(
              'meta[name="csrf-token"]'
            ).content,
            "X-Requested-With": "XMLHttpRequest",
          },
        })
        .then((response) => {
          this.sending = false;
          this.chartLoaded = true;
          if (this.chartGradients.length === 0) {
            this.applyGradient();
          }

          const datasets = response.data.datasets.map((set, i) => {
            return {
              ...set,
              backgroundColor: this.chartGradients[i],
              borderColor: this.borderColors[i],
              pointBackgroundColor: "white",
            }
          });

          (this.chartData = {
            labels: response.data.labels,
            datasets: datasets
          }),
            (this.chartOptions = {
              responsive: true,
              maintainAspectRatio: false,
            });
        })
        .catch((e) => {
          this.sending = false;
          console.log("error", e);
          console.log("error.response", e.response);
        });
    },
    applyGradient() {
      Object.values(CHART_COLORS).map((colorStops) => {
        let chartGradient = document
          .querySelector("canvas")
          .getContext("2d")
          .createLinearGradient(0, 0, 0, 450);

        for (let i = 0; i < colorStops.length; i++) {
          chartGradient.addColorStop((i/colorStops.length), colorStops[i]);
        }

        this.chartGradients.push(chartGradient)
      });
    },
  },
};
</script>
