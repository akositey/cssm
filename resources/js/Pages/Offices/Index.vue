<template>
  <app-layout>
    <template #header>
      Offices
    </template>

    <div class="flex justify-between">
      <SearchFilter
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
      </SearchFilter>

      <Link
        class="btn-indigo"
        :href="route('offices.create')"
      >
        <span>Create</span>
        <span class="hidden md:inline"> Office</span>
      </Link>
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
          <Link
            v-if="row.parent_id"
            :href="route('offices.edit', row.parent_id)"
          >
            {{ row.parent_office }}
          </Link>
        </td>
        <td class="p-3">
          <Link
            class="focus:text-indigo-500"
            :href="route('offices.edit', row.id)"
            tabindex="-1"
          >
            <Icon
              name="chevron-right"
              class="w-6 h-6 m-auto fill-gray-400"
            />
          </Link>
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
    <Pagination :links="offices.links" />
  </app-layout>
</template>

<script>
import AppLayout from './../../Layouts/AppLayout'
import Icon from './../../Shared/Icon'
import Pagination from './../../Shared/Pagination'
import SearchFilter from './../../Shared/SearchFilter'
import mapValues from 'lodash/mapValues'
import throttle from 'lodash/throttle'
import {Link} from '@inertiajs/inertia-vue3'

export default {
  components: {
    AppLayout,
    Icon,
    Pagination,
    SearchFilter,
    Link,
  },
  props: {
    offices: { type: Object, default: () => [] },
    filters: { type: [Object, Array], default: () => {} },
  },
  data() {
    return {
      filterForm: {
        search: this.filters.search,
        trashed: this.filters.trashed,
      },
    }
  },
  watch: {
    filterForm: {
      handler: throttle(function () {
        this.$inertia.replace(this.route('offices.index', this.filterForm))
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
