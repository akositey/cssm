<template>
  <div class="w-10/12">
    <div class="table w-full text-xl table-fixed md:px-6 md:text-3xl">
      <div
        class="tr"
        v-for="(question,i) in questions"
        :key="question.id"
      >
        <label class="flex w-full">
          <div class="justify-start flex-initial p-1 pr-2 md:p-2 td md:pr-6">
            <input
              type="checkbox"
              :ref="`positive${i+1}`"
              :id="`positive${i+1}`"
              :value="question.id"
              v-model="answers"
              :disabled="answers.length >= maxChecked && answers.indexOf(question.id) == -1"
              class="md:zoom-20 zoom-15"
            >
          </div>
          <div class="p-1 md:p-2 flex-grow-1 td">
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
    // Comment,
  },
  props: {
    questions: { type: Array, default: () => {} },
    questionNumber: { type: [Number, Boolean], default: null },
    questionType: { type: String, default: "" },
    maxChecked: { type: [Number, Boolean], default: null },
  },
  data() {
    return {
      answers: [],
    };
  },
  mounted() {
    // console.log("questions", this.questions);
  },
  watch: {
    answers() {
      this.$emit(
        "answers-optional",
        this.questionNumber,
        this.questionType,
        this.answers
      );
    },
  },
  methods: {
    triggerClick(elName) {
      console.log(this.$refs[elName]);
      this.$refs[elName].click();
    },
  },
};
</script>
