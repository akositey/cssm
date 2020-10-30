<template>
  <app-layout>
    <template #header>
      <inertia-link
        class="text-indigo-400 hover:text-indigo-600"
        :href="route('feedback.index')"
      >
        Feedback
      </inertia-link>
      <span class="font-medium">/</span>
      {{ feedback.id }} - {{ office }}
    </template>

    <div class="py-4">
      <div class="w-full m-auto overflow-hidden bg-white rounded shadow-xl">
        <div class="p-4">
          <p>Date Submitted: {{ creationDate }}</p>
        </div>
        <table class="w-full my-4 whitespace-no-wrap bg-white">
          <tr class="font-bold text-left">
            <th class="p-4 text-center">
              Type
            </th>
            <th class="p-4 text-center">
              Question
            </th>
            <th class="p-4 text-center">
              Rating
            </th>
          </tr>
          <tr class="border-t hover:bg-gray-100 focus-within:bg-gray-100" v-for="(answer,i) in answers" :key="i">
            <td class="p-3">
              {{ answer.typeWords }}
            </td>
            <td class="p-3">
              {{ answer.question }}
            </td>
            <td class="p-3">
              <div v-if="answer.type === 0">
                {{/* mandatory */}}
                <span v-for="n in +answer.answer" :key="n" class="px-1">⭐</span>
              </div>
              <div v-else-if="answer.type === 1">
                {{/* positive */}}
                👍
              </div>
              <div v-else-if="answer.type === 2">
                {{/* negative */}}
                👎🏾
              </div>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from '~/Layouts/AppLayout';
export default {
  components: {
    AppLayout
  },
  props: {
    feedback: {
      type: Object,
      default: () => {}
    },
    office: {
      type: String,
      default: ""
    },
    creationDate: {
      type: String,
      default: ""
    },
    answers: {
      type: Array,
      default: () => {}
    }
  }
}
</script>
