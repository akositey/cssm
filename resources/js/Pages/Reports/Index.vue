<template>
  <app-layout>
    <template #header>
      <div class="flex justify-between">
        Reports
      </div>
    </template>

    <div class="flex justify-between">
      <form @submit.prevent="viewReport">
        <div class="grid grid-cols-5">
          <select-input
            v-model="filterForm.office"
            class="pr-6"
            label="Office"
          >
            <option
              :value="null"
              disabled
            >
              -- SELECT OFFICE --
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
            v-model="filterForm.month_from"
            type="month"
            format="YYYY-MM"
            class="pr-6"
            label="From (month)"
          />
          <date-input
            v-model="filterForm.month_to"
            type="month"
            format="YYYY-MM"
            class="pr-6"
            label="To (month)"
          />
          <div class="flex items-end">
            <loading-button
              :loading="sending"
              class="btn-green"
              type="submit"
            >
              View Report
            </loading-button>
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

    <dummy-table
      v-if="sending"
      :rows="5"
    />

    <div v-if="!sending && stats.services">
      <table class="w-full my-4 whitespace-no-wrap bg-white border border-black">
        <table-head />
        <tbody
          v-for="(service,i) in stats.services"
          :key="i"
          class="border border-black"
        >
          <tr
            v-for="(question,x) in service.questions"
            :key="x"
          >
            <td
              v-if="x===0"
              class="px-2 font-bold whitespace-normal align-top border-b-0 border-r border-black"
              rowspan="3"
            >
              {{ service.name }}
            </td>
            <td class="px-2 border border-b-0 border-l-0">
              {{ question.question }}
            </td>
            <td
              v-if="x===0"
              class="text-center border border-b-0"
              rowspan="3"
            >
              {{ service.clients }}
            </td>
            <td
              v-for="(rating,y) in question.ratings"
              :key="y"
              class="text-center border border-b-0"
            >
              {{ rating }}
            </td>
            <td
              v-if="x===0"
              class="text-center border border-b-0 border-black"
              rowspan="3"
            >
              {{ service.goodRatingPercentage }}
            </td>
          </tr>
          <tr>
            <td class="border-r border-black" />
            <td class="text-center bg-yellow-300 border border-l-0 border-black ">
              % in Total Rating
            </td>
            <td class="bg-yellow-300 border border-black" />
            <td
              v-for="(average,x) in service.totalRatingPercentages"
              :key="'avg'+x"
              class="text-center bg-yellow-300 border border-black"
            >
              {{ average }}
            </td>
            <td class="bg-yellow-300 border border-black" />
          </tr>
          <tr>
            <td class="border-r border-black" />
            <td
              colspan="9"
              class="h-2 border-l-0"
            />
          </tr>
          <tr>
            <td class="border-r border-black" />
            <td
              colspan="9"
              class="p-2 font-bold text-center bg-gray-200 border border-black"
            >
              Comments/Suggestions
            </td>
          </tr>
          <tr>
            <td class="border-r border-black" />
            <td class="font-bold text-center bg-gray-200 border border-black">
              Positive
            </td>
            <td
              class="font-bold text-center bg-gray-200 border border-black"
              colspan="7"
            >
              Negative
            </td>
          </tr>
          <tr
            v-for="(rows,y) in service.comments.maxRows"
            :key="'rows'+y"
            class=""
          >
            <td class="border-r border-black" />
            <td class="border border-l-0">
              <p
                v-if="y in service.comments.positive"
                class="px-2 "
              >
                {{ service.comments.positive[y].comment }}
                <inertia-link
                  class="float-right text-sm text-gray-700 focus:text-indigo-500"
                  :href="route('comments.edit', service.comments.positive[y].id)"
                  tabindex="-1"
                >
                  <icon
                    name="pencil"
                    class="w-4 h-4 fill-white"
                  />
                </inertia-link>
              </p>
            </td>
            <td
              colspan="7"
              class="border-r border-black"
            >
              <p
                v-if="y in service.comments.negative"
                class="px-2 text-red-700"
              >
                {{ service.comments.negative[y].comment }}

                <inertia-link
                  class="float-right text-sm text-gray-700 focus:text-indigo-500"
                  :href="route('comments.edit', service.comments.negative[y].id)"
                  tabindex="-1"
                >
                  <icon
                    name="pencil"
                    class="w-4 h-4 fill-white"
                  />
                </inertia-link>
              </p>
            </td>
          </tr>
          <tr
            v-for="(ignored,y) in service.comments.ignored.length"
            :key="'ignored'+y"
            class="border-r border-black"
          >
            <td class="border-r border-black" />
            <td
              colspan="8"
              class="px-2 text-center border-r border-black"
            >
              <span class="text-blue-700">
                {{ service.comments.ignored[y].comment }}
              </span>
              <inertia-link
                class="float-right text-sm text-gray-700 focus:text-indigo-500"
                :href="route('comments.edit', service.comments.ignored[y].id)"
                tabindex="-1"
              >
                <icon
                  name="pencil"
                  class="w-4 h-4 fill-white"
                />
              </inertia-link>
            </td>
          </tr>
          <tr
            v-for="(untranscribed,y) in service.comments.untranscribed.length"
            :key="'untranscribed'+y"
            class="border-r border-black"
          >
            <td class="border-r border-black" />
            <td
              colspan="8"
              class="px-2 text-center border-r border-black"
            >
              <span class="text-orange-700">
                {{ service.comments.untranscribed[y].comment }}
              </span>
              <inertia-link
                class="float-right text-sm text-gray-700 focus:text-indigo-500"
                :href="route('comments.edit', service.comments.untranscribed[y].id)"
                tabindex="-1"
              >
                <icon
                  name="pencil"
                  class="w-4 h-4 fill-white"
                />
              </inertia-link>
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
          v-if="stats.total && !sending"
          class="border border-black"
        >
          <tr class="bg-orange-400">
            <th class="border border-black" />
            <th class="border border-black">
              Total
            </th>
            <th class="border border-black">
              {{ stats.total.clients }}
            </th>
            <th
              class="border border-black"
              colspan="5"
            />
            <th class="border border-black">
              {{ stats.total.goodRatingPercentage }}
            </th>
          </tr>
        </tfoot>
      </table>
      <div
        v-if="stats.services"
        class="flex justify-end"
      >
        <form
          :action="route('reports.print')"
          method="post"
          target="_blank"
        >
          <input
            id="_token"
            type="hidden"
            name="_token"
            :value="csrf_token"
          />
          <input
            id="office"
            type="hidden"
            name="office"
            :value="filters.office"
          />
          <input
            id="month_from"
            type="hidden"
            name="month_from"
            :value="filters.month_from"
          />
          <input
            id="month_to"
            type="hidden"
            name="month_to"
            :value="filters.month_to"
          />
          <button
            type="submit"
            class="btn-indigo"
          >
            <icon
              name="printer"
              class="inline w-4 h-4 fill-white"
            />
            Print
          </button>
        </form>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import SelectInput from '@/Shared/SelectInput'
import DateInput from '@/Shared/DateInput'
import Icon from '@/Shared/Icon'
import LoadingButton from '@/Shared/LoadingButton'
import TableHead from './TableHead'
import DummyTable from './DummyTable'
import mapValues from 'lodash/mapValues'

export default {
  components: {
    AppLayout,
    SelectInput,
    DateInput,
    LoadingButton,
    TableHead,
    DummyTable,
    Icon,
  },
  props: {
    offices: { type: Array, default: () => {} },
    filters: { type: [Object, Array], default: () => {} },
    stats: { type: [Object, Array], default: () => {} },
  },
  data() {
    return {
      filterForm: {
        office: this.filters.office,
        month_from: this.filters.month_from,
        month_to: this.filters.month_to,
      },
      sending: false,
      csrf_token: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute('content'),
    }
  },
  computed: {},
  watch: {},
  methods: {
    viewReport() {
      (this.sending = true),
      this.$inertia.visit(this.route('reports.index'), {
        data: this.filterForm,
        replace: true,
        onFinish: () => {
          this.sending = false
        },
      })
    },
    reset() {
      this.filterForm = mapValues(this.filterForm, () => null)
      this.viewReport()
    },
  },
}
</script>
