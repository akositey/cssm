<template>
  <app-layout>
    <template #header>
      <div class="flex justify-between">
        Feedback
        <div>
          <input
            type="file"
            ref="toUpload"
            accept=".zip"
            class="hidden btn-indigo"
            @change="upload"
          >
          <button
            class="btn-indigo"
            @click="chooseFile"
          >
            Import
          </button>
        </div>
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
              v-for="(office,i) of offices"
              :key="i"
              :value="office.id"
            >
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
            <option
              v-for="(service,i) of officeServices"
              :key="i"
              :value="service.id"
            >
              {{ service.name }}
            </option>
          </select-input>
          <date-input
            type="month"
            format="YYYY-MM"
            v-model="filterForm.month"
            class="pr-6"
            label="Month"
          />
          <select-input
            v-model="filterForm.hasComments"
            class="pr-6"
            label="Comments"
          >
            <option :value="null">
              All
            </option>
            <option
              key="true"
              value="with"
            >
              Has Comments/Suggestions
            </option>
            <option
              key="false"
              value="without"
            >
              No Comments/Suggestions
            </option>
          </select-input>
          <div class="flex items-end">
            <button
              type="submit"
              class="btn-green"
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
          Comments
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
          <p class="max-w-xs truncate">
            {{ row.officeName }}
          </p>
        </td>
        <td class="p-3">
          <p class="max-w-xs truncate">
            {{ row.serviceName }}
          </p>
        </td>
        <td class="p-3 green">
          <span
            v-if="(row.commentsImgPath && (!row.positiveComments || !row.negativeComments))"
            class="text-orange-500"
          >untranscribed</span>
          <span
            v-if="(row.commentsImgPath && (row.positiveComments || row.negativeComments))"
            class="text-green-500"
          >transcribed</span>
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
    filters: { type: [Object, Array], default: () => {} },
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
        hasComments: this.filters.hasComments,
      },
    };
  },
  watch: {},
  computed: {
    officeServices() {
      return this.services.filter(
        (service) => service.officeId == this.filterForm.office
      );
    },
  },
  methods: {
    submit() {
      // console.log(this.filterForm);
      this.$inertia.replace(this.route("feedback.index"), {
        data: this.filterForm,
      });
    },
    reset() {
      this.filterForm = mapValues(this.filterForm, () => null);
      this.submit();
    },
    chooseFile() {
      this.$refs.toUpload.click();
    },
    upload() {
      let form = new FormData();
      form.append("file", this.$refs.toUpload.files[0]);
      this.$inertia.post(this.route("import"), form);
    },
  },
};
</script>
