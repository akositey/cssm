<template>
  <div class="flex flex-no-wrap px-2 py-20 md:py-40">
    <label
      v-for="(choice, i) in choices"
      :key="i"
      :for="`option-${questionNumber}-${i+1}`"
      class="flex-grow w-20 h-20"
    >
      <input
        type="radio"
        name="option"
        :id="`option-${questionNumber}-${i+1}`"
        :value="i+1"
        class="hidden"
        v-model="answer"
      >
      <emoji-icon
        :name="choice"
        class="w-24 cursor-pointer md:w-64"
      />
    </label>
  </div>
</template>

<script>
import EmojiIcon from "~/Shared/EmojiIcon.vue";

export default {
  components: {
    EmojiIcon,
  },
  props: {
    questionNumber: {
      type: [Number, Boolean],
      default: null,
    },
    questionId: {
      type: [Number, Boolean],
      default: null,
    },
  },
  data() {
    return {
      choices: ["angry", "sad", "like", "wow", "love"],
      answer: "",
    };
  },
  watch: {
    answer() {
      this.$emit(
        "answer-mandatory",
        this.questionNumber,
        this.questionId,
        this.answer
      );
    },
  },
};
</script>

