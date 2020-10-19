<template>
  <div>
    <div class="table w-full text-xl md:text-4xl">
      <div
        class="tr"
        v-for="(question,i) in questions"
        :key="question.id"
      >
        <div class="justify-center flex-none p-2 td md:p-3">
          <input
            type="checkbox"
            :id="`positive${i+1}`"
            :value="i+1"
            v-model="answers"
            :disabled="answers.length >= maxChecked && answers.indexOf(i+1) == -1"
            class="md:zoom-20 zoom-15"
          >
        </div>
        <div class="p-2 flex-grow-1 td md:p-3 md:pl-6">
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
