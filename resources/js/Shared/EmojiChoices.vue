<template>
  <div class="flex flex-no-wrap px-2 py-40">
    <label
      v-for="(choice, i) in choices"
      :key="i"
      :for="`option-${question}-${i}`"
      class="flex-grow w-20 h-20"
    >
      <input
        type="radio"
        name="option"
        :id="`option-${question}-${i}`"
        :value="i+1"
        class="hidden"
        v-model="answer"
      >
      <emoji-icon
        :name="choice"
        class="cursor-pointer"
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
    question: {
      type: String,
      default: "",
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
      console.log(this.question, this.answer);
      this.$emit("answer-question", this.question, this.answer);
    },
  },
};
</script>

