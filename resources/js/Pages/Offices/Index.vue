<template>
  <app-layout>
    <template #header>
      Offices
    </template>

    <div class="flex justify-between">
      <search-filter
        v-model="filterForm.search"
        class="w-full max-w-md mr-4"
        @reset="reset"
      >
        <label class="block text-gray-700">Trashed:</label>
        <select
          v-model="filterForm.trashed"
          class="w-full mt-1 form-select"
        >
          <option :value="null" />
          <option value="with">
            With Trashed
          </option>
          <option value="only">
            Only Trashed
          </option>
        </select>
      </search-filter>

      <inertia-link
        class="btn-indigo"
        :href="route('offices.create')"
      >
        <span>Create</span>
        <span class="hidden md:inline">Office</span>
      </inertia-link>
    </div>

    <table class="w-full my-4 whitespace-no-wrap bg-white">
      <tr class="font-bold text-left">
        <th class="p-4 text-center">
          #
        </th>
        <th class="p-4 text-center">
          Name
        </th>
        <th class="p-4 text-center">
          Abbr.
        </th>
        <th class="p-4 text-center">
          Parent Office
        </th>
        <th class="p-4 text-center">
          Action
        </th>
      </tr>
      <tr
        v-for="(row,i) of offices.data"
        :key="row.id"
        class="border-t hover:bg-gray-100 focus-within:bg-gray-100"
      >
        <td class="p-3">
          {{ offices.from + i }}
        </td>
        <td class="p-3">
          {{ row.name }}
          <icon
            v-if="row.deleted_at"
            name="trash"
            class="inline w-3 h-3 ml-2 fill-red-400"
          />
        </td>
        <td class="p-3">
          {{ row.abbr }}
        </td>
        <td class="p-3">
          <inertia-link
            v-if="row.parent_id"
            :href="route('offices.edit', row.parent_id)"
          >
            {{ row.parent_office }}
          </inertia-link>
        </td>
        <td class="p-3">
          <inertia-link
            class="focus:text-indigo-500"
            :href="route('offices.edit', row.id)"
            tabindex="-1"
          >
            <icon
              name="cheveron-right"
              class="w-6 h-6 m-auto fill-gray-400"
            />
          </inertia-link>
        </td>
      </tr>
      <tr v-if="offices.data.length === 0">
        <td
          class="px-6 py-4 border-t"
          colspan="4"
        >
          No Offices found.
        </td>
      </tr>
    </table>
    <pagination :links="offices.links" />
  </app-layout>
</template>

<script>
import AppLayout from "./../../Layouts/AppLayout";
import Icon from "./../../Shared/Icon";
import Pagination from "./../../Shared/Pagination";
import SearchFilter from "./../../Shared/SearchFilter";
import mapValues from "lodash/mapValues";
import pickBy from "lodash/pickBy";
import throttle from "lodash/throttle";

export default {
  props: {
    offices: { type: Object, default: () => [] },
    filters: { type: Object, default: () => {} },
  },
  components: {
    AppLayout,
    Icon,
    Pagination,
    SearchFilter,
  },
  data() {
    return {
      filterForm: {
        search: this.filters.search,
        trashed: this.filters.trashed,
      },
    };
  },
  watch: {
    filterForm: {
      handler: throttle(function () {
        const query = pickBy(this.filterForm);
        this.$inertia.replace(
          this.route(
            "offices.index",
            Object.keys(query).length ? query : { remember: "forget" }
          )
        );
      }, 150),
      deep: true,
    },
  },
  methods: {
    reset() {
      this.filterForm = mapValues(this.filterForm, () => null);
    },
  },
};
</script>
