<template>
  <div class="w-10/12">
    <div class="table w-full text-xl table-fixed md:px-6 md:text-3xl">
      <div
        v-for="(question,i) in questions"
        :key="question.id"
        class="border-b-2"
        :class="{'bg-gray-200':i%2===0}"
      >
        <label class="flex w-full cursor-pointer select-none">
          <div class="self-center text-lg md:text-4xl">
            <input
              v-model="answers"
              name="check"
              class="ml-2 p-curve p-thick p-smooth p-svg"
              :disabled="answers.length >= maxChecked && answers.indexOf(question.id) === -1"
              :class="{'bg-grey-200':answers.length >= maxChecked && answers.indexOf(question.id) === -1}"
            />
          </div>
          <div class="p-1 md:p-2 flex-grow-1">
            <p>{{ question.question }}</p>
          </div>
        </label>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  components: {
  },
  props: {
    questions: { type: Array, default: () => {} },
    questionNumber: { type: [Number, Boolean], default: null },
    questionType: { type: String, default: '' },
    maxChecked: { type: [Number, Boolean], default: null },
  },
  data() {
    return {
      answers: [],
    }
  },
  watch: {
    answers() {
      this.$emit(
        'answers-optional',
        this.questionNumber,
        this.questionType,
        this.answers,
      )
    },
  },
  mounted() {
    // console.log("questions", this.questions);
  },
  methods: {
  },
}
</script>
