<template>
  <div>
    <div class="table w-full text-xl md:text-4xl">
      <div
        class="tr"
        v-for="(question,i) in questions"
        :key="question.id"
      >
        <div class="justify-center w-1/6 td">
          <input
            type="checkbox"
            :id="`positive${i+1}`"
            :value="i+1"
            v-model="answers"
            :disabled="answers.length >= maxChecked && answers.indexOf(i+1) == -1"
            class="md:zoom-20 zoom-15"
          >
        </div>
        <div class="w-5/6 td">
          {{ question.question }}
        </div>
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
};
</script>
