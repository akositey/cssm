<template>
  <thead class="bg-gray-200 border border-black">
    <tr class="border">
      <th
        class="w-1/6 p-2 border border-black"
        rowspan="3"
      >
        Service
      </th>
      <th
        class="w-2/5 p-2 border border-black"
        rowspan="3"
      >
        Question
      </th>
      <th
        class="w-1/6 p-2 text-sm whitespace-normal border border-black"
        rowspan="3"
      >
        Clients Served
      </th>
      <th
        class="w-1/5 p-2 border border-black"
        colspan="5"
      >
        Quality of Service
      </th>
      <th
        class="w-1/5 p-2 border border-black"
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
</template>
