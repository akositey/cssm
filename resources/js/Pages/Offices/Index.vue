<template>
  <app-layout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Offices
      </h2>
    </template>
    
    <div class="py-12">
      <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
          <flash-messages />

          <div class="flex justify-between m-6">
            <search-filter v-model="filterForm.search" class="w-full max-w-md mr-4" @reset="reset">
              <label class="block text-gray-700">Trashed:</label>
              <select v-model="filterForm.trashed" class="w-full mt-1 form-select">
                <option :value="null" />
                <option value="with">
                  With Trashed
                </option>
                <option value="only">
                  Only Trashed
                </option>
              </select>
            </search-filter>
            
            <inertia-link class="btn-indigo" :href="route('offices.create')">
              <span>Create</span>
              <span class="hidden md:inline">Office</span>
            </inertia-link>
          </div>
          <table class="w-full whitespace-no-wrap">
            <tr class="font-bold text-left">
              <th class="p-4 text-center">
                Name
              </th>
              <th class="p-4 text-center">
                Abbr.
              </th>
              <th class="p-4 text-center">
                Action
              </th>
            </tr>
            <tr v-for="office in offices.data" :key="office.id" class="border-t hover:bg-gray-100 focus-within:bg-gray-100">
              <td class="p-3">
                {{ office.name }}
              </td>
              <td class="p-3">
                {{ office.nick }}
              </td>
              <td class="p-3">
                <inertia-link class="focus:text-indigo-500" :href="route('offices.edit', office.id)">
                  <icon name="cheveron-right" class="w-6 h-6 m-auto fill-gray-400" />
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
        </div>
        <pagination :links="offices.links" />
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "./../../Layouts/AppLayout";
import Icon from './../../Shared/Icon';
import Pagination from './../../Shared/Pagination';
import FlashMessages from './../../Shared/FlashMessages';
import SearchFilter from './../../Shared/SearchFilter';
import mapValues from 'lodash/mapValues';
import pickBy from 'lodash/pickBy';
import throttle from 'lodash/throttle';

export default {
  props: {
    offices: { type: Object, default: ()=>{} },
    filters: { type: Object, default: ()=>{} },
  },
  components: {
    AppLayout,
    Icon,
    Pagination,
    FlashMessages,
    SearchFilter,
  },
  data() {
    return {
      filterForm: {
        text: this.filters.search,
        trashed: this.filters.trashed,
      }
    }
  },
  watch: {
    filterForm: {
      handler: throttle(function () {
        const query = pickBy(this.filterForm);
        this.$inertia.replace(
          this.route(
            'offices.index',
            Object.keys(query).length ? query : { remember: 'forget' }
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
