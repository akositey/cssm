<template>
  <app-layout>
    <template #header>
      Feedback
    </template>

    <div class="flex justify-between">
      <form @submit.prevent="submit">
        <div class="grid grid-cols-4">
          <select-input
            v-model="filterForm.office"
            class="pr-6"
            label="Office"
          >
            <option :value="null">
              All
            </option>
            <option v-for="(office,i) of offices" :key="i" :value="office.id">
              {{ office.abbr }}
            </option>
          </select-input>
          <select-input
            v-model="filterForm.service"
            class="pr-6"
            label="Service"
          >
            <option :value="null">
              All
            </option>
            <option v-for="(service,i) of officeServices" :key="i" :value="service.id">
              {{ service.name }}
            </option>
          </select-input>
          <date-input type="month" format="YYYY-MM" v-model="filterForm.month" class="pr-6" label="Month" />
          <div class="flex items-end">
            <button type="submit" class="btn-indigo">
              Filter
            </button>
          </div>
        </div>
      </form>
    </div>

    <table class="w-full my-4 whitespace-no-wrap bg-white">
      <tr class="font-bold text-left">
        <th class="p-4 text-center">
          #
        </th>
        <th class="p-4 text-center">
          Office
        </th>
        <th class="p-4 text-center">
          Service
        </th>
        <th class="p-4 text-center">
          Author
        </th>
        <th class="p-4 text-center">
          Date
        </th>
        <th class="p-4 text-center">
          Action
        </th>
      </tr>
      <tr
        v-for="(row,i) of feedback.data"
        :key="row.id"
        class="border-t hover:bg-gray-100 focus-within:bg-gray-100"
      >
        <td class="p-3">
          {{ feedback.from + i }}
        </td>
        <td class="p-3">
          {{ row.officeName }}
        </td>
        <td class="p-3">
          <p class="max-w-xs truncate">
            {{ row.serviceName }}
          </p>
        </td>
        <td class="p-3">
          {{ row.authorName }}
        </td>
        <td class="p-3">
          {{ row.date }}
        </td>
        <td class="p-3">
          <inertia-link
            class="focus:text-indigo-500"
            :href="route('feedback.show', row.id)"
            tabindex="-1"
          >
            <icon
              name="cheveron-right"
              class="w-6 h-6 m-auto fill-gray-400"
            />
          </inertia-link>
        </td>
      </tr>
      <tr v-if="feedback.data.length === 0">
        <td
          class="px-6 py-4 border-t"
          colspan="6"
        >
          No Feedback found.
        </td>
      </tr>
    </table>
    <pagination :links="feedback.links" />
  </app-layout>
</template>

<script>
import AppLayout from "./../../Layouts/AppLayout";
import Icon from "./../../Shared/Icon";
import Pagination from "./../../Shared/Pagination";
import SelectInput from "./../../Shared/SelectInput";
import DateInput from "./../../Shared/DateInput";
import mapValues from "lodash/mapValues";

export default {
  props: {
    feedback: { type: Object, default: () => {} },
    offices: { type: Array, default: () => {} },
    services: { type: Array, default: () => {} },
    filters: { type: Object, default: () => {} },
  },
  components: {
    AppLayout,
    Icon,
    Pagination,
    SelectInput,
    DateInput,
  },
  data() {
    return {
      filterForm: {
        office: this.filters.office,
        service: this.filters.service,
        month: this.filters.month,
      },
    };
  },
  watch: {
    
  },
  computed: {
    officeServices(){
      return this.services.filter(service => service.officeId == this.filterForm.office)
    }
  },
  methods: {
    submit(){
      this.$inertia.replace(this.route('feedback.index'), this.filterForm);
    },
    reset() {
      this.filterForm = mapValues(this.filterForm, () => null);
    },
  },
};
</script>
