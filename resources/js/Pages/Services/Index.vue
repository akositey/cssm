<template>
  <app-layout>
    <template #header>
      Services
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
        :href="route('services.create')"
      >
        <span>Create</span>
        <span class="hidden md:inline">Service</span>
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
          Office
        </th>
        <th class="p-4 text-center">
          Active
        </th>
        <th class="p-4 text-center">
          Action
        </th>
      </tr>
      <tr
        v-for="(row,i) in services.data"
        :key="row.id"
        class="border-t hover:bg-gray-100 focus-within:bg-gray-100"
      >
        <td class="p-3">
          {{ services.from+i }}
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
          {{ row.office }}
        </td>
        <td
          class="p-3"
          :class="{ 'text-red-700':!row.is_active}"
        >
          {{ row.is_active ? "Yes": "No" }}
        </td>
        <td class="p-3">
          <inertia-link
            class="focus:text-indigo-500"
            :href="route('services.edit', row.id)"
            tabindex="-1"
          >
            <icon
              name="chevron-right"
              class="w-6 h-6 m-auto fill-gray-400"
            />
          </inertia-link>
        </td>
      </tr>
      <tr v-if="services.data.length === 0">
        <td
          class="px-6 py-4 border-t"
          colspan="4"
        >
          No Services found.
        </td>
      </tr>
    </table>
    <pagination :links="services.links" />
  </app-layout>
</template>

<script>
import AppLayout from './../../Layouts/AppLayout'
import Icon from './../../Shared/Icon'
import Pagination from './../../Shared/Pagination'
import SearchFilter from './../../Shared/SearchFilter'
import mapValues from 'lodash/mapValues'
import pickBy from 'lodash/pickBy'
import throttle from 'lodash/throttle'

export default {
  components: {
    AppLayout,
    Icon,
    Pagination,
    SearchFilter,
  },
  props: {
    services: { type: Object, default: () => {} },
    filters: { type: [Object, Array], default: () => {} },
  },
  data() {
    return {
      filterForm: {
        text: this.filters.search,
        trashed: this.filters.trashed,
      },
    }
  },
  watch: {
    filterForm: {
      handler: throttle(function () {
        const query = pickBy(this.filterForm)
        this.$inertia.replace(
          this.route(
            'services.index',
            Object.keys(query).length ? query : { remember: 'forget' },
          ),
        )
      }, 150),
      deep: true,
    },
  },
  methods: {
    reset() {
      this.filterForm = mapValues(this.filterForm, () => null)
    },
  },
}
</script>
