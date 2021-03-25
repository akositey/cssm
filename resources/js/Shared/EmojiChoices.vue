<template>
  <div class="flex flex-grow w-10/12 px-8 py-10 md:py-40">
    <label
      v-for="(choice, i) in choices"
      :key="i"
      :for="`option-${questionId}-${i+1}`"
      class="flex-1"
    >
      <input
        type="radio"
        name="option"
        :id="`option-${questionId}-${i+1}`"
        :value="i+1"
        class="hidden checked:border-solid"
        @click="choose($event.target.value)"
      >
      <!-- v-model="newAnswer" dont use this anymore, clicking on the same element wont trigger watch -->
      <emoji-icon
        :name="choice"
        class="w-20 h-20 m-auto rounded-full cursor-pointer md:h-32 md:w-32"
        :class="{ 'w-24 h-24 md:h-40 md:w-40': i+1==newAnswer, 'opacity-50':newAnswer && i+1!=newAnswer }"
      />
      <div class="text-lg font-bold text-center md:text-5xl" :class="{'opacity-50':newAnswer && i+1!=newAnswer}">{{ i+1 }}</div>
      
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
    questionNumber: { type: [Number, Boolean], default: null },
    questionId: {
      type: [Number, Boolean],
      default: null,
    },
  },
  data() {
    return {
      choices: ["angry", "sad", "like", "wow", "love"],
      newAnswer: null,
    };
  },
  // watch: {
  //   newAnswer(){
  //     console.log(this.newAnswer);
  //   }
  // },
  methods: {
    choose(value){
      // console.log(value);
      this.newAnswer = value;
      
      this.$emit(
        "answer-mandatory",
        this.questionNumber,
        this.questionId,
        value
      );
    }
  },
};
</script>

