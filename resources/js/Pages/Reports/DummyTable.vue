<template>
  <table class="w-full my-4 whitespace-no-wrap bg-white border border-black">
    <table-head />
    <tbody
      v-for="x in rows"
      :key="Math.random()+'rows'+x"
      class="border border-black"
    >
      <tr>
        <td
          class="px-2 py-1 align-top border border-black"
          rowspan="6"
        >
          <div
            class="h-5 bg-gray-300 rounded animate-pulse"
            :class="randomWidthClass()"
          />
        </td>
        <td class="w-5/12 px-2 py-1 border border-t-0">
          <div class="w-7/12 h-5 bg-gray-300 rounded animate-pulse" />
        </td>
        <td
          class="px-2 py-1 border border-b border-r-0 border-black"
          rowspan="3"
        >
          <div class="w-1/4 h-5 m-auto bg-gray-300 rounded animate-pulse" />
        </td>
        <td
          class="px-2 py-1 border "
          v-for="y in 5"
          :key="'dummy'+y+Math.random()"
        >
          <div class="h-5 bg-gray-300 rounded animate-pulse" />
        </td>
        <td
          class="px-2 py-1 border border-black"
          rowspan="3"
        >
          <div class="w-1/2 h-5 m-auto bg-gray-300 rounded animate-pulse" />
        </td>
      </tr>
      <tr>
        <td class="px-2 py-1 border">
          <div class="w-3/4 h-5 bg-gray-300 rounded animate-pulse" />
        </td>
        <td
          class="px-2 py-1 border"
          v-for="y in 5"
          :key="'dummy2'+y+Math.random()"
        >
          <div class="h-5 bg-gray-300 rounded animate-pulse" />
        </td>
      </tr>
      <tr>
        <td class="px-2 py-1 border border-l-0 border-r-0 border-black">
          <div class="w-11/12 h-5 bg-gray-300 rounded animate-pulse" />
        </td>
        <td
          class="px-2 py-1 border border-l-0 border-r-0 border-black"
          v-for="y in 5"
          :key="'dummy2'+y+Math.random()"
        >
          <div class="h-5 bg-gray-300 rounded animate-pulse" />
        </td>
      </tr>
      <tr>
        <td
          class="px-2 py-1 border border-black"
          colspan="9"
        >
          <div class="w-full h-5 bg-yellow-300 rounded animate-pulse" />
        </td>
      </tr>
      <tr>
        <td
          class="px-2 py-1 border border-black"
          colspan="9"
        >
          <div class="w-full h-8 bg-gray-300 rounded animate-pulse" />
        </td>
      </tr>
      <tr>
        <td class="px-2 py-1">
          <div class="w-full h-5 bg-gray-300 rounded animate-pulse" />
        </td>
        <td
          class="px-2 py-1 border border-black"
          colspan="7"
        >
          <div class="w-full h-5 bg-gray-300 rounded animate-pulse" />
        </td>
      </tr>
    </tbody>
  </table>
</template>
<script>
import TableHead from './TableHead';
export default {
  components:{
    TableHead
  },
  props: {
    rows: {
      type: Number,
      default: 1
    }
  },
  methods: {
    randomWidthClass(){
      return 'w-'+(Math.floor(Math.random() * (12 - 3 + 1)) + 3)+'/12';
    }
  },
}
</script>
