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
          class="p-2"
          rowspan="3"
        >
          <div class="h-6 bg-gray-300 rounded animate-pulse" />
        </td>
        <td class="w-5/12 p-2">
          <div class="w-6/12 h-6 bg-gray-300 rounded animate-pulse" />
        </td>
        <td
          class="p-2"
          rowspan="3"
        >
          <div class="w-6/12 h-6 m-auto bg-gray-300 rounded animate-pulse" />
        </td>
        <td
          class="p-2 "
          v-for="y in 5"
          :key="'dummy'+y+Math.random()"
        >
          <div class="h-6 bg-gray-300 rounded animate-pulse" />
        </td>
        <td
          class="p-2"
          rowspan="3"
        >
          <div class="h-6 m-auto bg-gray-300 rounded animate-pulse" />
        </td>
      </tr>
      <tr>
        <td class="p-2">
          <div class="w-8/12 h-6 bg-gray-300 rounded animate-pulse" />
        </td>
        <td
          class="p-2 "
          v-for="y in 5"
          :key="'dummy2'+y+Math.random()"
        >
          <div class="h-6 bg-gray-300 rounded animate-pulse" />
        </td>
      </tr>
      <tr>
        <td class="p-2">
          <div class="h-6 bg-gray-300 rounded animate-pulse w-12/12" />
        </td>
        <td
          class="p-2 "
          v-for="y in 5"
          :key="'dummy2'+y+Math.random()"
        >
          <div class="h-6 bg-gray-300 rounded animate-pulse" />
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
  }
}
</script>
