<template>
  <table class="w-full my-4 whitespace-no-wrap bg-white border border-black">
    <thead class="bg-gray-200 border border-black">
      <tr class="border">
        <th
          class="p-2 border border-black"
          rowspan="3"
        >
          Service
        </th>
        <th
          class="p-2 border border-black"
          rowspan="3"
        >
          Question
        </th>
        <th
          class="w-0 p-2 text-sm whitespace-normal border border-black"
          rowspan="3"
        >
          Clients Served
        </th>
        <th
          class="p-2 border border-black"
          colspan="5"
        >
          Quality in Service
        </th>
        <th
          class="p-2 border border-black"
          rowspan="3"
        >
          % in VS &amp; O
        </th>
      </tr>
      <tr class="border">
        <th
          class="border border-black"
          v-for="num in 5"
          :key="num"
          width="30"
        >
          {{ num }}
        </th>
      </tr>
      <tr class="border">
        <th
          class="border border-black"
          v-for="letter in ['P','F','S','VS','O']"
          :key="letter"
          width="30"
        >
          {{ letter }}
        </th>
      </tr>
    </thead>
    <tbody
      v-for="x in rows"
      :key="Math.random()+'rows'+x"
    >
      <tr>
        <td
          class="w-2/12 p-2"
          rowspan="3"
        >
          <div class="h-6 bg-gray-300 rounded animate-pulse" />
        </td>
        <td class="w-5/12 p-2">
          <div class="w-6/12 h-6 bg-gray-300 rounded animate-pulse" />
        </td>
        <td
          class="w-2/12 p-2"
          rowspan="3"
        >
          <div class="w-6/12 h-6 m-auto bg-gray-300 rounded animate-pulse" />
        </td>
        <td
          class="p-2 "
          v-for="x in 5"
          :key="'dummy'+x"
        >
          <div class="h-6 bg-gray-300 rounded animate-pulse" />
        </td>
        <td
          class="w-2/12 p-2"
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
          v-for="x in 5"
          :key="'dummy2'+x"
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
          v-for="x in 5"
          :key="'dummy2'+x"
        >
          <div class="h-6 bg-gray-300 rounded animate-pulse" />
        </td>
      </tr>
    </tbody>
  </table>
</template>
<script>
export default {
  props: {
    rows: {
      type: Number,
      default: 1
    }
  }
}
</script>
