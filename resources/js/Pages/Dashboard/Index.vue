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
      chartGradient: null,
      chartGradient2: null,
    };
  },
  watch: {},
  mounted() {
    // this.$nextTick(function () {
    // });
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
          // responseType: "blob", // important
        })
        .then((response) => {
          this.sending = false;
          this.chartLoaded = true;
          if (!this.chartGradient) {
            this.applyGradient();
          }
          // console.log("response.data", response.data);

          (this.chartData = {
            labels: response.data.labels,
            datasets: [
              {
                label: "Number of Feedback",
                data: response.data.data,
                backgroundColor: this.chartGradient,
                borderColor: "#05CBE1",
                pointBackgroundColor: "white",
              },
            ],
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
      this.chartGradient = document
        .querySelector("canvas")
        .getContext("2d")
        .createLinearGradient(0, 0, 0, 450);
      this.chartGradient2 = document
        .querySelector("canvas")
        .getContext("2d")
        .createLinearGradient(0, 0, 0, 450);

      this.chartGradient.addColorStop(0, "rgba(0, 231, 255, 0.9)");
      this.chartGradient.addColorStop(0.5, "rgba(0, 231, 255, 0.25)");
      this.chartGradient.addColorStop(1, "rgba(0, 231, 255, 0)");

      this.chartGradient2.addColorStop(0, "rgba(255, 0,0, 0.5)");
      this.chartGradient2.addColorStop(0.5, "rgba(255, 0, 0, 0.25)");
      this.chartGradient2.addColorStop(1, "rgba(255, 0, 0, 0)");
    },
  },
};
</script>
