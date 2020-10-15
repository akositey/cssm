<template>
  <div class="flex flex-no-wrap px-2 py-20 md:py-40">
    <label
      v-for="(choice, i) in choices"
      :key="i"
      :for="`option-${questionNumber}-${i+1}`"
      class="flex-grow"
    >
      <input
        type="radio"
        name="option"
        :id="`option-${questionNumber}-${i+1}`"
        :value="i+1"
        class="hidden checked:border-solid"
        v-model="answer"
      >
      <emoji-icon
        :name="choice"
        class="w-20 h-20 rounded-full cursor-pointer md:h-32 md:w-32"
        :class="{ 'w-32 h-32 md:h-40 md:w-40': i+1===answer, 'opacity-25':answer && i+1!==answer }"
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
      console.log(this.answer);
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

