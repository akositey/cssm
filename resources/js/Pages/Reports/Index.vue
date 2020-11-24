<template>
  <app-layout>
    <template #header>
      <div class="flex justify-between">
        Reports
      </div>
    </template>

    <div class="flex justify-between">
      <form @submit.prevent="submit">
        <div class="grid grid-cols-5">
          <select-input
            v-model="filterForm.office"
            class="pr-6"
            label="Office"
          >
            <option :value="null">
              All
            </option>
            <option
              v-for="(office,i) in offices"
              :key="i"
              :value="office.id"
            >
              {{ office.abbr }}
            </option>
          </select-input>
          <date-input
            type="month"
            format="YYYY-MM"
            v-model="filterForm.month"
            class="pr-6"
            label="Month"
          />
          <div class="flex items-end">
            <button
              type="submit"
              class="btn-green"
            >
              View Report
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

    <table class="w-full my-4 whitespace-no-wrap bg-white">
      <thead class="bg-gray-200 border border-black border-double">
        <tr class="border">
          <th
            class="p-2 border border-black border-double"
            rowspan="3"
          >
            Service
          </th>
          <th
            class="p-2 border border-black border-double"
            rowspan="3"
          >
            Question
          </th>
          <th
            class="w-0 p-2 text-sm whitespace-normal border border-black border-double"
            rowspan="3"
          >
            Clients Served
          </th>
          <th
            class="p-2 border border-black border-double"
            colspan="5"
          >
            Quality in Service
          </th>
          <th
            class="p-2 border border-black border-double"
            rowspan="3"
          >
            % in VS &amp; O
          </th>
        </tr>
        <tr class="border">
          <th
            class="border border-black border-double"
            v-for="num in 5"
            :key="num"
            width="30"
          >
            {{ num }}
          </th>
        </tr>
        <tr class="border">
          <th
            class="border border-black border-double"
            v-for="letter in ['P','F','S','VS','O']"
            :key="letter"
            width="30"
          >
            {{ letter }}
          </th>
        </tr>
      </thead>
      <tbody
        class="border border-black border-double"
        v-for="(service,i) in stats.ratings.services"
        :key="i"
      >
        <tr
          v-for="(question,x) in service.questions"
          :key="x"
        >
          <td
            class="font-bold text-center"
            rowspan="3"
            v-if="x===0"
          >
            {{ service.service }}
          </td>
          <td class="border">
            {{ question.question }}
          </td>
          <td
            class="text-center border"
            rowspan="3"
            v-if="x===0"
          >
            {{ service.clients }}
          </td>
          <td
            v-for="(rating,y) in question.ratings"
            :key="y"
            class="text-center border"
          >
            {{ rating }}
          </td>
          <td
            class="text-center border"
            rowspan="3"
            v-if="x===0"
          >
            {{ service.goodPercent }}
          </td>
        </tr>
        <tr>
          <td />
          <td class="text-center bg-yellow-300 border">
            Average (% Rating)
          </td>
          <td class="bg-yellow-300 border" />
          <td
            v-for="(average,x) in service.averagePercent"
            :key="'avg'+x"
            class="text-center bg-yellow-300 border"
          >
            {{ average }}
          </td>
          <td class="bg-yellow-300 border" />
        </tr>
        <tr>
          <td />
          <td
            colspan="9"
            class="h-2"
          />
        </tr>
        <tr v-if="service.comments.positive">
          <td />
          <td
            colspan="8"
            class="font-bold border-b border-black border-double"
          >
            Positive Comments/Suggestions
          </td>
        </tr>
        <tr
          v-for="(comment,x) in service.comments.positive"
          :key="'pos'+x"
        >
          <td />
          <td
            colspan="8"
            class="border"
          >
            {{ comment }}
          </td>
        </tr>
        <tr>
          <td />
          <td
            colspan="9"
            class="h-2"
          />
        </tr>
        <tr v-if="service.comments.negative">
          <td />
          <td
            colspan="8"
            class="font-bold border-b border-black border-double"
          >
            Negative Comments/Suggestions
          </td>
        </tr>
        <tr
          v-for="(comment,x) in service.comments.negative"
          :key="'neg'+x"
        >
          <td />
          <td
            colspan="8"
            class="text-red-600 border"
          >
            {{ comment }}
          </td>
        </tr>
        <tr>
          <td
            colspan="9"
            class="h-2 border border-black border-double"
          />
        </tr>
      </tbody>
      <tfoot
        class="border border-black border-double"
        v-if="stats.ratings.total"
      >
        <tr class="bg-orange-400">
          <th class="border border-black border-double" />
          <th class="border border-black border-double">
            Total
          </th>
          <th class="border border-black border-double">
            {{ stats.ratings.total.clients }}
          </th>
          <th
            class="border border-black border-double"
            colspan="5"
          />
          <th class="border border-black border-double">
            {{ stats.ratings.total.goodPercent }}
          </th>
        </tr>
      </tfoot>
    </table>

    <div
      v-for="(comment,i) in stats.comments"
      :key="i"
    >
      <h3>{{ Object.keys(comment)[i].charAt(0).toUpperCase() + Object.keys(comment)[i].slice(1) }} Comments/Suggestions</h3>
      <ul
        v-for="(service,x) in comment.positive.services"
        :key="x"
      >
        <li>{{ service.service }}</li>
        <ul
          v-for="(asd,y) in service.comments"
          :key="y"
        >
          <li>{{ asd }}</li>
        </ul>
      </ul>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "~/Layouts/AppLayout";
import SelectInput from "~/Shared/SelectInput";
import DateInput from "~/Shared/DateInput";
import mapValues from "lodash/mapValues";

export default {
  props: {
    offices: { type: Array, default: () => {} },
    filters: { type: [Object, Array], default: () => {} },
    stats: { type: [Object, Array], default: () => {} },
  },
  components: {
    AppLayout,
    SelectInput,
    DateInput,
  },
  data() {
    return {
      filterForm: {
        office: this.filters.office,
        month: this.filters.month,
      },
    };
  },
  watch: {},
  methods: {
    submit() {
      // console.log(this.filterForm);
      this.$inertia.replace(this.route("reports.index"), {
        data: this.filterForm,
      });
    },
    reset() {
      this.filterForm = mapValues(this.filterForm, () => null);
      this.submit();
    },
  },
};
</script>
